<?php

namespace Domain\Contracts\Persistence;

use Illuminate\Database\Eloquent\Model;

interface GetByRequest
{
    public function getByQuery(Command $query): Model;
}
