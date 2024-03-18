<?php

declare(strict_types=1);

namespace App\Domain\Services\Search\Filters\Items;

use Domain\Entities\FilterOption\FilterOption;
use Domain\Services\Search\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

final class BetweenFilter extends Filter
{
    protected string $key = 'between';

    public function filter(Builder $builder, mixed $value): void
    {
        $filterOptionsBuilder = FilterOption::query()
            ->select('object_filters.object_id');

        foreach ($value as $filterId => $between) {
            $filterOptionsBuilder
                ->where('filter_options.filter_id', $filterId)
                ->join('object_filters', 'filter_options.id', '=', 'object_filters.filter_option_id');

            if (isset($between['from'])) {
                $filterOptionsBuilder->where('filter_options.value', '>=', (int) $between['from']);
            }

            if (isset($between['to'])) {
                $filterOptionsBuilder->where('filter_options.value', '<=', (int) $between['to']);
            }
        }

        $collection = $filterOptionsBuilder->get();
        $collection->count()
            ? $builder->whereIn('id', $collection->map(fn ($item) => $item->object_id)->toArray())
            : $builder->where('type_id', 0);
    }
}
