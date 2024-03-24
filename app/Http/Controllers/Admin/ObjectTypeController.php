<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Domain\Entities\ObjectType\Requests\ObjectTypeRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ObjectType\SortableObjectTypeRequest;
use App\Http\Requests\Admin\ObjectType\StoreObjectTypeRequest;
use App\Http\Requests\Admin\ObjectType\UpdateObjectTypeRequest;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Image\ImageService;
use Domain\Entities\ObjectType\ObjectType;
use Domain\Persistence\Storage\Commands\DestroyCommand;
use Domain\Persistence\Storage\Commands\StoreCommand;
use Domain\Persistence\Storage\Commands\UpdateCommand;
use Domain\Persistence\Storage\Queries\GetAllQuery;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Domain\Persistence\Storage\ValueObjects\Id;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

final class ObjectTypeController extends Controller
{
    private const string ROUTE_PLACEHOLDER = 'admin.object-types.%s';

    public function __construct(
        private readonly Storage $storage,
        private readonly ImageService $imageService
    ) {
    }

    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $objectTypeRequest = ObjectTypeRequest::fromArray([
            'limit' => (int) config('database.per_page_admin'),
            'offset' => (int) $request->get('offset', 0),
        ]);

        $collection = $this->storage->getAll(new GetAllQuery($objectTypeRequest, new ObjectType()));

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['objectTypes' => $collection]);
    }

    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view(sprintf(self::ROUTE_PLACEHOLDER, 'create'));
    }

    public function store(StoreObjectTypeRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->store(
            new StoreCommand(ObjectTypeRequest::fromArray($request->validated()), new ObjectType())
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $payload->getValue()]);
    }

    public function edit(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $objectType = $this->storage->getByQuery(
            new GetByRequestQuery(ObjectTypeRequest::fromArray(['id' => $id]), new ObjectType())
        );

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'edit'), ['objectType' => $objectType]);
    }

    public function update(UpdateObjectTypeRequest $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->update(
            new UpdateCommand(
                ObjectTypeRequest::fromArray(array_merge($request->validated(), ['id' => $id])),
                new ObjectType()
            )
        );

        if ($request->has('image')) {
            $this->imageService->replace($request, new Id($id), new ObjectType());
        }

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $payload->getValue()]);
    }

    public function destroy(Request $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->destroy(
            new DestroyCommand(ObjectTypeRequest::fromArray(['id' => $id]), new ObjectType())
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['page' => $request->get('redirect')]))
            ->with(['message' => $payload->getValue()]);
    }

    public function sortable(SortableObjectTypeRequest $request): \Illuminate\Foundation\Application|Response|Application|ResponseFactory
    {
        foreach ($request->validated()['data'] as $position => $objectId) {
            $this->storage->update(
                new UpdateCommand(
                    ObjectTypeRequest::fromArray(['id' => $objectId, 'position' => $position + 1]),
                    new ObjectType()
                )
            );
        }

        return response(['message' => __('entities.object_types.sortable.success')]);
    }
}
