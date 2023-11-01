<?php

namespace App\Services;

use App\Enums\CurrencyConfigurationTypesEnum;
use App\Enums\PurchaseCurrenciesEnum;
use App\Repositories\CurrencyConfigurationRepository;
use App\Repositories\RateRepository;
use Illuminate\Support\Facades\Cache;

class ExchangeService
{
    protected RateRepository $rateRepository;
    protected CurrencyConfigurationRepository $currencyConfigurationRepository;

    public function __construct(
        RateRepository                  $rateRepository,
        CurrencyConfigurationRepository $currencyConfigurationRepository
    )
    {
        $this->rateRepository = $rateRepository;
        $this->currencyConfigurationRepository = $currencyConfigurationRepository;
    }

    public function calculateAmount(PurchaseCurrenciesEnum $from, float $amount, string $to): array
    {
        if (Cache::has("{$to} {$from->value}")) {
            $rate = Cache::get("{$to} {$from->value}");
        } else {
            $rate = $this->rateRepository->getRateByTarget($from->value);
        }

        $currencyConfigurations = $this->currencyConfigurationRepository->findByCurrency($from->value);
        $surcharge = $currencyConfigurations?->where('type', CurrencyConfigurationTypesEnum::SURCHARGE->value)->first()?->value;
        $discount = $currencyConfigurations?->where('type', CurrencyConfigurationTypesEnum::DISCOUNT->value)->first()?->value;
        $total = $amount * $rate;
        $surchargeAmount = null;
        $discountAmount = null;

        if ($surcharge) {
            $surchargeAmount = $surcharge / 100 * $total;
            $total = $total + (($surcharge / 100) * $total);
        }
        if ($discount) {
            $discountAmount = $discount / 100 * $total;
            $total = $total - (($discount / 100) * $total);
        }

        $data = [];
        $data['currency'] = $from->value;
        $data['rate'] = $rate;
        $data['foreignAmount'] = $amount;
        $data['amount'] = $amount * $rate;
        $data['surcharge'] = $surcharge;
        $data['surchargeAmount'] = $surchargeAmount;
        $data['discount'] = $discount;
        $data['discountAmount'] = $discountAmount;
        $data['totalAmount'] = $total;

        return $data;
    }

}
