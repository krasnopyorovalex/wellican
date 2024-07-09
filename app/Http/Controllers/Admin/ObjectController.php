<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Domain\Entities\ObjectType\Requests\ObjectTypeRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Object\StoreObjectRequest;
use App\Http\Requests\Admin\Object\UpdateObjectRequest;
use Domain\Contracts\Http\Request as DomainRequest;
use Domain\Contracts\Image\Uploader;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Location\Location;
use Domain\Entities\Location\Requests\LocationRequest;
use Domain\Entities\Object\Objects;
use Domain\Entities\Object\Requests\ObjectRequest;
use Domain\Entities\ObjectImage\Configs\ObjectImagePath;
use Domain\Entities\ObjectLabel\ObjectLabel;
use Domain\Entities\ObjectLabel\Requests\ObjectLabelRequest;
use Domain\Entities\ObjectType\ObjectType;
use Domain\Persistence\Storage\Commands\DestroyCommand;
use Domain\Persistence\Storage\Commands\StoreCommand;
use Domain\Persistence\Storage\Commands\UpdateCommand;
use Domain\Persistence\Storage\Queries\GetAllQuery;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Domain\Persistence\Storage\ValueObjects\SyncOptions\FilterOptions;
use Domain\Persistence\Storage\ValueObjects\WithRelations;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class ObjectController extends Controller
{
    private const string ROUTE_PLACEHOLDER = 'admin.objects.%s';

    public function __construct(
        private readonly Storage $storage,
        private readonly Uploader $uploader
    ) {
    }

    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $objectRequest = ObjectRequest::fromArray([
            'limit' => (int) config('database.per_page_admin'),
            'offset' => (int) $request->get('offset', 0),
        ]);

        $objects = $this->storage->getAll(new GetAllQuery($objectRequest, new Objects(), new WithRelations(['type'])));

        return view('admin.objects.index', ['objects' => $objects]);
    }

    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $objectTypes = $this->storage->getAll(
            new GetAllQuery(ObjectTypeRequest::fromArray(DomainRequest::EMPTY_VALUES), new ObjectType())
        );
        $locations = $this->storage->getAll(
            new GetAllQuery(LocationRequest::fromArray(DomainRequest::EMPTY_VALUES), new Location())
        );
        $objectLabels = $this->storage->getAll(
            new GetAllQuery(ObjectLabelRequest::fromArray(DomainRequest::EMPTY_VALUES), new ObjectLabel())
        );

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'create'), [
            'objectTypes' => $objectTypes,
            'locations' => $locations,
            'objectLabels' => $objectLabels,
        ]);
    }

    public function store(StoreObjectRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $message = $this->storage->store(
            new StoreCommand(ObjectRequest::fromArray($request->validated()), new Objects())
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $message->getValue()]);
    }

    public function edit(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $object = $this->storage->getByQuery(
            new GetByRequestQuery(
                ObjectRequest::fromArray(['id' => $id]),
                new Objects(),
                new WithRelations(['type.filters.options', 'images', 'location', 'filterOptions'])
            )
        );

        $objectTypes = $this->storage->getAll(
            new GetAllQuery(ObjectTypeRequest::fromArray(DomainRequest::EMPTY_VALUES), new ObjectType())
        );

        $locations = $this->storage->getAll(
            new GetAllQuery(LocationRequest::fromArray(DomainRequest::EMPTY_VALUES), new Location())
        );

        $objectLabels = $this->storage->getAll(
            new GetAllQuery(ObjectLabelRequest::fromArray(DomainRequest::EMPTY_VALUES), new ObjectLabel())
        );

        return view('admin.objects.edit', [
            'object' => $object,
            'objectTypes' => $objectTypes,
            'locations' => $locations,
            'objectLabels' => $objectLabels,
        ]);
    }

    public function update(UpdateObjectRequest $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->update(
            new UpdateCommand(
                ObjectRequest::fromArray(array_merge($request->validated(), ['id' => $id])),
                new Objects(),
                new FilterOptions($request->get('filters', []))
            )
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $payload->getValue()]);
    }

    public function destroy(Request $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->destroy(new DestroyCommand(ObjectRequest::fromArray(['id' => $id]), new Objects()));

        $this->uploader->clearAll(ObjectImagePath::pathWithObject($id));

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['page' => $request->get('redirect')]))
            ->with(['message' => $payload->getValue()]);
    }
}
