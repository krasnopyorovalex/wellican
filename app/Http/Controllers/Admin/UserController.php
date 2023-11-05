<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Image\ImageService;
use Domain\Entities\Info\Requests\InfoRequest;
use Domain\Entities\Permission\Requests\PermissionRequest;
use Domain\Entities\Role\Requests\RoleRequest;
use Domain\Entities\User\Requests\UserRequest;
use Domain\Entities\User\User;
use Domain\Entities\User\ValueObjects\Role;
use Domain\Exceptions\IdException;
use Domain\Persistence\Storage\Commands\DestroyCommand;
use Domain\Persistence\Storage\Commands\User\StoreUserCommand;
use Domain\Persistence\Storage\Commands\User\UpdateUserCommand;
use Domain\Persistence\Storage\Queries\GetAllQuery;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Domain\Persistence\Storage\ValueObjects\Id;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class UserController extends Controller
{
    private const ROUTE_PLACEHOLDER = 'admin.users.%s';

    public function __construct(
        private readonly ImageService $imageService,
        private readonly Storage $storage
    ) {
    }

    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $userRequest = UserRequest::fromArray([
            'limit' => (int) config('database.per_page_admin'),
            'offset' => (int) $request->get('offset', 0),
        ]);

        $users = $this->storage->getAll(new GetAllQuery($userRequest, new User()));

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['users' => $users]);
    }

    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $roles = $this->storage->getAll(
            new GetAllQuery(
                RoleRequest::fromArray(\Domain\Contracts\Http\Request::EMPTY_VALUES),
                new \Domain\Entities\Role\Role()
            )
        );

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'create'), [
            'roles' => $roles,
        ]);
    }

    /**
     * @throws IdException
     */
    public function store(StoreUserRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $message = $this->storage->store(
            new StoreUserCommand(
                UserRequest::fromArray($request->validated()),
                new User(),
                new Role((int) $request->get('role'), $request->get('permissions', []))
            )
        );

        $this->imageService->store($request, $message->getId(), new User());

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $message->getValue()]);
    }

    public function edit(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $userModel = new User();

        $user = $this->storage->getByQuery(
            new GetByRequestQuery(UserRequest::fromArray(['id' => $id]), $userModel)
        );

        $roles = $this->storage->getAll(
            new GetAllQuery(
                RoleRequest::fromArray(\Domain\Contracts\Http\Request::EMPTY_VALUES),
                new \Domain\Entities\Role\Role()
            )
        );

        $permissions = $this->storage->getByQuery(
            new GetByRequestQuery(
                PermissionRequest::fromArray(\Domain\Contracts\Http\Request::EMPTY_VALUES),
                $userModel
            )
        );

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'edit'), [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function update(UpdateUserRequest $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $message = $this->storage->update(
            new UpdateUserCommand(
                UserRequest::fromArray(array_merge($request->validated(), ['id' => $id])),
                new User(),
                new Role((int) $request->get('role'), $request->get('permissions', []))
            )
        );

        if ($request->has('image')) {
            $this->imageService->replace($request, new Id($id), new User());
        }

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $message->getValue()]);
    }

    public function destroy(Request $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $user = new User();

        $infoRequest = InfoRequest::fromArray(['id' => $id]);
        $this->imageService->destroy($infoRequest, $user);
        $message = $this->storage->destroy(new DestroyCommand($infoRequest, $user));

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['page' => $request->get('redirect')]))
            ->with(['message' => $message->getValue()]);
    }
}
