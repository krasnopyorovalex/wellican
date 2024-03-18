<?php

declare(strict_types=1);

namespace App\Domain\Services\Search\Filters\Items;

use Domain\Services\Search\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

final class PriceFromFilter extends Filter
{
    protected string $key = 'price_from';

    public function filter(Builder $builder, float|string $value): void
    {
        $builder->where('price', '>=', (int) $value);
    }
}
