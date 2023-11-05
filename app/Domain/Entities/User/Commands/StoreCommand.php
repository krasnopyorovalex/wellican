<?php

declare(strict_types=1);

namespace Domain\Entities\User\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Entities\User\User;
use Domain\Entities\User\ValueObjects\Role;
use Spatie\Permission\Traits\HasRoles;

class StoreCommand implements Command
{
    public function __construct(private readonly Request $request, private readonly Role $role)
    {
    }

    public function handle(): void
    {
        /** @var HasRoles $user */
        $user = User::query()->create($this->request->toDatabase());

        $user->assignRole([$this->role->getId()]);
    }
}
