<?php

namespace Domain\Services\Search\Contracts;

use Domain\Services\Search\ValueObjects\Param;

interface Apply
{
    public function apply(Param $param): void;
}
