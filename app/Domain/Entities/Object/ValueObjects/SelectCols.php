<?php

declare(strict_types=1);

namespace App\Domain\Entities\Object\ValueObjects;

final class SelectCols
{
    public const string COLS = '
        id,
        alias,
        articul,
        type_id,
        location_id,
        label_id,
        name,
        address,
        type_purchase,
        description,
        is_premium,
        format(square, 1, \'ru_RU\') as square,
        created_at,
        updated_at,
        format(price, 0, \'ru_RU\')  as price,
        latitude,
        longitude
    ';
}
