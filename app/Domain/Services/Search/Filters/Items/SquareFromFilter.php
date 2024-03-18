<?php

declare(strict_types=1);

namespace App\Domain\Services\Search\Filters\Items;

use Domain\Services\Search\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

final class SquareFromFilter extends Filter
{
    protected string $key = 'square_from';

    public function filter(Builder $builder, float|string $value): void
    {
        $builder->where('square', '>=', (int) $value);
    }
}
