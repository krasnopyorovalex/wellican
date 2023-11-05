<?php

declare(strict_types=1);

namespace Domain\Entities\Image\Queries;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\HasEntity;
use Domain\Entities\Image\Image;
use Illuminate\Database\Eloquent\Model;

final class GetByIdQuery implements Command, HasEntity
{
    private Model $entity;

    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        $this->entity = Image::query()->where('id', $this->request->getId())->firstOrFail();
    }

    public function getEntity(): Model
    {
        return $this->entity;
    }
}
