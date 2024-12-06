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
        Schema::create('activity_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained('activities')->onDelete('cascade');
            $table->string('title', 255);
            $table->string('image_url', 255);
            $table->timestamps(0); // created_at, updated_at
        });

        DB::table('activity_images')->insert([
            ['activity_id' => 1, 'title' => 'Quiz Image', 'image_url' => 'http://example.com/quiz_image.png', 'created_at' => now(), 'updated_at' => now()],
            ['activity_id' => 2, 'title' => 'Puzzle Image', 'image_url' => 'http://example.com/puzzle_image.png', 'created_at' => now(), 'updated_at' => now()],
            ['activity_id' => 3, 'title' => 'Trivia Image', 'image_url' => 'http://example.com/trivia_image.png', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_images');
    }
};
