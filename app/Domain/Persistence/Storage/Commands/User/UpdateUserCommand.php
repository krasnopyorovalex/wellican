<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Commands\User;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\DatabaseResource;
use Domain\Entities\User\ValueObjects\Role;
use Domain\Persistence\Storage\Resources\SingleRecourse;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class UpdateUserCommand implements Command
{
    public function __construct(
        private readonly Request $request,
        private readonly Model $model,
        private readonly Role $role,
    ) {
    }

    public function handle(): DatabaseResource
    {
        $user = $this->model::query()
            ->where('id', $this->request->getId())
            ->firstOrFail();

        $user->update($this->request->toDatabase());

        /** @var HasRoles $user */
        $user->syncRoles([$this->role->getId()]);
        $user->syncPermissions($this->role->getPermissions());

        return new SingleRecourse($user);
    }
}
