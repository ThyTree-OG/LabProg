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
         // Create activity_book table first
        Schema::create('activity_book', function (Blueprint $table) {
            $table->id(); // id is unsignedBigInteger by default
            $table->foreignId('activity_id')->constrained('activities')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
        });

        DB::table('activity_book')->insert([
            ['activity_id' => 1, 'book_id' => 1],
            ['activity_id' => 2, 'book_id' => 1],
            ['activity_id' => 3, 'book_id' => 2],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_book');
    }
};
