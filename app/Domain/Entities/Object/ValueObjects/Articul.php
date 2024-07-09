<?php

declare(strict_types=1);

namespace Domain\Entities\Object\ValueObjects;

final class Articul
{
    private const string PLACEHOLDER = '%s-%05d';

    public function __construct(private readonly int $value)
    {

    }

    public function generate(): string
    {
        return sprintf(self::PLACEHOLDER, config('app.articul_prefix'), $this->value + 1);
    }
}
