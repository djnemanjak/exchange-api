<?php

namespace App\Utils;

use App\Enums\PurchaseCurrenciesEnum;
use App\Exceptions\InvalidEnumValueException;

class EnumCuster
{
    /**
     * @throws InvalidEnumValueException
     */
    public static function castPurchaseCurrencyEnum($value): PurchaseCurrenciesEnum {
        return match ($value) {
            PurchaseCurrenciesEnum::EURO->value => PurchaseCurrenciesEnum::EURO,
            PurchaseCurrenciesEnum::BRITISH_POUND->value => PurchaseCurrenciesEnum::BRITISH_POUND,
            PurchaseCurrenciesEnum::JAPANESE_YEN->value => PurchaseCurrenciesEnum::JAPANESE_YEN,
            default => throw new InvalidEnumValueException(),
        };
    }
}
