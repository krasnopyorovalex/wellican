<?php

declare(strict_types=1);

namespace App\View\Composers;

use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Object\Enums\IsPremium;
use Domain\Entities\Object\Objects;
use Domain\Entities\Object\Requests\ObjectRequest;
use Domain\Persistence\Storage\Queries\GetAllQuery;
use Domain\Persistence\Storage\ValueObjects\WithRelations;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class PremiumComposer
{
    private static LengthAwarePaginator $collection;

    public function __construct(private readonly Storage $storage)
    {
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        if (! isset(self::$collection)) {
            self::$collection = $this->storage->getAll(
                new GetAllQuery(
                    ObjectRequest::fromArray(['isPremium' => IsPremium::Yes->value, 'limit' => 6]),
                    new Objects(),
                    new WithRelations(['images'])
                )
            );
        }

        $view->with('premiumObjects', self::$collection);
    }
}
