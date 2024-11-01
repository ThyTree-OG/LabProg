USE bdteste;

DELIMITER $$

CREATE PROCEDURE ListUserFavouriteBooks(IN userId INT)
BEGIN
    SELECT 
        b.id AS book_id,
        b.title,
        b.description,
        b.read_time,
        b.age_group,
        b.is_active,
        b.cover_url,
        u.first_name,
        u.last_name,
        u.email
    FROM book_user_favourite buf
    JOIN books b ON buf.book_id = b.id
    JOIN users u ON buf.user_id = u.id
    WHERE buf.user_id = userId;
END$$

DELIMITER ;

-- CALL ListUserFavouriteBooks(1);


DELIMITER $$

CREATE PROCEDURE ListUserReadBooks(IN userId INT)
BEGIN
    SELECT 
        b.id AS book_id,
        b.title,
        b.description,
        b.read_time,
        b.age_group,
        b.is_active,
        b.cover_url,
        bur.progress,
        bur.rating,
        bur.read_date,
        u.first_name,
        u.last_name,
        u.email
    FROM book_user_read bur
    JOIN books b ON bur.book_id = b.id
    JOIN users u ON bur.user_id = u.id
    WHERE bur.user_id = userId;
END$$

DELIMITER ;

-- CALL ListUserReadBooks(1);


DELIMITER $$

CREATE PROCEDURE ListBookActivities(IN bookId INT)
BEGIN
    SELECT 
        a.id AS activity_id,
        a.title AS activity_title,
        a.description AS activity_description,
        a.created_at AS activity_created_at,
        a.updated_at AS activity_updated_at
    FROM activity_book ab
    JOIN activities a ON ab.activity_id = a.id
    WHERE ab.book_id = bookId;
END$$

DELIMITER ;

-- CALL ListBookActivities(1);


DELIMITER $$

CREATE PROCEDURE ListBooksByTags(
    IN p_tags VARCHAR(255),       -- Parâmetro para lista de tags, separadas por vírgula
    IN p_is_active BOOLEAN,       -- Parâmetro opcional para filtrar por status do livro (ativo/inativo)
    IN p_age_group VARCHAR(50)    -- Parâmetro opcional para filtrar pelo grupo de idade
)
BEGIN
    -- Variáveis temporárias para manipulação das tags
    DECLARE tag_count INT DEFAULT 0;
    DECLARE tag_condition TEXT DEFAULT '';
    
    -- Contar a quantidade de tags recebidas no parâmetro p_tags
    SET tag_count = (LENGTH(p_tags) - LENGTH(REPLACE(p_tags, ',', '')) + 1);
-- Mystery,History -> 15 - 7,7 -> 
-- Mystery -> 7 - 7 -> 1
    -- Gerar a condição de tags dinamicamente
    SET tag_condition = CONCAT(
        ' AND (SELECT COUNT(DISTINCT t.id) FROM tags t ',
        'JOIN tagging_tagged tt ON t.id = tt.tag_id ',
        'WHERE tt.book_id = b.id AND FIND_IN_SET(t.name, ?)) = ?'
    );
    
    -- Construção da query principal para seleção dos livros
    SET @query = CONCAT(
        'SELECT b.id, b.title, b.description, b.cover_url, b.read_time, b.age_group ',
        'FROM books b ',
        'JOIN tagging_tagged tt ON b.id = tt.book_id ',
        'JOIN tags t ON t.id = tt.tag_id ',
        'WHERE FIND_IN_SET(t.name, ?) > 0'
    );
    
    -- Adiciona condição para status do livro, se for passado o parâmetro p_is_active
    IF p_is_active IS NOT NULL THEN
        SET @query = CONCAT(@query, ' AND b.is_active = ', p_is_active);
    END IF;
    
    -- Adiciona condição para o grupo de idade, se for passado o parâmetro p_age_group
    IF p_age_group IS NOT NULL THEN
        SET @query = CONCAT(@query, ' AND b.age_group = "', p_age_group, '"');
    END IF;

    -- Executa a query com os parâmetros dinâmicos
    SET @query = CONCAT(@query, ' GROUP BY b.id');
    
    PREPARE stmt FROM @query;
    SET @p_tags = p_tags;
    EXECUTE stmt USING @p_tags;
    DEALLOCATE PREPARE stmt;
END$$

DELIMITER ;

-- CALL ListBooksByTags('Mystery,History', NULL, NULL);


DELIMITER $$

