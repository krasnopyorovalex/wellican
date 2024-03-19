<?php

declare(strict_types=1);

namespace Domain\Entities\ObjectLabel\Requests;

use Domain\Contracts\Http\Request;

final class ObjectLabelRequest extends Request
{
    protected string $name;

    public function toDatabase(): array
    {
        return array_filter([
            'name' => $this->name,
        ]);
    }

    public function toWhere(): array
    {
        return ['id' => $this->id];
    }
}
