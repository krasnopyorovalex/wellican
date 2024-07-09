<?php

declare(strict_types=1);

namespace Domain\Services\Search\Filters;

use Domain\Services\Search\Contracts\Apply;
use Domain\Services\Search\Contracts\Filter;
use Domain\Services\Search\ValueObjects\Param;

final class StackFilters implements Apply
{
    private array $filters = [];

    public function setFilter(Filter $filter): void
    {
        $this->filters[] = $filter;
    }

    public function apply(Param $param): void
    {
        foreach ($this->filters as $filter) {
            /** @var Filter $filter */
            if ($filter->isEqual($param->getKey())) {
                $filter->filter($param->getBuilder(), $param->getParam());
            }
        }
    }
}
