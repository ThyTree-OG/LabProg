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
        Schema::create('author_book', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('authors')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
        });

        DB::table('author_book')->insert([
            ['author_id' => 1, 'book_id' => 1],
            ['author_id' => 2, 'book_id' => 2],
            ['author_id' => 3, 'book_id' => 3],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_book');
    }
};