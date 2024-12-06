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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description');
            $table->timestamps(0); // created_at, updated_at
        });

        DB::table('activities')->insert([
            ['title' => 'Quiz on Mystery Book', 'description' => 'A quiz activity based on the mystery book', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Puzzle Game', 'description' => 'Solve the puzzle related to the storyline of the book', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Trivia Challenge', 'description' => 'General trivia based on various books', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
