<?php

declare(strict_types=1);

namespace Domain\Entities\Object\Enums;

enum TypePurchase: string
{
    case Buy = 'buy';
    case Rent = 'rent';
}
