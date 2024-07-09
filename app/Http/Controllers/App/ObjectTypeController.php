<?php

declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Domain\Entities\ObjectType\Requests\ObjectTypeRequest;
use App\Http\Controllers\Controller;
use Domain\Contracts\Persistence\Search;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\ObjectType\ObjectType;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Domain\Services\Search\Requests\SearchRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Requests\App\Search\SearchRequest as HttpSearchRequest;

class ObjectTypeController extends Controller
{
    public function __construct(private readonly Storage $storage, private readonly Search $search)
    {
    }

    public function __invoke(HttpSearchRequest $request, string $alias): View|\Illuminate\Foundation\Application|Factory|Application
    {
        /** @var ObjectType $objectType */
        $objectType = $this->storage->getByQuery(
            new GetByRequestQuery(ObjectTypeRequest::fromArray(['alias' => $alias]), new ObjectType())
        );

        $objects = $this->search->search(
            new SearchRequest(array_merge($request->validated(), ['type_id' => $objectType->id]))
        );

        return view('app.object-types.index', ['objectType' => $objectType, 'objects' => $objects]);
    }
}
