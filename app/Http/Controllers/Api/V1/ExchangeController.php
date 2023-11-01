<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ConvertExchangeRequest;
use App\Http\Responses\JsonResponseApi;
use App\Services\ExchangeService;
use App\Utils\EnumCuster;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class ExchangeController extends Controller
{
    protected ExchangeService $exchangeService;

    public function __construct(ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;
    }

    public function convert(ConvertExchangeRequest $request): JsonResponse
    {
        $params = $request->validated();
        try {
            $response = $this->exchangeService->calculateAmount(EnumCuster::castPurchaseCurrencyEnum($params['from']), $params['amount'], 'USD');
            return JsonResponseApi::success('Success', $response);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return JsonResponseApi::error('Error!');
        }
    }
}
