<?php

namespace Domain\Contracts\Persistence;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface DatabaseResource
{
    public function get(): Model|LengthAwarePaginator|Collection;
}
