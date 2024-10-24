CREATE DATABASE bdteste;
USE bdteste;

CREATE TABLE authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    description TEXT,
    author_photo_url VARCHAR(255),
    nationality VARCHAR(100),
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    cover_url VARCHAR(255),
    read_time INT,
    age_group VARCHAR(50),
    is_active BOOLEAN,
    access_level INT,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE author_book (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author_id INT,
    book_id INT,
    FOREIGN KEY (author_id) REFERENCES authors(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);

CREATE TABLE pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT,
    page_image_url VARCHAR(255),
    audio_url VARCHAR(255),
    page_index INT,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (book_id) REFERENCES books(id)
);

CREATE TABLE videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT,
    title VARCHAR(255),
    video_url VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (book_id) REFERENCES books(id)
);

CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE tagging_tagged (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT,
    tag_id INT,
    FOREIGN KEY (book_id) REFERENCES books(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
);

CREATE TABLE age_groups (
    age_group VARCHAR(50) PRIMARY KEY,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE activity_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    activity_id INT,
    title VARCHAR(255),
    image_url VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (activity_id) REFERENCES activities(id)
);

CREATE TABLE activity_book (
    id INT AUTO_INCREMENT PRIMARY KEY,
    activity_id INT,
    book_id INT,
    FOREIGN KEY (activity_id) REFERENCES activities(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);

CREATE TABLE user_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_type VARCHAR(100),
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_type_id INT,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    user_name VARCHAR(100),
    email VARCHAR(255),
    password VARCHAR(255),
    user_photo_url VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (user_type_id) REFERENCES user_types(id)
);

CREATE TABLE activity_book_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    activity_book_id INT,
    user_id INT,
    progress INT,
    FOREIGN KEY (activity_book_id) REFERENCES activity_book(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE book_user_favourite (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT,
    user_id INT,
    FOREIGN KEY (book_id) REFERENCES books(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE book_user_read (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT,
    user_id INT,
    progress INT,
    rating INT,
    read_date DATETIME,
    FOREIGN KEY (book_id) REFERENCES books(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    access_level INT,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    plan_id INT,
    start_date DATETIME,
    created_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (plan_id) REFERENCES plans(id)
);

-- Inserindo dados em authors
INSERT INTO authors (first_name, last_name, description, nationality, created_at, updated_at)
VALUES ('John', 'Doe', 'Author of fictional books', 'American', NOW(), NOW());

-- Inserindo dados em books
INSERT INTO books (title, description, read_time, age_group, is_active, access_level, created_at, updated_at)
VALUES ('The Mystery Book', 'A thrilling mystery novel', 120, 'Adult', TRUE, 1, NOW(), NOW());

-- Inserindo dados em author_book
INSERT INTO author_book (author_id, book_id) VALUES (1, 1);

-- Inserindo dados em pages
INSERT INTO pages (book_id, page_image_url, page_index, created_at, updated_at)
VALUES (1, 'http://example.com/page1.png', 1, NOW(), NOW());

-- Inserindo dados em tags
INSERT INTO tags (name, created_at, updated_at) VALUES ('Mystery', NOW(), NOW());

-- Inserindo dados em tagging_tagged
INSERT INTO tagging_tagged (book_id, tag_id) VALUES (1, 1);

-- Inserindo dados em user_types
INSERT INTO user_types (user_type, created_at, updated_at) VALUES ('Admin', NOW(), NOW());

-- Inserindo dados em users
INSERT INTO users (user_type_id, first_name, last_name, user_name, email, password, created_at, updated_at)
VALUES (1, 'Alice', 'Smith', 'alice_s', 'alice@example.com', 'password123', NOW(), NOW());

-- Inserindo dados em plans
INSERT INTO plans (name, access_level, created_at, updated_at) VALUES ('Premium Plan', 2, NOW(), NOW());

-- Inserindo dados em subscriptions
INSERT INTO subscriptions (user_id, plan_id, start_date, created_at) VALUES (1, 1, NOW(), NOW());

-- Inserir dados nos favoritos de utilizadores
INSERT INTO book_user_favourite(book_id, user_id) VALUES (1, 1);

-- Inserindo dados na tabela activities
INSERT INTO activities (title, description, created_at, updated_at)
VALUES 
('Quiz on Mystery Book', 'A quiz activity based on the mystery book', NOW(), NOW()),
('Puzzle Game', 'Solve the puzzle related to the storyline of the book', NOW(), NOW());

-- Inserindo dados na tabela activity_book (associando atividades a um livro)
INSERT INTO activity_book (activity_id, book_id)
VALUES 
(1, 1),  -- Atividade de Quiz associada ao livro com ID 1
(2, 1);  -- Atividade de Puzzle associada ao livro com ID 1
