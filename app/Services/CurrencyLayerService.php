<?php

namespace App\Services;

use App\Contracts\CurrencyRatesInterface;
use App\Http\Responses\CurrencyRatesResponse;
use App\Http\Transformers\Api\V1\CurrencyRatesTransformer;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class CurrencyLayerService implements CurrencyRatesInterface
{
    protected CurrencyRatesTransformer $currencyRatesTransformer;

    public function __construct(CurrencyRatesTransformer $currencyRatesTransformer)
    {
        $this->currencyRatesTransformer = $currencyRatesTransformer;
    }

    /**
     * @throws RequestException
     * @throws Throwable
     */
    public function fetchCurrencyRates(string $source, array $currencies): CurrencyRatesResponse
    {
        $accessKey = config('services.currency_layer.access_key');
        $url = config('services.currency_layer.api_url') . '/live';
        try {
            $response = Http::get($url, [
                'access_key' => $accessKey,
                'source' => $source,
                'currencies' => implode(',', $currencies),
            ]);

            if (!$response->successful()) {
                $response->throw();
            }
            return $this->currencyRatesTransformer->transform($response->json());
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
