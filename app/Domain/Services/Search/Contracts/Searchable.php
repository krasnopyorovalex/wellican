<?php

namespace Domain\Services\Search\Contracts;

interface Searchable
{
    public function getParams(): array;

    public function getSort(): string;
}
