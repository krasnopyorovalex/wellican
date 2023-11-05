<?php

declare(strict_types=1);

namespace Domain\Entities\Permission\Requests;

use Domain\Contracts\Http\Request;

final class PermissionRequest extends Request
{
    protected string $name;

    protected string $guardName;

    public function toDatabase(): array
    {
        return [
            'name' => $this->name,
            'guard_name' => $this->guardName,
        ];
    }
}
