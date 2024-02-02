<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Permission\Requests\PermissionRequest;
use Domain\Entities\Role\Requests\RoleRequest;
use Domain\Entities\Role\Role;
use Domain\Entities\Role\ValueObjects\Permission;
use Domain\Persistence\Storage\Commands\DestroyCommand;
use Domain\Persistence\Storage\Commands\Role\StoreRoleCommand;
use Domain\Persistence\Storage\Commands\Role\UpdateRoleCommand;
use Domain\Persistence\Storage\Queries\GetAllQuery;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class RoleController extends Controller
{
    private const ROUTE_PLACEHOLDER = 'admin.roles.%s';

    public function __construct(
        private readonly Storage $storage
    ) {
    }

    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $roleRequest = RoleRequest::fromArray([
            'limit' => (int) config('database.per_page_admin'),
            'offset' => (int) $request->get('offset', 0),
        ]);

        $roles = $this->storage->getAll(new GetAllQuery($roleRequest, new Role()));

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['roles' => $roles]);
    }

    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $permissions = $this->storage->getAll(
            new GetAllQuery(PermissionRequest::fromArray(
                \Domain\Contracts\Http\Request::EMPTY_VALUES),
                new \Spatie\Permission\Models\Permission()
            )
        );

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'create'), [
            'permissions' => $permissions,
        ]);
    }

    public function store(StoreRoleRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->store(
            new StoreRoleCommand(
                RoleRequest::fromArray($request->validated()),
                new Role(),
                new Permission($request->get('permissions'))
            )
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $payload->getValue()]);
    }

    public function edit(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $role = $this->storage->getByQuery(new GetByRequestQuery(RoleRequest::fromArray(['id' => $id]), new Role()));

        $permissions = $this->storage->getAll(
            new GetAllQuery(PermissionRequest::fromArray(
                \Domain\Contracts\Http\Request::EMPTY_VALUES),
                new \Spatie\Permission\Models\Permission()
            )
        );

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'edit'), [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function update(UpdateRoleRequest $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->update(
            new UpdateRoleCommand(
                RoleRequest::fromArray(array_merge($request->validated(), ['id' => $id])),
                new Role(),
                new Permission($request->get('permissions'))
            )
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $payload->getValue()]);
    }

    public function destroy(Request $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->destroy(
            new DestroyCommand(RoleRequest::fromArray(['id' => $id]), new Role())
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['page' => $request->get('redirect')]))
            ->with(['message' => $payload->getValue()]);
    }
}
