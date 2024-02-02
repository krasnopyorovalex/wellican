<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\ValueObjects;

use Domain\Exceptions\IdException;

final class Message
{
    private Id $id;

    private string $value = '';

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function hasId(): bool
    {
        return isset($this->id);
    }

    /**
     * @throws IdException
     */
    public function getId(): Id
    {
        if (! $this->hasId()) {
            throw IdException::idRequired();
        }

        return $this->id;
    }

    public function setId(Id $id): void
    {
        $this->id = $id;
    }
}
