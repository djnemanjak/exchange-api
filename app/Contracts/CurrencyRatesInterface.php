<?php

namespace App\Contracts;

use App\Http\Responses\CurrencyRatesResponse;

interface CurrencyRatesInterface
{
    public function fetchCurrencyRates(string $source, array $currencies): CurrencyRatesResponse;
}
