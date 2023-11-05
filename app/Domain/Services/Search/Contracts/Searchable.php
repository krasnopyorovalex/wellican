<?php

namespace Domain\Services\Search\Contracts;

interface Searchable
{
    public function getParams(): array;
}
