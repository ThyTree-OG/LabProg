<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW PopularBooksLast3Months AS
            SELECT 
                b.id AS book_id,
                b.title,
                b.description,
                b.cover_url,
                COUNT(bur.id) AS total_reads,
                AVG(bur.rating) AS average_rating,
                SUM(bur.progress) / COUNT(bur.id) AS avg_progress
            FROM 
                books b
            JOIN 
                book_user_read bur ON b.id = bur.book_id
            WHERE 
                bur.read_date >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
            GROUP BY 
                b.id, b.title, b.description, b.cover_url
            ORDER BY 
                total_reads DESC,
                average_rating DESC,
                avg_progress DESC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS PopularBooksLast3Months");
    }
};
