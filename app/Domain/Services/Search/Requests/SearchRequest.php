<?php

declare(strict_types=1);

namespace Domain\Services\Search\Requests;

use Domain\Services\Search\Contracts\Searchable;
use Illuminate\Support\Str;
use ReflectionProperty;

final class SearchRequest implements Searchable
{
    private string $name;

    private int $price;

    private int $type;

    private string $purchase;

    private float $square;

    private int $typeId;

    private int $locationId;

    public function __construct(array $values)
    {
        foreach ($values as $key => $value) {
            $property = Str::camel($key);
            if (property_exists($this, $property)) {
                $rp = new ReflectionProperty($this, $property);

                $this->{$property} = match ($rp->getType()->getName()) {
                    'int' => (int) $value,
                    'string' => (string) $value,
                    'float' => (float) $value
                };
            }
        }
    }

    public function getParams(): array
    {
        return array_filter([
            'name' => $this->name ?? false,
            'price' => $this->price ?? false,
            'type' => $this->type ?? false,
            'purchase' => $this->purchase ?? false,
            'square' => $this->square ?? false,
            'type_id' => $this->typeId ?? false,
            'location_id' => $this->locationId ?? false,
        ]);
    }
}
