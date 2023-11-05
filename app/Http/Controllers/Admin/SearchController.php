<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Search\SearchRequest as SearchRequestForm;
use Domain\Contracts\Persistence\Search;
use Domain\Services\Search\Requests\SearchRequest;

final class SearchController extends Controller
{
    public function __construct(private readonly Search $search)
    {
    }

    public function __invoke(SearchRequestForm $request)
    {
        $payload = $this->search->search(new SearchRequest($request->validated()));

        dd($payload);
    }
}
