<?php

declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Search\SearchRequest as HttpSearchRequest;
use Domain\Contracts\Persistence\Search;
use Domain\Services\Search\Requests\SearchRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    public function __construct(private readonly Search $search)
    {
    }

    public function __invoke(HttpSearchRequest $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $objects = $this->search->search(new SearchRequest($request->validated()));

        return view('app.catalog.index', ['objects' => $objects]);
    }
}
