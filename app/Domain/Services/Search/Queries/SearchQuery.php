<?php

declare(strict_types=1);

namespace App\Domain\Services\Search\Queries;

use App\Domain\Entities\Object\ValueObjects\SelectCols;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\DatabaseResource;
use Domain\Entities\Object\Objects;
use Domain\Persistence\Storage\Resources\PaginatorResource;
use Domain\Services\Search\Contracts\Searchable;
use Domain\Services\Search\Filters\StackFilters;
use Domain\Services\Search\ValueObjects\Param;

readonly class SearchQuery implements Command
{
    public function __construct(
        private Searchable $searchable,
        private StackFilters $stackFilters
    ) {
    }

    public function handle(): DatabaseResource
    {
        $builder = Objects::query()
            ->selectRaw(SelectCols::COLS)
            ->with(['location', 'images', 'type', 'label']);

        foreach ($this->searchable->getParams() as $key => $param) {
            $this->stackFilters->apply(new Param($builder, $key, $param));
        }

        $builder->orderBy($this->searchable->getSort());

        return new PaginatorResource($builder->paginate(
            perPage: config('database.per_page')
        ));
    }
}
