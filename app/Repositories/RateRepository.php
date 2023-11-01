<?php

namespace App\Repositories;

use App\Models\Rate;
use Illuminate\Database\Eloquent\Builder;

class RateRepository
{
    protected Rate $model;

    public function __construct(Rate $model)
    {
        $this->model = $model;
    }

    public function getBySourceAndTarget(string $source, string $target): Builder|null
    {
        return $this->model->with('source', 'target')
            ->whereHas('source', function ($query) use ($source) {
                $query->where('code', $source);
            })
            ->whereHas('target', function ($query) use ($target) {
                $query->where('code', $target);
            })
            ->first();
    }

    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }

    public function getRateByTarget(string $target): mixed
    {
        return $this->model->with('target')
            ->whereHas('target', function ($query) use ($target) {
                $query->where('code', $target);
            })
            ->first()->rate;
    }
}
