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
        Schema::create('stripe_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            // $table->integer('amount');
            $table->string('address');
            // $table->string('status');
            // $table->string('transaction_id');
            // $table->string('currency');
            $table->string('company_name')->nullable();
            $table->integer('customer_zip')->nullable();
            $table->integer('customer_country_id');
            $table->integer('customer_city_id');
            $table->string('customer_notes')->nullable();
            $table->integer('charge')->nullable();
            $table->integer('payment_method');
            $table->integer('subtotal');
            $table->integer('discount')->nullable();
            $table->double('total');
            $table->integer('customer_id');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stripe_orders');
    }
};
