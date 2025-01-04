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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('access_level');
            $table->timestamps();
        });

        DB::table('plans')->insert([
            ['name' => 'Premium Plan', 'access_level' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Standard Plan', 'access_level' => 2, 'created_at' => now(), 'updated_at' => now()],
           
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
