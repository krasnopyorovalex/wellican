<?php

namespace Domain\Contracts\Persistence;

use Domain\Persistence\Storage\ValueObjects\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface Storage extends GetByRequest
{
    public function getAll(Command $command): LengthAwarePaginator|Collection;

    public function store(Command $command): Message;

    public function update(Command $command): Message;

    public function destroy(Command $command): Message;
}
