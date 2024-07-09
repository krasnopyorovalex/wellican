<?php

declare(strict_types=1);

namespace Domain\Services\RelatedObjects;

use Domain\Entities\Object\Objects;
use Domain\Entities\Object\ValueObjects\SelectCols;
use Domain\Services\RelatedObjects\DataTransferObjects\RelatedObjectsData;
use Illuminate\Database\Eloquent\Collection;

class RelatedObjectsService
{
    public function search(RelatedObjectsData $data): Collection
    {
        $priceFrom = $data->price - $data->price * (config('related_objects.price') / 100);
        $priceTo = $data->price + $data->price * (config('related_objects.price') / 100);

        $squareFrom = $data->square - $data->square * (config('related_objects.square') / 100);
        $squareTo = $data->square + $data->square * (config('related_objects.square') / 100);

        return Objects::query()
            ->selectRaw(SelectCols::COLS)
            ->where('type_id', $data->typeId)
            ->whereBetween('price', [$priceFrom, $priceTo])
            ->whereBetween('square', [$squareFrom, $squareTo])
            ->whereNot('id', $data->id)
            ->with(['images'])
            ->limit(config('related_objects.limit'))
            ->get();
    }
}
