<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code'];

    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class, 'source_currency_id');
    }

    public function currencyConfigurations(): HasMany
    {
        return $this->hasMany(CurrencyConfiguration::class, 'currency_id');
    }
}
