<?php

declare(strict_types=1);

namespace Domain\Services\RelatedObjects\DataTransferObjects;

final class RelatedObjectsData
{
    public function __construct(public int $id, public int $typeId, public int $price, public float $square)
    {
    }
}
