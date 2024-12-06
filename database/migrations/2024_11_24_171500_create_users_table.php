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

        DB::table('users')->insert([
            ['user_type_id' => 1, 'first_name' => 'Alice', 'last_name' => 'Smith', 'user_name' => 'alice_s', 'email' => 'alice@example.com', 'password' => bcrypt('password123'), 'user_photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_type_id' => 2, 'first_name' => 'Bob', 'last_name' => 'Brown', 'user_name' => 'bob_b', 'email' => 'bob@example.com', 'password' => bcrypt('password456'), 'user_photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_type_id' => 3, 'first_name' => 'Charlie', 'last_name' => 'Davis', 'user_name' => 'charlie_d', 'email' => 'charlie@example.com', 'password' => bcrypt('password789'), 'user_photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
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
