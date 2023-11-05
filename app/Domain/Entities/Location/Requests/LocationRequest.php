<?php

declare(strict_types=1);

namespace Domain\Entities\Location\Requests;

use Domain\Contracts\Http\Request;

final class LocationRequest extends Request
{
    protected string $name;

    protected string $alias;

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
