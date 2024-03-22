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
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('product_name');
            $table->integer('product_reguler_price');
            $table->integer('product_discount_price')->nullable();
            $table->integer('product_after_discount_price');
            $table->string('short_description')->nullable();
            $table->longText('long_description');
            $table->string('preview')->nullable();
            $table->string('product_slug');
            $table->integer('brand')->nullable();
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
