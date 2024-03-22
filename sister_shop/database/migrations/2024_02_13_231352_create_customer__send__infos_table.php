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
        Schema::create('customer__send__infos', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->nullable;
            $table->string('customer_email')->nullable;
            $table->string('customer_number')->nullable;
            $table->string('customer_subject')->nullable;
            $table->text('customer_message')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer__send__infos');
    }
};
