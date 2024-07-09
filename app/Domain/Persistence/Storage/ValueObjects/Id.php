<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\ValueObjects;

final readonly class Id
{
    public function __construct(private int $value)
    {
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
