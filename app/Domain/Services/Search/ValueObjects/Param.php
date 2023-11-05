<?php

declare(strict_types=1);

namespace Domain\Services\Search\ValueObjects;

use Illuminate\Database\Eloquent\Builder;

class Param
{
    public function __construct(
        private readonly Builder $builder,
        private readonly string $key,
        private readonly mixed $param
    ) {

    }

    public function getBuilder(): Builder
    {
        return $this->builder;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getParam(): mixed
    {
        return $this->param;
    }
}
