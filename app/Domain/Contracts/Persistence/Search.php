<?php

declare(strict_types=1);

namespace Domain\Contracts\Persistence;

use Domain\Services\Search\Contracts\Searchable;
use Illuminate\Pagination\LengthAwarePaginator;

interface Search
{
    public function search(Searchable $searchable): LengthAwarePaginator;
}
