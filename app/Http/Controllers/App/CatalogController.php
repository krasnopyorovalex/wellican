<?php

declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Search\SearchRequest as HttpSearchRequest;
use Domain\Contracts\Persistence\Search;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Page\Page;
use Domain\Entities\Page\Requests\PageRequest;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Domain\Services\Search\Requests\SearchRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    public function __construct(private readonly Storage $storage, private readonly Search $search)
    {
    }

    public function __invoke(HttpSearchRequest $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        /** @var Page $page */
        $catalog = $this->storage->getByQuery(
            new GetByRequestQuery(PageRequest::fromArray(['alias' => 'catalog']), new Page())
        );

        $objects = $this->search->search(new SearchRequest($request->validated()));

        return view('app.catalog.index', ['objects' => $objects, 'catalog' => $catalog]);
    }
}
