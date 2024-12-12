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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description');
            $table->string('cover_url', 255)->nullable();
            $table->string('pdf_path')->nullable();
            $table->integer('read_time');
            $table->float('rating_medio', 3, 2)->nullable();
            $table->string('age_group', 50);
            $table->boolean('is_active');
            $table->integer('access_level');
            $table->timestamps(0); // created_at, updated_at
        });

        DB::table('books')->insert([
            ['title' => 'Brown Bear What Do You See?', 'description' => 'A brown bear story', 'pdf_path' => 'storage\livros\Eric_Carle_Brown_Bear_What_Do_You_See.pdf' ,'read_time' => 120, 'age_group' => 'Adult', 'is_active' => true, 'access_level' => 1,'cover_url' => storage\img\d.png, 'created_at' => now(), 'updated_at' => now()],
            ['title' => "Giraffes Can't Dance", 'description' => 'A story about giraffes', 'pdf_path' => 'storage\livros\Giraffes_Can_t_Dance.pdf', 'read_time' => 150, 'age_group' => 'Young Adult', 'is_active' => true, 'access_level' => 1, 'cover_url' => storage\img\a.png, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Monkey Puzzle', 'description' => 'A monkey puzzle', 'pdf_path' => 'storage\livros\Monkey Puzzle_Julia Donaldson.pdf', 'read_time' => 180, 'age_group' => 'Adult', 'is_active' => true, 'access_level' => 1, 'cover_url' => storage\img\b.png, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Pancakes pancakes', 'description' => 'Pancakes!', 'pdf_path' => 'storage\livros\Pancakes pancakes_Eric Carle.pdf', 'read_time' => 180, 'age_group' => 'Adult', 'is_active' => true, 'access_level' => 1, 'cover_url' => storage\img\c.png, 'created_at' => now(), 'updated_at' => now()],
        ]);
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
