<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 20);
            $table->string('name', 255);
            $table->mediumText('description');
            $table->string('barcode', 20);
            $table->foreignId('category_id')->constrained();
            $table->double('price');
            $table->double('sala_price');
            $table->boolean('sale');
            $table->double('stock');
            $table->double('weight');
            $table->foreignId('color_id')->constrained();
            $table->foreignId('size_id')->constrained();
            $table->double('width');
            $table->double('height');
            $table->double('length');
            $table->double('vat');
            $table->foreignId('brand_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
