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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->text('description');
            $table->string('author_photo_url', 255)->nullable();
            $table->string('nationality', 100);
            $table->timestamps(0); // created_at, updated_at
        });

        DB::table('authors')->insert([
            ['first_name' => 'John', 'last_name' => 'Doe', 'description' => 'Author of fictional books', 'nationality' => 'American', 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Jane', 'last_name' => 'Smith', 'description' => 'Renowned for science fiction', 'nationality' => 'British', 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Emily', 'last_name' => 'Johnson', 'description' => 'Specializes in historical novels', 'nationality' => 'Canadian', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
