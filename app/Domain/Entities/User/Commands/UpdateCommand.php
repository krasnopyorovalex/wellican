<?php

declare(strict_types=1);

namespace Domain\Entities\User\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Entities\User\User;
use Domain\Entities\User\ValueObjects\Role;
use Spatie\Permission\Traits\HasRoles;

class UpdateCommand implements Command
{
    public function __construct(private readonly Request $request, private readonly Role $role)
    {
    }

    public function handle(): void
    {
        $user = User::query()
            ->where('id', $this->request->getId())
            ->firstOrFail();

        $user->update($this->request->toDatabase());

        /** @var HasRoles $user */
        $user->syncRoles([$this->role->getId()]);
        $user->syncPermissions($this->role->getPermissions());
    }
}
