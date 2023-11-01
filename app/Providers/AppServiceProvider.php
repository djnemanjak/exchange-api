<?php

namespace App\Providers;

use App\Contracts\CurrencyRatesInterface;
use App\Services\CurrencyLayerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CurrencyRatesInterface::class, CurrencyLayerService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
