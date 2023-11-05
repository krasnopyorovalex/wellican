<?php

declare(strict_types=1);

namespace Domain\Entities\Page\Queries;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\HasPaginator;
use Domain\Entities\Page\Page;
use Illuminate\Pagination\LengthAwarePaginator;

final class GetAllQuery implements Command, HasPaginator
{
    private LengthAwarePaginator $collection;

    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        $this->collection = Page::query()->orderByDesc('created_at')
            ->paginate(
                perPage: $this->request->getLimit(),
                page: $this->request->getOffset()
            );
    }

    public function getCollection(): LengthAwarePaginator
    {
        return $this->collection;
    }
}
