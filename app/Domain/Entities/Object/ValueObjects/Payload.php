<?php

declare(strict_types=1);

namespace App\Domain\Entities\Object\ValueObjects;

final class Payload
{
    public function __construct(public readonly mixed $payload)
    {

    }
}
