<?php

namespace Domain\Contracts\Persistence;

use Illuminate\Pagination\LengthAwarePaginator;

interface HasPaginator
{
    public function getCollection(): LengthAwarePaginator;
}
