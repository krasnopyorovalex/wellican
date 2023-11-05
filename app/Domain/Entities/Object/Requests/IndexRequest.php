<?php

declare(strict_types=1);

namespace Domain\Entities\Object\Requests;

use Domain\Contracts\Http\Request;

final class IndexRequest implements Request
{
    public function __construct(public readonly int $limit, public readonly int $offset)
    {

    }
}
