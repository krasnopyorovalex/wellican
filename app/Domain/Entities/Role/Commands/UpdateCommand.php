<?php

declare(strict_types=1);

namespace Domain\Entities\Role\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Entities\Role\ValueObjects\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasPermissions;

class UpdateCommand implements Command
{
    public function __construct(private readonly Request $request, private readonly Permission $permission)
    {
    }

    public function handle(): void
    {
        $role = Role::query()
            ->where('id', $this->request->getId())
            ->firstOrFail();

        $role->update($this->request->toDatabase());

        /** @var HasPermissions $role */
        $role->syncPermissions($this->permission->getPermissions());
    }
}
