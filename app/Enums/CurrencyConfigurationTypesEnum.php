<?php

namespace App\Enums;

enum CurrencyConfigurationTypesEnum: string
{
    case SURCHARGE = 'surcharge';
    case DISCOUNT = 'discount';
}
