<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\ValueObjects;

final readonly class WithRelations
{
    public function __construct(private array $with)
    {

    }

    public function getWith(): array
    {
        return $this->with;
    }
}
