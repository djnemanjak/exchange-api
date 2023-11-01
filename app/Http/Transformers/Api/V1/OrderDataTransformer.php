<?php

namespace App\Http\Transformers\Api\V1;

use Carbon\Carbon;

class OrderDataTransformer
{
    public function transform(array $data): array
    {
        return [
            'foreign_currency' => $data['currency'],
            'exchange_rate' => $data['rate'],
            'surcharge_percentage' => $data['surcharge'],
            'surcharge_amount' => $data['surchargeAmount'],
            'foreign_amount' => $data['foreignAmount'],
            'amount' => $data['totalAmount'],
            'discount_percentage' => $data['discount'],
            'discount_amount' => $data['discountAmount'],
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];
    }
}
