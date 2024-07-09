<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Search\SearchRequest as SearchRequestForm;
use Domain\Contracts\Persistence\Search;
use Domain\Services\Search\Requests\SearchRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class SearchController extends Controller
{
    public function __construct(private readonly Search $search)
    {
    }

    public function __invoke(SearchRequestForm $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $objects = $this->search->search(new SearchRequest($request->validated()));

        return view('admin.objects.index', ['objects' => $objects]);
    }
}
