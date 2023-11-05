<?php

declare(strict_types=1);

namespace Domain\Entities\Permission\Queries;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\HasPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Permission\Models\Permission;

final class GetAllQuery implements Command, HasPaginator
{
    private LengthAwarePaginator $collection;

    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        $this->collection = Permission::query()->orderByDesc('created_at')
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
