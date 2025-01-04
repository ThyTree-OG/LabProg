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
            ['first_name' => 'John', 'last_name' => 'Doe', 'description' => "An imaginative storyteller, this author crafts compelling fictional worlds that captivate readers and ignite their imagination. With a talent for weaving intricate plots and developing relatable characters, their works explore themes of adventure, love, and the human condition. Known for a vivid narrative style and emotional depth, they inspire readers to journey beyond reality and into realms of wonder.", 'author_photo_url' => 'storage\authors\b.webp', 'nationality' => 'American', 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Jane', 'last_name' => 'Smith', 'description' => "A visionary storyteller celebrated for their groundbreaking contributions to science fiction, this author explores the boundaries of technology, humanity, and the cosmos. Known for weaving intricate narratives that challenge conventional thinking, their works delve into futuristic possibilities, ethical dilemmas, and the wonders of the unknown. Their imaginative storytelling has inspired countless readers to ponder the future and humanity's place in it.", 'author_photo_url' => 'storage\authors\a.webp', 'nationality' => 'British', 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'Emily', 'last_name' => 'Johnson', 'description' => "A beloved creator of enchanting tales, this author captures the hearts of young readers with whimsical stories and imaginative worlds. Their works are filled with relatable characters, gentle humor, and important life lessons, fostering curiosity and a love for reading. Known for their ability to blend playfulness with meaningful themes, they inspire children to dream, explore, and embrace the joy of storytelling.", 'author_photo_url' => 'storage\authors\c.webp', 'nationality' => 'Canadian', 'created_at' => now(), 'updated_at' => now()],
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
