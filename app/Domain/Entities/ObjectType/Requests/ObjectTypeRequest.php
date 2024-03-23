<?php

declare(strict_types=1);

namespace App\Domain\Entities\ObjectType\Requests;

use Domain\Contracts\Http\Request;

final class ObjectTypeRequest extends Request
{
    protected string $name;

    protected string $description;

    protected int $position;

    protected string $orderBy = 'position';

    public function toDatabase(): array
    {
        return array_filter([
            'name' => $this->name ?? null,
            'alias' => $this->alias ?? null,
            'description' => $this->description ?? '',
            'position' => $this->position ?? null,
        ], fn ($el) => ! is_null($el));
    }
}
