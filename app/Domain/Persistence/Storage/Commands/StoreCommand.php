<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Commands;

use Domain\Contracts\Persistence\DatabaseResource;
use Domain\Contracts\Persistence\EntityCommand;
use Domain\Persistence\Storage\Resources\SingleRecourse;

final class StoreCommand extends EntityCommand
{
    public function handle(): DatabaseResource
    {
        $entity = $this->model::query()
            ->create($this->request->toDatabase());

        return new SingleRecourse($entity);
    }
}
