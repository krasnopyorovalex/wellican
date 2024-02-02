<?php

namespace Domain\Contracts\Persistence;

use Illuminate\Database\Eloquent\Collection;

interface HasCollection
{
    public function getCollection(): Collection;
}
