<?php

declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Page\Page;
use Domain\Entities\Page\Requests\PageRequest;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function __construct(private readonly Storage $storage)
    {
    }

    public function __invoke(string $alias): View|\Illuminate\Foundation\Application|Factory|Application
    {
        /** @var Page $page */
        $page = $this->storage->getByQuery(
            new GetByRequestQuery(PageRequest::fromArray(['alias' => $alias]), new Page())
        );

        return view(sprintf('app.pages.%s', $page->template), ['page' => $page, 'objects' => $objects ?? []]);
    }
}
