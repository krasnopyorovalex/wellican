<?php

declare(strict_types=1);

namespace Domain\Entities\Filter\Requests;

use Domain\Contracts\Http\Request;

final class FilterRequest extends Request
{
    protected string $name;

    public function toDatabase(): array
    {
        return array_filter([
            'parent_id' => $this->parentId ?? 0,
            'name' => $this->name,
        ]);
    }

    public function toWhere(): array
    {
        return array_filter([
            'id' => $this->id ?? 0,
            'parent_id' => $this->parentId ?? 0,
        ]);
    }
}
