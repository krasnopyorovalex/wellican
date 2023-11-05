<?php

declare(strict_types=1);

namespace App\Domain\Services\Search\Queries;

use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\DatabaseResource;
use Domain\Entities\Object\Objects;
use Domain\Persistence\Storage\Resources\CollectionResource;
use Domain\Services\Search\Contracts\Searchable;
use Domain\Services\Search\Filters\StackFilters;
use Domain\Services\Search\ValueObjects\Param;

class SearchQuery implements Command
{
    public function __construct(
        private readonly Searchable $searchable,
        private readonly StackFilters $stackFilters
    ) {
    }

    public function handle(): DatabaseResource
    {
        $query = Objects::query();

        foreach ($this->searchable->getParams() as $key => $param) {
            $this->stackFilters->apply(
                new Param($query, $key, $param)
            );
        }

        return new CollectionResource($query->get());

        //        dd($query->toRawSql());
    }
}