CREATE PROCEDURE SuggestedBooksForUser(
    IN p_user_id INT
)
BEGIN
    -- Sugere livros que partilham tags com os livros favoritos do utilizador
    SELECT DISTINCT b.id AS book_id, 
           b.title, 
           b.description, 
           b.cover_url, 
           b.age_group, 
           AVG(bur.rating) AS avg_rating, 
           COUNT(bur.id) AS total_reads
    FROM books b
    JOIN tagging_tagged tt ON b.id = tt.book_id
    JOIN tags t ON tt.tag_id = t.id
    JOIN book_user_favourite buf ON buf.book_id = b.id
    LEFT JOIN book_user_read bur ON b.id = bur.book_id
    WHERE buf.user_id = p_user_id                -- Compara com favoritos do utilizador
      AND b.id NOT IN (                          -- Exclui livros já lidos pelo utilizador
          SELECT book_id 
          FROM book_user_read 
          WHERE user_id = p_user_id
      )
    GROUP BY b.id
    ORDER BY avg_rating DESC, total_reads DESC   -- Ordena pela média de avaliação e leituras
    LIMIT 10;												 -- Limitar a 10 livros

    -- Sugere livros populares que o utilizador ainda não leu
    SELECT DISTINCT b.id AS book_id, 
           b.title, 
           b.description, 
           b.cover_url, 
           b.age_group, 
           AVG(bur.rating) AS avg_rating, 
           COUNT(bur.id) AS total_reads
    FROM books b
    LEFT JOIN book_user_read bur ON b.id = bur.book_id
    WHERE b.id NOT IN (                          -- Exclui livros já lidos pelo utilizador
          SELECT book_id 
          FROM book_user_read 
          WHERE user_id = p_user_id
      )
    GROUP BY b.id
    ORDER BY total_reads DESC, avg_rating DESC   -- Ordena por popularidade e média de avaliação
    LIMIT 10;												 -- Limitar a 10 livros
    
    -- Sugere livros do mesmo grupo de idade favoritos por outros utilizadores
    SELECT DISTINCT b.id AS book_id, 
           b.title, 
           b.description, 
           b.cover_url, 
           b.age_group, 
           AVG(bur.rating) AS avg_rating, 
           COUNT(bur.id) AS total_reads
    FROM books b
    JOIN book_user_favourite buf ON buf.book_id = b.id
    LEFT JOIN book_user_read bur ON b.id = bur.book_id
    WHERE b.age_group = (                         -- Filtra pelo grupo de idade
          SELECT age_group 
          FROM books 
          WHERE id IN (SELECT book_id FROM book_user_favourite WHERE user_id = p_user_id)
          LIMIT 1
      )
      AND b.id NOT IN (                           -- Exclui livros já lidos pelo utilizador
          SELECT book_id 
          FROM book_user_read 
          WHERE user_id = p_user_id
      )
    GROUP BY b.id
    ORDER BY avg_rating DESC, total_reads DESC    -- Ordena pela média de avaliação e leituras totais
    LIMIT 10;												  -- Limitar a 10 livros
    
END$$

DELIMITER ;

-- CALL SuggestedBooksForUser(1);


-- Cria a view para listar os livros mais populares nos últimos 3 meses
CREATE VIEW PopularBooksLast3Months AS
SELECT 
    b.id AS book_id,
    b.title,
    b.description,
    b.cover_url,
    COUNT(bur.id) AS total_reads,                     -- Total de vezes que o livro foi lido
    AVG(bur.rating) AS average_rating,                -- Média das avaliações
    SUM(bur.progress) / COUNT(bur.id) AS avg_progress -- Progresso médio das leituras pelos utilizadores
FROM 
    books b
JOIN 
    book_user_read bur ON b.id = bur.book_id
WHERE 
    bur.read_date >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)  -- Últimos 3 meses
GROUP BY 
    b.id, b.title, b.description, b.cover_url
ORDER BY 
    total_reads DESC,          -- Ordena por total de leituras (popularidade)
    average_rating DESC,       -- Ordena por média de avaliação
    avg_progress DESC;         -- Ordena por progresso médio

-- SELECT * FROM PopularBooksLast3Months;


DELIMITER //

CREATE TRIGGER update_book_rating
AFTER INSERT ON book_user_read
FOR EACH ROW
BEGIN
    DECLARE avg_rating DECIMAL(3, 2);

    -- Calcula a média de rating para o livro específico
    SELECT AVG(rating) INTO avg_rating
    FROM book_user_read
    WHERE book_id = NEW.book_id;

    -- Atualiza a coluna rating_medio na tabela books
    UPDATE books
    SET rating_medio = avg_rating
    WHERE id = NEW.book_id;
END;
//

DELIMITER ;

DELIMITER //

CREATE TRIGGER update_book_rating_on_update
AFTER UPDATE ON book_user_read
FOR EACH ROW
BEGIN
    DECLARE avg_rating DECIMAL(3, 2);

    -- Calcula a média de rating para o livro específico
    SELECT AVG(rating) INTO avg_rating
    FROM book_user_read
    WHERE book_id = NEW.book_id;

    -- Atualiza a coluna rating_medio na tabela books
    UPDATE books
    SET rating_medio = avg_rating
    WHERE id = NEW.book_id;
END;
//

DELIMITER ;

/*
SELECT * FROM books
SELECT * FROM book_user_read

INSERT INTO book_user_read (book_id, user_id, progress, rating, read_date) 
VALUES 
(2, 1, 100, 2, NOW())

UPDATE book_user_read
SET rating=1 WHERE id=4
*/