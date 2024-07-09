<?php

declare(strict_types=1);

namespace Domain\Entities\Object\ValueObjects;

final readonly class Payload
{
    public function __construct(public mixed $payload)
    {

    }
}
