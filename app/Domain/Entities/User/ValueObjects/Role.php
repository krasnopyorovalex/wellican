<?php

declare(strict_types=1);

namespace Domain\Entities\User\ValueObjects;

class Role
{
    public function __construct(private readonly int $id, private readonly array $permissions = [])
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }
}
