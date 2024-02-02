<?php

namespace Domain\Services\Search\Contracts;

use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    protected string $key;

    abstract public function filter(Builder $builder, float|string $value): void;

    public function isEqual(string $key): bool
    {
        return $key === $this->key;
    }
}
