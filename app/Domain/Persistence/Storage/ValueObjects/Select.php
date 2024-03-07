<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\ValueObjects;

final readonly class Select
{
    public function __construct(private string $selectCols)
    {

    }

    public function getSelectCols(): string
    {
        return $this->selectCols;
    }
}
