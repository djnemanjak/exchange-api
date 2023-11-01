<?php

namespace App\Repositories;

use App\Models\Currency;

class CurrencyRepository
{
    protected Currency $model;

    public function __construct(Currency $model)
    {
        $this->model = $model;
    }

    public function findByCode(string $code): mixed
    {
        return $this->model->where('code', $code)->first();
    }

    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }
}
