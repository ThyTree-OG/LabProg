<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER update_book_rating
            AFTER INSERT ON book_user_read
            FOR EACH ROW
            BEGIN
                DECLARE avg_rating DECIMAL(3, 2);

                SELECT AVG(rating) INTO avg_rating
                FROM book_user_read
                WHERE book_id = NEW.book_id;

                UPDATE books
                SET rating_medio = avg_rating
                WHERE id = NEW.book_id;
            END;
            
            CREATE TRIGGER update_book_rating_on_update
            AFTER UPDATE ON book_user_read
            FOR EACH ROW
            BEGIN
                DECLARE avg_rating DECIMAL(3, 2);

                SELECT AVG(rating) INTO avg_rating
                FROM book_user_read
                WHERE book_id = NEW.book_id;

                UPDATE books
                SET rating_medio = avg_rating
                WHERE id = NEW.book_id;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS update_book_rating;
            DROP TRIGGER IF EXISTS update_book_rating_on_update;
        ");
    }
};
