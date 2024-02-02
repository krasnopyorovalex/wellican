<?php

namespace Domain\Contracts\Persistence;

interface SyncOptions
{
    public function getValues(): array;

    public function hasValues(): bool;

    public function getMethodForSync(): string;
}
