<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Resources;

use Domain\Contracts\Persistence\DatabaseResource;
use Illuminate\Database\Eloquent\Collection;

final class CollectionResource implements DatabaseResource
{
    public function __construct(private readonly Collection $collection)
    {
    }

    public function get(): Collection
    {
        return $this->collection;
    }
}
