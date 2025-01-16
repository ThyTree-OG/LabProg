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
            ['title' => 'Brown Bear What Do You See?', 'description' => "A beloved classic, Brown Bear, What Do You See? invites children to explore colors and animals through rhythmic text and Eric Carle's vibrant illustrations. Perfect for young readers, this engaging book sparks curiosity and joy on every page.", 'pdf_path' => 'storage\livros\Eric_Carle_Brown_Bear_What_Do_You_See.pdf' ,'read_time' => 120, 'age_group' => 'Adult', 'is_active' => true, 'access_level' => 1,'cover_url' => 'storage\img\d.png', 'created_at' => now(), 'updated_at' => now()],
            ['title' => "Giraffes Can't Dance", 'description' => "Join Gerald the giraffe in Giraffes Can't Dance, a heartwarming story about finding your rhythm and embracing what makes you unique. With playful rhymes and vibrant illustrations, this inspiring tale encourages confidence and self-expression, making it a favorite for young readers.", 'pdf_path' => 'storage\livros\Giraffes_Can_t_Dance.pdf', 'read_time' => 150, 'age_group' => 'Young Adult', 'is_active' => true, 'access_level' => 1, 'cover_url' => 'storage\img\a.png', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Monkey Puzzle', 'description' => "In Monkey Puzzle, a little monkey has lost his mum! With the help of a friendly butterfly, he embarks on a journey through the jungle to find her. Filled with rhymes, humor, and vibrant illustrations, this charming tale by Julia Donaldson and Axel Scheffler is perfect for young readers learning about love, family, and the importance of paying attention to details.", 'pdf_path' => 'storage\livros\Monkey_Puzzle_Julia_Donaldson.pdf', 'read_time' => 180, 'age_group' => 'Adult', 'is_active' => true, 'access_level' => 2, 'cover_url' => 'storage\img\b.png', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Pancakes pancakes', 'description' => "Join Jack on a delightful journey in Pancakes, Pancakes! as he gathers ingredients to make a delicious breakfast treat. Written and illustrated by Eric Carle, this charming story combines vibrant artwork with a fun exploration of how food is made, making it a delightful read for children and pancake lovers alike!", 'pdf_path' => 'storage\livros\Pancakes_pancakes_Eric_Carle.pdf', 'read_time' => 180, 'age_group' => 'Adult', 'is_active' => true, 'access_level' => 2, 'cover_url' => 'storage\img\c.png', 'created_at' => now(), 'updated_at' => now()],
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
