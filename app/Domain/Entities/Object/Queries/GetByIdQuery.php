<?php

declare(strict_types=1);

namespace Domain\Entities\Object\Queries;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\HasEntity;
use Domain\Entities\Object\Objects;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class GetByIdQuery implements Command, HasEntity
{
    private Model $entity;

    public function __construct(public readonly Request $request)
    {
    }

    public function handle(): void
    {
        $this->entity = Objects::query()
            ->with(['images' => fn (HasMany $query) => $query->withUrls()])
            ->where('id', $this->request->getId())
            ->firstOrFail();
    }

    public function getEntity(): Model
    {
        return $this->entity;
    }
}
