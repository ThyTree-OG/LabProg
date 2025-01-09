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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_type_id')->constrained('user_types')->onDelete('cascade');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('user_name', 100)->unique();
            $table->string('email', 255)->unique();
            $table->string('password');
            $table->string('user_photo_url', 255)->nullable();
            $table->timestamps(0); // created_at, updated_at
        });

        // Inserir dados iniciais para três utilizadores
        DB::table('users')->insert([
            [
                'user_type_id' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'user_name' => 'admin',
                'email' => 'johndoe@example.com',
                'password' => bcrypt('admin'), // Senha encriptada
                'user_photo_url' => '/storage/user_photos/b1.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_type_id' => 2,
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'user_name' => 'admin1',
                'email' => 'janesmith@example.com',
                'password' => bcrypt('admin1'), // Senha encriptada
                'user_photo_url' => '/storage/user_photos/a1.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_type_id' => 3,
                'first_name' => 'Alice',
                'last_name' => 'Johnson',
                'user_name' => 'admin2',
                'email' => 'alicejohnson@example.com',
                'password' => bcrypt('admin2'), // Senha encriptada
                'user_photo_url' => '/storage/user_photos/c1.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
