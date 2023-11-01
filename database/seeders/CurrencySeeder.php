<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $currencies = array(
            array(
                'id' => 1,
                'code' => 'USD',
            ),
            array(
                'id' => 2,
                'code' => 'EUR',
            ),
            array(
                'id' => 3,
                'code' => 'GBP',
            ),
            array(
                'id' => 4,
                'code' => 'JPY',
            ));

        foreach ($currencies as $currency) {
            Currency::factory()->create($currency);
        }
    }
}
