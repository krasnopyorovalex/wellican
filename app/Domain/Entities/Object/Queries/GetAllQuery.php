<?php

declare(strict_types=1);

namespace Domain\Entities\Object\Queries;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\HasPaginator;
use Domain\Entities\Object\Objects;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;

final class GetAllQuery implements Command, HasPaginator
{
    private const SELECT_COLUMNS = '
                id,
                alias,
                type_id,
                name,
                type_purchase,
                format(square, 1, \'ru_RU\') as square,
                created_at,
                updated_at,
                format(price, 0, \'ru_RU\')  as price
            ';

    private LengthAwarePaginator $collection;

    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        $query = Objects::query()
            ->selectRaw(self::SELECT_COLUMNS)
            ->with(['type' => fn (BelongsTo $belongsTo) => $belongsTo->select(['id', 'name'])])
            ->orderByDesc('created_at');

        $this->collection = $query->paginate(
            perPage: $this->request->getLimit(),
            page: $this->request->getOffset()
        );
    }

    public function getCollection(): LengthAwarePaginator
    {
        return $this->collection;
    }
}
