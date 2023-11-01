<?php

namespace App\Services;

use App\Enums\PurchaseCurrenciesEnum;
use App\Http\Responses\JsonResponseApi;
use App\Http\Transformers\Api\V1\OrderDataTransformer;
use App\Repositories\OrderRepository;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderService
{
    protected ExchangeService $exchangeService;
    protected OrderRepository $orderRepository;
    protected OrderDataTransformer $orderDataTransformer;
    protected EmailService $emailService;

    public function __construct(
        ExchangeService      $exchangeService,
        OrderRepository      $orderRepository,
        OrderDataTransformer $orderDataTransformer,
        EmailService         $emailService
    )
    {
        $this->exchangeService = $exchangeService;
        $this->orderRepository = $orderRepository;
        $this->orderDataTransformer = $orderDataTransformer;
        $this->emailService = $emailService;
    }

    public function createOrder(PurchaseCurrenciesEnum $from, float $amount, float $totalAmount, string $to): void
    {
        $data = $this->exchangeService->calculateAmount($from, $amount, $to);

        if ($data['totalAmount'] !== $totalAmount) {
            throw new HttpResponseException(JsonResponseApi::error("Error", 'There have been changes to the terms of purchase'));
        }

        $orderData = $this->orderDataTransformer->transform($data);
        $order = $this->orderRepository->create($orderData);

        if ($order->foreign_currency === PurchaseCurrenciesEnum::BRITISH_POUND->value) {
            $this->emailService->sendOrderConfirmationMail($order);
        }
    }
}
