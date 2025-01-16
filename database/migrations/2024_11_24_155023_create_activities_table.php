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
            ['title' => 'Book-Themed Drawing', 'description' => 'Encourage your child to draw their favorite scene or character from the book they just read. This helps them to think creatively and remember the story better.', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Story Retelling', 'description' => 'Ask your child to retell the story in their own words. This helps with comprehension and language skills.', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Book Review', 'description' => 'Encourage your child to write a short review of the book, including what they liked or did not like about it.', 'created_at' => now(), 'updated_at' => now()],
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
