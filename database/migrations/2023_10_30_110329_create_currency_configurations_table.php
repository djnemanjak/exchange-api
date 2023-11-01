<?php

use App\Enums\CurrencyConfigurationTypesEnum;
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
        Schema::create('currency_configurations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id')->index();
            $table->enum('type', array_column(CurrencyConfigurationTypesEnum::cases(), 'value'))->default(CurrencyConfigurationTypesEnum::SURCHARGE->value);
            $table->float('value');
            $table->timestamps();
        });

        Schema::table('currency_configurations', function (Blueprint $table) {
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_configurations');
    }
};
