<?php

declare(strict_types=1);

namespace App\Domain\Entities\Object\Enums;

enum TypePurchase: string
{
    case Buy = 'Buy';
    case Rent = 'Rent';
}
