<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Resources;

use Domain\Contracts\Persistence\DatabaseResource;
use Illuminate\Database\Eloquent\Collection;

final readonly class CollectionResource implements DatabaseResource
{
    public function __construct(private Collection $collection)
    {
    }

    public function get(): Collection
    {
        return $this->collection;
    }
}
