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
        Schema::create('activity_book_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_book_id')->constrained('activity_book')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('progress');
            $table->timestamps();
        });

        DB::table('activity_book_user')->insert([
            ['activity_book_id' => 1, 'user_id' => 1, 'progress' => 50],
            ['activity_book_id' => 2, 'user_id' => 2, 'progress' => 30],
            ['activity_book_id' => 3, 'user_id' => 3, 'progress' => 70],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_book_user');
    }
};
