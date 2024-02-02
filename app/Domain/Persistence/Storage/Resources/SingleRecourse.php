<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Resources;

use Domain\Contracts\Persistence\DatabaseResource;
use Illuminate\Database\Eloquent\Model;

final class SingleRecourse implements DatabaseResource
{
    public function __construct(private readonly Model $model)
    {
    }

    public function get(): Model
    {
        return $this->model;
    }
}
