<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CreateOrderRequest;
use App\Http\Responses\JsonResponseApi;
use App\Services\OrderService;
use App\Utils\EnumCuster;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function createOrder(CreateOrderRequest $request): JsonResponse
    {
        $body = $request->validated();
        try {
            $this->orderService->createOrder(EnumCuster::castPurchaseCurrencyEnum($body['from']), $body['amount'], $body['totalAmount'], 'USD');
            return JsonResponseApi::success('Success');
        } catch (HttpResponseException $e) {
            Log::error($e->getMessage());
            return JsonResponseApi::error($e->getMessage());
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return JsonResponseApi::error('Error!');
        }
    }
}
