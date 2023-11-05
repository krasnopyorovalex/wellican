<?php

declare(strict_types=1);

namespace Domain\Services\Search;

use App\Domain\Services\Search\Queries\SearchQuery;
use Domain\Contracts\Persistence\Handler;
use Domain\Contracts\Persistence\Search;
use Domain\Services\Search\Contracts\Searchable;
use Domain\Services\Search\Filters\StackFilters;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

final class MySqlSearch implements Search
{
    public function __construct(
        private readonly Handler $commandHandler,
        private readonly StackFilters $stackFilters
    ) {
    }

    public function search(Searchable $searchable): LengthAwarePaginator
    {
        try {
            $query = $this->commandHandler->execute(new SearchQuery($searchable, $this->stackFilters));

            return $query->get();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
