<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['source_currency_id', 'target_currency_id', 'rate'];

    /**
     * @var array<string>
     */
    protected $casts = [
        'rate' => 'float',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'source_currency_id');
    }

    public function target(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'target_currency_id');
    }
}
