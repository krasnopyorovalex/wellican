<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\DatabaseResource;
use Domain\Contracts\Persistence\SyncOptions;
use Domain\Persistence\Storage\Resources\SingleRecourse;
use Illuminate\Database\Eloquent\Model;

final readonly class UpdateCommand implements Command
{
    public function __construct(
        private Request $request,
        private Model $model,
        private ?SyncOptions $syncOptions = null
    ) {
    }

    public function handle(): DatabaseResource
    {
        $entity = $this->model::query()
            ->where('id', $this->request->getId())
            ->firstOrFail();

        $entity->update($this->request->toDatabase());

        if ($this->syncOptions && $this->syncOptions->hasValues()) {
            $entity->{$this->syncOptions->getMethodForSync()}()->sync($this->syncOptions->getValues());
        }

        return new SingleRecourse($entity);
    }
}
