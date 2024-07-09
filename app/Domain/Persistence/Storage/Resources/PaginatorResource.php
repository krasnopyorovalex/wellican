<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Resources;

use Domain\Contracts\Persistence\DatabaseResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class PaginatorResource implements DatabaseResource
{
    public function __construct(private LengthAwarePaginator $collection)
    {
    }

    public function get(): LengthAwarePaginator
    {
        return $this->collection;
    }
}
