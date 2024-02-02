<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permission\StorePermissionRequest;
use App\Http\Requests\Admin\Permission\UpdatePermissionRequest;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Permission\Requests\PermissionRequest;
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
use Spatie\Permission\Models\Permission;

final class PermissionController extends Controller
{
    private const ROUTE_PLACEHOLDER = 'admin.permissions.%s';

    public function __construct(
        private readonly Storage $storage
    ) {
    }

    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $permissionRequest = PermissionRequest::fromArray([
            'limit' => (int) config('database.per_page_admin'),
            'offset' => (int) $request->get('offset', 0),
        ]);

        $permissions = $this->storage->getAll(new GetAllQuery($permissionRequest, new Permission()));

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['permissions' => $permissions]);
    }

    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view(sprintf(self::ROUTE_PLACEHOLDER, 'create'));
    }

    public function store(StorePermissionRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->store(
            new StoreCommand(PermissionRequest::fromArray($request->validated()), new Permission())
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $payload->getValue()]);
    }

    public function edit(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $permission = $this->storage->getByQuery(
            new GetByRequestQuery(PermissionRequest::fromArray(['id' => $id]), new Permission())
        );

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'edit'), ['permission' => $permission]);
    }

    public function update(UpdatePermissionRequest $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->update(
            new UpdateCommand(
                PermissionRequest::fromArray(array_merge($request->validated(), ['id' => $id])),
                new Permission()
            )
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $payload->getValue()]);
    }

    public function destroy(Request $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->destroy(new DestroyCommand(PermissionRequest::fromArray(['id' => $id]), new Permission()));

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['page' => $request->get('redirect')]))
            ->with(['message' => $payload->getValue()]);
    }
}
