<?php

namespace Database\Seeders;

use App\Enums\CurrencyConfigurationTypesEnum;
use App\Models\CurrencyConfiguration;
use Illuminate\Database\Seeder;

class CurrencyConfigurationSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $currencyConfigurations = array(
            array(
                'id' => 1,
                'currency_id' => 2,
                'type' => CurrencyConfigurationTypesEnum::SURCHARGE->value,
                'value' => 5,
            ),
            array(
                'id' => 2,
                'currency_id' => 2,
                'type' => CurrencyConfigurationTypesEnum::DISCOUNT->value,
                'value' => 2,
            ),
            array(
                'id' => 3,
                'currency_id' => 3,
                'type' => CurrencyConfigurationTypesEnum::SURCHARGE->value,
                'value' => 5,
            ),
            array(
                'id' => 4,
                'currency_id' => 4,
                'type' => CurrencyConfigurationTypesEnum::SURCHARGE->value,
                'value' => 7.5,
            )
        );

        foreach ($currencyConfigurations as $currencyConfiguration) {
            CurrencyConfiguration::factory()->create($currencyConfiguration);
        }
    }
}
