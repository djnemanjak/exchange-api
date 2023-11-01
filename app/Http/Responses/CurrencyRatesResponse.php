<?php

namespace App\Http\Responses;

class CurrencyRatesResponse
{
    public string $source;
    public array $targets;

    public function __construct(string $source, array $targets)
    {
        $this->source = $source;
        $this->targets = $targets;
    }
}
