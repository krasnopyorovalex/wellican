<?php

declare(strict_types=1);

namespace App\Domain\Entities\Object\Requests;

use Domain\Contracts\Http\Request;

final class DestroyRequest implements Request
{
    public function __construct(public readonly int $id)
    {
    }
}
