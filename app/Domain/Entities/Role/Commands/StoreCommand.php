<?php

declare(strict_types=1);

namespace Domain\Entities\Role\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Spatie\Permission\Models\Role;

class StoreCommand implements Command
{
    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        Role::query()
            ->create($this->request->toDatabase());
    }
}
