<?php

namespace Domain\Contracts\Persistence;

use Illuminate\Database\Eloquent\Model;

interface HasEntity
{
    public function getEntity(): Model;
}
