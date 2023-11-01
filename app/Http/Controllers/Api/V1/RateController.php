<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\RateService;

class RateController extends Controller
{
    protected RateService $rateService;

    public function __construct(RateService $rateService)
    {
        $this->rateService = $rateService;
    }

    public function syncRates(): void
    {
        $source = 'USD';
        $currencies = ['EUR', 'GBP', 'JPY'];
        $this->rateService->syncRates($source, $currencies);
    }
}
