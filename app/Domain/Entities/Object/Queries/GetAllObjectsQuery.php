<?php

declare(strict_types=1);

namespace Domain\Entities\Object\Queries;

use App\Domain\Contracts\Persistence\HasPayload;
use App\Domain\Entities\Object\ValueObjects\Payload;
use Domain\Contracts\Persistence\Command;
use App\Models\Objects;
use Domain\Entities\Object\Requests\IndexRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class GetAllObjectsQuery implements Command, HasPayload
{
    private const SELECT_COLUMNS = '
                id,
                type_id,
                name,
                type_purchase,
                format(square, 0, \'ru_RU\') as square,
                created_at,
                updated_at,
                format(price, 0, \'ru_RU\')  as price
            ';

    private LengthAwarePaginator $payload;

    public function __construct(private readonly IndexRequest $request)
    {
    }

    public function getPayload(): Payload
    {
        return new Payload($this->payload);
    }

    public function handle(): void
    {
        $query = Objects::query()
            ->selectRaw(self::SELECT_COLUMNS)
            ->with(['type' => fn(BelongsTo $belongsTo) => $belongsTo->select(['id', 'name'])]);

        $this->payload = $query->paginate(
            perPage: $this->request->limit,
            page: $this->request->offset
        );
    }
}
