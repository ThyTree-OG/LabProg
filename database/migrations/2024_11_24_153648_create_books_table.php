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
            $table->integer('read_time');
            $table->float('rating_medio', 3, 2)->nullable();
            $table->string('age_group', 50);
            $table->boolean('is_active');
            $table->integer('access_level');
            $table->timestamps(0); // created_at, updated_at
        });

        DB::table('books')->insert([
            ['title' => 'The Mystery Book', 'description' => 'A thrilling mystery novel', 'read_time' => 120, 'age_group' => 'Adult', 'is_active' => true, 'access_level' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'The Sci-Fi Adventure', 'description' => 'Exploring galaxies and technology', 'read_time' => 150, 'age_group' => 'Young Adult', 'is_active' => true, 'access_level' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'The History Chronicles', 'description' => 'A dive into ancient civilizations', 'read_time' => 180, 'age_group' => 'Adult', 'is_active' => true, 'access_level' => 1, 'created_at' => now(), 'updated_at' => now()],
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
