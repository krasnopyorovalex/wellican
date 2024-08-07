<?php

declare(strict_types=1);

namespace Domain\Entities\Object\Requests;

use Domain\Entities\Object\ValueObjects\SelectCols;
use Domain\Contracts\Http\Request;

/**
 * ObjectRequest for CRUD actions
 */
final class ObjectRequest extends Request
{
    protected string $selectCols = SelectCols::COLS;

    protected string $name;

    protected string $alias;

    protected float $square;

    protected int $price;

    protected string $typePurchase;

    protected string $latitude;

    protected string $longitude;

    protected int $typeId;

    protected int $locationId;

    protected int $labelId;

    protected string $description;

    protected string $address;

    protected string $isPremium;

    protected string $orderBy = 'created_at DESC';

    public function toDatabase(): array
    {
        return [
            'name' => $this->name,
            'alias' => $this->alias,
            'square' => $this->square,
            'price' => $this->price,
            'type_purchase' => $this->typePurchase,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'type_id' => $this->typeId,
            'location_id' => $this->locationId,
            'label_id' => $this->labelId,
            'address' => $this->address,
            'description' => $this->description,
            'is_premium' => $this->isPremium,
        ];
    }

    final public function toWhere(): array
    {
        return array_filter(array_merge(
            parent::toWhere(),
            ['type_id' => $this->typeId ?? 0],
            ['is_premium' => $this->isPremium ?? '']
        ));
    }
}
