<?php

declare(strict_types=1);

namespace Domain\Entities\User\Queries;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\HasPaginator;
use Domain\Entities\User\User;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllQuery implements Command, HasPaginator
{
    private LengthAwarePaginator $collection;

    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        $this->collection = User::query()
            ->with(['roles.permissions', 'permissions'])
            ->orderByDesc('created_at')
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
