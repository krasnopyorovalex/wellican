<?php

declare(strict_types=1);

namespace Domain\Entities\Info\Queries;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\HasEntity;
use Domain\Entities\Info\Info;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

final class GetByIdQuery implements Command, HasEntity
{
    private Model $entity;

    public function __construct(public readonly Request $request)
    {
    }

    public function handle(): void
    {
        $this->entity = Info::query()
            ->where('id', $this->request->getId())
            ->with(['image' => fn (MorphOne $query) => $query->withUrl(Info::class)])
            ->firstOrFail();
    }

    public function getEntity(): Model
    {
        return $this->entity;
    }
}
