<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\ValueObjects;

final class WithRelations
{
    public function __construct(private readonly array $with)
    {

    }

    public function getWith(): array
    {
        return $this->with;
    }
}
