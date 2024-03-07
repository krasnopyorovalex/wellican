<?php

declare(strict_types=1);

namespace Domain\Services\Search\Requests;

use Domain\Services\Search\Contracts\Searchable;
use Domain\Services\Search\Enums\Sort;
use Illuminate\Support\Str;
use ReflectionProperty;

final class SearchRequest implements Searchable
{
    private string $name;

    private int $priceFrom;

    private int $priceTo;

    private int $squareFrom;

    private int $squareTo;

    private string $typePurchase;

    private int $typeId;

    private int $locationId;

    private string $isPremium;

    private string $sort;

    private array $options;

    private array $between;

    public function __construct(array $values)
    {
        foreach ($values as $key => $value) {
            $property = Str::camel($key);
            if (property_exists($this, $property)) {
                $rp = new ReflectionProperty($this, $property);

                $this->{$property} = match ($rp->getType()->getName()) {
                    'int' => (int) $value,
                    'string' => (string) $value,
                    'float' => (float) $value,
                    'array' => (array) $value
                };
            }
        }
    }

    public function getParams(): array
    {
        return array_filter([
            'name' => $this->name ?? false,
            'price_from' => $this->priceFrom ?? false,
            'price_to' => $this->priceTo ?? false,
            'square_from' => $this->squareFrom ?? false,
            'square_to' => $this->squareTo ?? false,
            'type_purchase' => $this->typePurchase ?? false,
            'square' => $this->square ?? false,
            'type_id' => $this->typeId ?? false,
            'location_id' => $this->locationId ?? false,
            'is_premium' => $this->isPremium ?? false,
            'options' => $this->options ?? false,
            'between' => $this->between ?? false,
        ]);
    }

    public function getSort(): string
    {
        return $this->sort ?? Sort::DEFAULT->value;
    }
}
