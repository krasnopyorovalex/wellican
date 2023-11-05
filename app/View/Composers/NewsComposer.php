<?php

declare(strict_types=1);

namespace App\View\Composers;

use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Info\Info;
use Domain\Entities\Info\Requests\InfoRequest;
use Domain\Persistence\Storage\Queries\GetAllQuery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class NewsComposer
{
    private static Collection $collection;

    public function __construct(private readonly Storage $storage)
    {
    }

    public function compose(View $view): void
    {
        if (! isset(self::$collection)) {
            self::$collection = $this->storage->getAll(
                new GetAllQuery(InfoRequest::fromArray(['limit' => config('news_count_in_sidebar')]), new Info())
            );
        }

        $view->with('news', self::$collection);
    }
}
