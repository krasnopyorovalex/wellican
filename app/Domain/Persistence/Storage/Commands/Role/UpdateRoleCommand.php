<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Commands\Role;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\DatabaseResource;
use Domain\Entities\Role\ValueObjects\Permission;
use Domain\Persistence\Storage\Resources\SingleRecourse;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions;

readonly class UpdateRoleCommand implements Command
{
    public function __construct(
        private Request $request,
        private Model $model,
        private Permission $permission
    ) {
    }

    public function handle(): DatabaseResource
    {
        $role = $this->model::query()
            ->where('id', $this->request->getId())
            ->firstOrFail();

        $role->update($this->request->toDatabase());

        /** @var HasPermissions $role */
        $role->syncPermissions($this->permission->getPermissions());

        return new SingleRecourse($role);
    }
}
