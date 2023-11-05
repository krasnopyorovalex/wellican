<?php

declare(strict_types=1);

namespace Domain\Entities\Info\Commands;

use Domain\Contracts\Persistence\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

final class StoreCommand extends Command
{
    public function handle(): Model|Collection|LengthAwarePaginator
    {
        return $this->model::query()->create($this->request->toDatabase());
    }

}
