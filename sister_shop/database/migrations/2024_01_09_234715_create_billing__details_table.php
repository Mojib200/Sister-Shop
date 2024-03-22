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
        Schema::create('billing__details', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->integer('customer_id');
            $table->string('customer_name');
            $table->string('email');
            $table->integer('customer_number');
            $table->string('company_name')->nullable();
            $table->string('customer_address');
            $table->integer('customer_zip');
            $table->integer('customer_country_id');
            $table->integer('customer_city_id');
            $table->string('customer_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing__details');
    }
};
