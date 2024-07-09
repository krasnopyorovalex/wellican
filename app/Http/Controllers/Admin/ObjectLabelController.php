<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ObjectLabel\StoreObjectLabelRequest;
use App\Http\Requests\Admin\ObjectLabel\UpdateObjectLabelRequest;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\ObjectLabel\ObjectLabel;
use Domain\Entities\ObjectLabel\Requests\ObjectLabelRequest;
use Domain\Persistence\Storage\Commands\DestroyCommand;
use Domain\Persistence\Storage\Commands\StoreCommand;
use Domain\Persistence\Storage\Commands\UpdateCommand;
use Domain\Persistence\Storage\Queries\GetAllQuery;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class ObjectLabelController extends Controller
{
    private const string ROUTE_PLACEHOLDER = 'admin.object-labels.%s';

    public function __construct(
        private readonly Storage $storage
    ) {
    }

    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $objectLabelRequest = ObjectLabelRequest::fromArray([
            'limit' => (int) config('database.per_page_admin'),
            'offset' => (int) $request->get('offset', 0),
        ]);

        $collection = $this->storage->getAll(new GetAllQuery($objectLabelRequest, new ObjectLabel()));

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['objectLabels' => $collection]);
    }

    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view(sprintf(self::ROUTE_PLACEHOLDER, 'create'));
    }

    public function store(StoreObjectLabelRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->store(
            new StoreCommand(ObjectLabelRequest::fromArray($request->validated()), new ObjectLabel())
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $payload->getValue()]);
    }

    public function edit(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $objectLabel = $this->storage->getByQuery(
            new GetByRequestQuery(ObjectLabelRequest::fromArray(['id' => $id]), new ObjectLabel())
        );

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'edit'), ['objectLabel' => $objectLabel]);
    }

    public function update(UpdateObjectLabelRequest $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->update(
            new UpdateCommand(
                ObjectLabelRequest::fromArray(array_merge($request->validated(), ['id' => $id])),
                new ObjectLabel()
            )
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $payload->getValue()]);
    }

    public function destroy(Request $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->destroy(
            new DestroyCommand(ObjectLabelRequest::fromArray(['id' => $id]), new ObjectLabel())
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['page' => $request->get('redirect')]))
            ->with(['message' => $payload->getValue()]);
    }
}
