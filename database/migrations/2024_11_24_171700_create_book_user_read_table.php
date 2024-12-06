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
        Schema::create('book_user_read', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('progress');
            $table->integer('rating');
            $table->dateTime('read_date');
            $table->timestamps();
        });

        DB::table('book_user_read')->insert([
            ['book_id' => 1, 'user_id' => 1, 'progress' => 100, 'rating' => 5, 'read_date' => now()],
            ['book_id' => 2, 'user_id' => 2, 'progress' => 60, 'rating' => 4, 'read_date' => now()],
            ['book_id' => 3, 'user_id' => 3, 'progress' => 20, 'rating' => 3, 'read_date' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_user_read');
    }
};
