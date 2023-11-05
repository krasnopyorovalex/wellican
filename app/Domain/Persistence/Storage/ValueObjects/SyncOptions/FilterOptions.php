<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\ValueObjects\SyncOptions;

use Domain\Contracts\Persistence\SyncOptions;

final class FilterOptions implements SyncOptions
{
    private const METHOD_FOR_SYNC = 'filterOptions';

    public function __construct(private readonly array $options)
    {
    }

    public function getValues(): array
    {
        $values = [];

        foreach ($this->options as $options) {
            $values = array_merge(array_filter($options), $values);
        }

        return $values;
    }

    public function hasValues(): bool
    {
        return count($this->options) > 0;
    }

    public function getMethodForSync(): string
    {
        return self::METHOD_FOR_SYNC;
    }
}
