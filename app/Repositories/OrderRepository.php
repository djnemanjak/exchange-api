<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    protected Order $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }
}
