<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Location\StoreLocationRequest;
use App\Http\Requests\Admin\Location\UpdateLocationRequest;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Location\Location;
use Domain\Entities\Location\Requests\LocationRequest;
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

final class LocationController extends Controller
{
    private const ROUTE_PLACEHOLDER = 'admin.locations.%s';

    public function __construct(private readonly Storage $storage)
    {
    }

    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $locationRequest = LocationRequest::fromArray([
            'limit' => (int) config('database.per_page_admin'),
            'offset' => (int) $request->get('offset', 0),
        ]);

        $locations = $this->storage->getAll(new GetAllQuery($locationRequest, new Location()));

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['locations' => $locations]);
    }

    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view(sprintf(self::ROUTE_PLACEHOLDER, 'create'));
    }

    public function store(StoreLocationRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->store(
            new StoreCommand(LocationRequest::fromArray($request->validated()), new Location())
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $payload->getValue()]);
    }

    public function edit(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $entity = $this->storage->getByQuery(
            new GetByRequestQuery(LocationRequest::fromArray(['id' => $id]), new Location())
        );

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'edit'), ['location' => $entity]);
    }

    public function update(UpdateLocationRequest $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $message = $this->storage->update(
            new UpdateCommand(LocationRequest::fromArray(array_merge($request->validated(), ['id' => $id])), new Location())
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $message->getValue()]);
    }

    public function destroy(Request $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->destroy(
            new DestroyCommand(LocationRequest::fromArray(['id' => $id]), new Location())
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['page' => $request->get('redirect')]))
            ->with(['message' => $payload->getValue()]);
    }
}
