<?php

declare(strict_types=1);

namespace Domain\Services\Search\Filters\Items;

use Domain\Entities\Object\ObjectFilters;
use Domain\Services\Search\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

final class FilterOptionsFilter extends Filter
{
    protected string $key = 'filter_options';

    public function filter(Builder $builder, mixed $value): void
    {
        $filterOptions = array_reduce(
            (array) $value,
            fn ($carry, $filterOptions) => array_merge($carry, $filterOptions),
            []
        );

        $collection = ObjectFilters::query()
            ->select('object_id')
            ->whereIn('filter_option_id', $filterOptions)
            ->groupBy('object_id')
            ->havingRaw('COUNT(`object_id`) = '.count($value))
            ->get();

        $builder->whereIn('id', $collection->toArray());
    }
}
