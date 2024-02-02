<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\ValueObjects;

final class Select
{
    public function __construct(private readonly string $selectCols)
    {

    }

    public function getSelectCols(): string
    {
        return $this->selectCols;
    }
}
