<?php

declare(strict_types=1);

namespace App\View\Composers;

use App\Domain\Entities\ObjectType\Requests\ObjectTypeRequest;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Location\Location;
use Domain\Persistence\Storage\Queries\GetAllQuery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class LocationComposer
{
    private static Collection $collection;

    public function __construct(private readonly Storage $storage)
    {
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        if (! isset(self::$collection)) {
            self::$collection = $this->storage->getAll(new GetAllQuery(ObjectTypeRequest::fromArray([]), new Location()));
        }

        $view->with('locations', self::$collection);
    }
}
