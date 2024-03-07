<?php

declare(strict_types=1);

namespace App\Domain\Entities\Object\ValueObjects;

final readonly class Payload
{
    public function __construct(public mixed $payload)
    {

    }
}
