<?php

declare(strict_types=1);

namespace Domain\Entities\Object\Requests;

use Domain\Contracts\Http\Request;

final class EditRequest implements Request
{
    public function __construct(public readonly int $id)
    {
    }
}
