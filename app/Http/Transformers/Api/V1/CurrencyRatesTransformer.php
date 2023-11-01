<?php

namespace App\Http\Transformers\Api\V1;

use App\Http\Responses\CurrencyRatesResponse;

class CurrencyRatesTransformer
{
    public function transform(array $data): CurrencyRatesResponse
    {
        $targets = [];
        foreach ($data['quotes'] as $key => $value) {
            $currency = substr($key, 3);
            $targets[$currency] = $value;
        }
        return new CurrencyRatesResponse($data['source'], $targets);
    }
}
