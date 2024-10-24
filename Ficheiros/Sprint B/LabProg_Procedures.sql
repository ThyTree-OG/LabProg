USE bdteste;

DELIMITER //

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
END //

DELIMITER ;

DELIMITER //

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
END //

DELIMITER ;

CALL ListBookActivities(1);  -- Substitua '1' pelo ID do livro desejado
