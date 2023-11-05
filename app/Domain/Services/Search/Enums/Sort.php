<?php

declare(strict_types=1);

namespace Domain\Services\Search\Enums;

enum Sort: string
{
    case DEFAULT = 'id';
    case CREATED_AT = 'created_at';
}
