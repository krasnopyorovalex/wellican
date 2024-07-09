<?php

declare(strict_types=1);

namespace Domain\Contracts\Http;

use Illuminate\Support\Str;
use ReflectionProperty;

abstract class Request
{
    public const array EMPTY_VALUES = [
        'limit' => 0,
        'offset' => 0,
    ];

    protected string $selectCols = '*';

    protected int $id;

    protected string $alias;

    protected int $parentId;

    protected int $limit = 0;

    protected int $offset = 0;

    protected string $orderBy = '';

    final public function __construct()
    {
    }

    final public static function fromArray(array $values): static
    {
        $self = new static();

        foreach ($values as $key => $value) {
            $property = Str::camel($key);
            if (property_exists($self, $property)) {
                $rp = new ReflectionProperty($self, $property);

                $type = $rp->getType() ? $rp->getType()->getName() : 'string';

                $self->{$property} = match ($type) {
                    'int' => (int) $value,
                    'string' => (string) $value,
                    'float' => (float) $value
                };
            }
        }

        return $self;
    }

    final public function getLimit(): int
    {
        return $this->limit;
    }

    final public function getOffset(): int
    {
        return $this->offset;
    }

    final public function getId(): int
    {
        return $this->id;
    }

    final public function getSelectFields(): string
    {
        return $this->selectCols;
    }

    final public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    public function toWhere(): array
    {
        return array_filter([
            'id' => $this->id ?? 0,
            'alias' => $this->alias ?? false,
        ]);
    }

    abstract public function toDatabase(): array;
}
