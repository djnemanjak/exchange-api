<?php

namespace App\Services;

use App\Contracts\CurrencyRatesInterface;
use App\Repositories\CurrencyRepository;
use App\Repositories\RateRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

class RateService
{
    protected CurrencyRatesInterface $currencyLayerService;
    protected RateRepository $rateRepository;
    protected CurrencyRepository $currencyRepository;

    public function __construct(
        CurrencyRatesInterface $currencyLayerService,
        RateRepository         $rateRepository,
        CurrencyRepository     $currencyRepository
    )
    {
        $this->currencyLayerService = $currencyLayerService;
        $this->rateRepository = $rateRepository;
        $this->currencyRepository = $currencyRepository;
    }

    public function syncRates(string $source, array $currencies): void
    {
        try {
            $currency = $this->currencyRepository->findByCode($source);
            if (!$currency) {
                $currency = $this->currencyRepository->create(['code' => $source]);
            }
            $rates = $this->currencyLayerService->fetchCurrencyRates($source, $currencies);
            foreach ($rates->targets as $key => $value) {
                $rate = $this->rateRepository->getBySourceAndTarget($rates->source, $key);
                if ($rate) {
                    $rate->rate = $value;
                    $rate->save();
                } else {
                    $targetCurrency = $this->currencyRepository->findByCode($key);
                    if (!$targetCurrency) {
                        $targetCurrency = $this->currencyRepository->create(['code' => $key]);
                    }
                    $rate = $this->rateRepository->create(['source_currency_id' => $currency->id, 'target_currency_id' => $targetCurrency->id, 'rate' => $value]);
                }
                Cache::put("{$source} {$key}", $rate->rate);
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
        }
    }
}
