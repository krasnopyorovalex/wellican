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

class StoreUserCommand implements Command
{
    public function __construct(
        private readonly Request $request,
        private readonly Model $model,
        private readonly Role $role,
    ) {
    }

    public function handle(): DatabaseResource
    {
        /** @var HasRoles $user */
        $user = $this->model::query()
            ->create($this->request->toDatabase());

        $user->assignRole([$this->role->getId()]);

        /** @var Model $user */
        return new SingleRecourse($user);
    }
}
