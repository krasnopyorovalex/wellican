<?php

declare(strict_types=1);

namespace App\Domain\Entities\ObjectType\Requests;

use Domain\Contracts\Http\Request;

final class ObjectTypeRequest extends Request
{
    protected string $name;

    protected string $description;

    public function toDatabase(): array
    {
        return [
            'name' => $this->name,
            'alias' => $this->alias,
            'description' => $this->description,
        ];
    }
}
