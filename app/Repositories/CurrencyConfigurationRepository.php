<?php

namespace App\Repositories;

use App\Models\CurrencyConfiguration;
use Illuminate\Database\Eloquent\Collection;

class CurrencyConfigurationRepository
{
    protected CurrencyConfiguration $model;

    public function __construct(CurrencyConfiguration $model)
    {
        $this->model = $model;
    }

    public function findByCurrency(string $currency): Collection|array
    {
        return $this->model->with('currency')
            ->whereHas('currency', function ($query) use ($currency) {
                $query->where('code', $currency);
            })
            ->get();
    }
}
