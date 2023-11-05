<?php

declare(strict_types=1);

namespace Domain\Entities\User\Queries;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\HasEntity;
use Domain\Entities\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class GetByIdQuery implements Command, HasEntity
{
    private Model $entity;

    public function __construct(public readonly Request $request)
    {
    }

    public function handle(): void
    {
        $this->entity = User::query()
            ->where('id', $this->request->getId())
            ->with(['image' => fn (MorphOne $query) => $query->withUrl(User::class)])
            ->firstOrFail();
    }

    public function getEntity(): Model
    {
        return $this->entity;
    }
}
