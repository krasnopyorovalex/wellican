<?php

declare(strict_types=1);

namespace Domain\Entities\Object\Enums;

enum IsPremium: string
{
    case Yes = 'yes';
    case Not = 'not';
}
