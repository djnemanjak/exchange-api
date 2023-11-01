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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('foreign_currency', 3);
            $table->decimal('exchange_rate', 20, 14);
            $table->decimal('surcharge_percentage')->nullable();
            $table->decimal('surcharge_amount', 20, 14)->nullable();
            $table->decimal('foreign_amount');
            $table->decimal('amount', 20, 14);
            $table->decimal('discount_percentage')->nullable();
            $table->decimal('discount_amount', 20, 14)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
