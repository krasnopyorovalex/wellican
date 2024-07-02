<?php

declare(strict_types=1);

namespace Domain\Services\Search\Filters\Items;

use Domain\Entities\Object\ObjectFilters;
use Domain\Services\Search\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

final class OptionsFilter extends Filter
{
    protected string $key = 'options';

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
            ->havingRaw('COUNT(distinct `filter_id`) = '.count($value))
            ->get();

        $collection->count()
            ? $builder->whereIn('id', $collection->map(fn ($item) => $item->object_id)->toArray())
            : $builder->where('type_id', 0);
    }
}
