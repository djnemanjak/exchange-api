<?php

namespace Database\Seeders;

use App\Models\Rate;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $rates = array(
            array(
                'id' => 1,
                'source_currency_id' => 1,
                'target_currency_id' => 2,
                'rate' => 0.884872
            ),
            array(
                'id' => 2,
                'source_currency_id' => 1,
                'target_currency_id' => 3,
                'rate' => 0.711178
            ),
            array(
                'id' => 3,
                'source_currency_id' => 1,
                'target_currency_id' => 4,
                'rate' => 107.17
            ));

        foreach ($rates as $rate) {
            Rate::factory()->create($rate);
        }
    }
}
