<?php

declare(strict_types=1);

namespace Domain\Entities\Role\ValueObjects;

class Permission
{
    public function __construct(private readonly array $permissions)
    {
        if (! count($this->permissions)) {
            throw new \InvalidArgumentException(__('permissions.errors.argument'));
        }
    }

    public function getPermissions(): array
    {
        return array_map(static fn ($permission) => (int) $permission, $this->permissions);
    }
}
