<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Commands;

use Domain\Contracts\Persistence\DatabaseResource;
use Domain\Contracts\Persistence\EntityCommand;
use Domain\Persistence\Storage\Resources\SingleRecourse;

final class DestroyCommand extends EntityCommand
{
    public function handle(): DatabaseResource
    {
        $entity = $this->model::query()
            ->where('id', $this->request->getId())
            ->firstOrFail();

        $entity->delete();

        return new SingleRecourse($entity);
    }
}
