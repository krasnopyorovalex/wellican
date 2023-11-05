<?php

declare(strict_types=1);

namespace Domain\Entities\Role\Queries;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\HasEntity;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

final class GetByIdQuery implements Command, HasEntity
{
    private Model $entity;

    public function __construct(public readonly Request $request)
    {
    }

    public function handle(): void
    {
        $this->entity = Role::query()
            ->with(['permissions'])
            ->where('id', $this->request->getId())
            ->firstOrFail();
    }

    public function getEntity(): Model
    {
        return $this->entity;
    }
}
