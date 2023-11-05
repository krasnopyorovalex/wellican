<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\ValueObjects;

final class Id
{
    public function __construct(private readonly int $value)
    {
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
