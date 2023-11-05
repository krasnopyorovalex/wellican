<?php

declare(strict_types=1);

namespace Domain\Services\Search\Filters\Items;

use Domain\Services\Search\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

final class TypeIdFilter extends Filter
{
    protected string $key = 'type_id';

    public function filter(Builder $builder, float|string $value): void
    {
        $builder->where($this->key, (int) $value);
    }
}
