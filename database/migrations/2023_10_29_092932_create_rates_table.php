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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_currency_id')->index();
            $table->unsignedBigInteger('target_currency_id')->index();
            $table->decimal('rate', 20, 14);
            $table->timestamps();
        });

        Schema::table('rates', function (Blueprint $table) {
            $table->foreign('source_currency_id')->references('id')->on('currencies')->onDelete('cascade');;
            $table->foreign('target_currency_id')->references('id')->on('currencies')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
