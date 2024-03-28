<?php

declare(strict_types=1);

namespace App\Observers;

use Domain\Entities\Object\Objects;
use Domain\Entities\Object\ValueObjects\Articul;

class ObjectObserver
{
    /**
     * Handle the Objects "created" event.
     */
    public function creating(Objects $objects): void
    {
        $lastInsertedId = $objects->newQuery()->latest()->first('id') !== null
            ? $objects->newQuery()->latest()->first('id')->id
            : 0;

        $articul = new Articul($lastInsertedId);
        $objects->articul = $articul->generate();
    }
}
