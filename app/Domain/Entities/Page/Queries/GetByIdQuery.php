<?php

declare(strict_types=1);

namespace Domain\Entities\Page\Queries;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\HasEntity;
use Domain\Entities\Page\Page;
use Illuminate\Database\Eloquent\Model;

final class GetByIdQuery implements Command, HasEntity
{
    private Model $entity;

    public function __construct(public readonly Request $request)
    {
    }

    public function handle(): void
    {
        $this->entity = Page::query()->where('id', $this->request->getId())->firstOrFail();
    }

    public function getEntity(): Model
    {
        return $this->entity;
    }
}
