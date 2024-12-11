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
            $table->rememberToken();
            $table->timestamps(0); // created_at, updated_at
        });

        DB::table('users')->insert([
            ['user_type_id' => 1, 'first_name' => 'Admin', 'last_name' => 'istrator', 'user_name' => 'admin', 'email' => 'admin@admin.com', 'password' => bcrypt('admin'), 'user_photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_type_id' => 2, 'first_name' => 'Alice', 'last_name' => 'Alice', 'user_name' => 'alice_a', 'email' => 'alice@example.com', 'password' => bcrypt('1234'), 'user_photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['user_type_id' => 3, 'first_name' => 'Bob', 'last_name' => 'Brown', 'user_name' => 'bob_b', 'email' => 'bob@example.com', 'password' => bcrypt('1234'), 'user_photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
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
