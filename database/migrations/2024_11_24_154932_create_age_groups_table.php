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
        Schema::create('age_groups', function (Blueprint $table) {
            $table->string('age_group', 50)->primary();
            $table->timestamps(0); // created_at, updated_at
        });

        DB::table('age_groups')->insert([
            ['age_group' => 'Children', 'created_at' => now(), 'updated_at' => now()],
            ['age_group' => 'Young Adult', 'created_at' => now(), 'updated_at' => now()],
            ['age_group' => 'Adult', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('age_groups');
    }
};
