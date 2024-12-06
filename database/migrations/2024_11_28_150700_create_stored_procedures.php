<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            -- Procedure: ListUserFavouriteBooks
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
            END;
        ");

        DB::unprepared("
            -- Procedure: ListUserReadBooks
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
            END;
        ");

        DB::unprepared("
            -- Procedure: ListBookActivities
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
            END;
        ");

        DB::unprepared("
            -- Procedure: ListBooksByTags
            CREATE PROCEDURE ListBooksByTags(
                IN p_tags VARCHAR(255),       
                IN p_is_active BOOLEAN,       
                IN p_age_group VARCHAR(50)    
            )
            BEGIN
                -- Dynamic query for selecting books
                SET @query = 'SELECT b.id, b.title, b.description, b.cover_url, b.read_time, b.age_group
                FROM books b
                JOIN tagging_tagged tt ON b.id = tt.book_id
                JOIN tags t ON t.id = tt.tag_id
                WHERE FIND_IN_SET(t.name, ?) > 0';

                -- Add condition for book status
                IF p_is_active IS NOT NULL THEN
                    SET @query = CONCAT(@query, ' AND b.is_active = ', IF(p_is_active, 'TRUE', 'FALSE'));
                END IF;

                -- Add condition for age group
                IF p_age_group IS NOT NULL THEN
                    SET @query = CONCAT(@query, ' AND b.age_group = ''', p_age_group, '''');
                END IF;

                -- Finalize query with grouping
                SET @query = CONCAT(@query, ' GROUP BY b.id');

                -- Prepare and execute dynamic query
                PREPARE stmt FROM @query;
                SET @p_tags = p_tags;
                EXECUTE stmt USING @p_tags;
                DEALLOCATE PREPARE stmt;
            END;
        ");

        DB::unprepared("
            -- Procedure: SuggestedBooksForUser
            CREATE PROCEDURE SuggestedBooksForUser(
                IN p_user_id INT
            )
            BEGIN
                -- Suggest books that share tags with user's favorites
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
                WHERE buf.user_id = p_user_id
                AND b.id NOT IN (
                    SELECT book_id 
                    FROM book_user_read 
                    WHERE user_id = p_user_id
                )
                GROUP BY b.id
                ORDER BY avg_rating DESC, total_reads DESC
                LIMIT 10;

                -- Suggest popular books the user hasn't read
                SELECT DISTINCT b.id AS book_id, 
                b.title, 
                b.description, 
                b.cover_url, 
                b.age_group, 
                AVG(bur.rating) AS avg_rating, 
                COUNT(bur.id) AS total_reads
                FROM books b
                LEFT JOIN book_user_read bur ON b.id = bur.book_id
                WHERE b.id NOT IN (
                SELECT book_id 
                FROM book_user_read 
                WHERE user_id = p_user_id
                )
                GROUP BY b.id
                ORDER BY total_reads DESC, avg_rating DESC
                LIMIT 10;

                -- Suggest books in the same age group as user's favorite books
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
                WHERE b.age_group = (
                    SELECT age_group 
                    FROM books 
                    WHERE id IN (SELECT book_id FROM book_user_favourite WHERE user_id = p_user_id)
                    LIMIT 1
                )
                AND b.id NOT IN (
                    SELECT book_id 
                    FROM book_user_read 
                    WHERE user_id = p_user_id
                )
                GROUP BY b.id
                ORDER BY avg_rating DESC, total_reads DESC
                LIMIT 10;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS ListUserFavouriteBooks;
            DROP PROCEDURE IF EXISTS ListUserReadBooks;
            DROP PROCEDURE IF EXISTS ListBookActivities;
            DROP PROCEDURE IF EXISTS ListBooksByTags;
            DROP PROCEDURE IF EXISTS SuggestedBooksForUser;
        ");
    }
};
