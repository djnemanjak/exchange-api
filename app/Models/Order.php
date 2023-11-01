<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'foreign_currency',
        'exchange_rate',
        'surcharge_percentage',
        'surcharge_amount',
        'foreign_amount',
        'amount',
        'discount_percentage',
        'discount_amount',
    ];
}
