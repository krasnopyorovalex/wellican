<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Filter\StoreFilterRequest;
use App\Http\Requests\Admin\Filter\UpdateFilterRequest;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Filter\Filter;
use Domain\Entities\Filter\Requests\FilterRequest;
use Domain\Entities\ObjectImage\Requests\ObjectImageRequest;
use Domain\Persistence\Storage\Commands\DestroyCommand;
use Domain\Persistence\Storage\Commands\StoreCommand;
use Domain\Persistence\Storage\Commands\UpdateCommand;
use Domain\Persistence\Storage\Queries\GetAllQuery;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

final class FiltersController extends Controller
{
    private const string ROUTE_PLACEHOLDER = 'admin.filters.%s';

    public function __construct(private readonly Storage $storage)
    {
    }

    public function index(\Illuminate\Http\Request $request, int $parentId): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $filterRequest = FilterRequest::fromArray(
            array_merge(['parent_id' => $parentId], [
                'limit' => (int) config('database.per_page_admin'),
                'offset' => (int) $request->get('offset', 0),
            ])
        );

        $filters = $this->storage->getAll(new GetAllQuery($filterRequest, new Filter()));

        return view('admin.filters.index', ['filters' => $filters, 'parentId' => $parentId]);
    }

    public function create(int $parentId): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('admin.filters.create', ['parentId' => $parentId]);
    }

    public function store(StoreFilterRequest $request, int $parentId): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $message = $this->storage->store(
            new StoreCommand(
                FilterRequest::fromArray(array_merge(['parent_id' => $parentId], $request->validated())),
                new Filter()
            )
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), $parentId))
            ->with(['message' => $message->getValue()]);
    }

    public function edit(int $parentId, int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $filter = $this->storage->getByQuery(
            new GetByRequestQuery(FilterRequest::fromArray(['id' => $id]), new Filter())
        );

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'edit'), ['parentId' => $parentId, 'filter' => $filter]);
    }

    public function update(UpdateFilterRequest $request, int $parentId, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $message = $this->storage->update(
            new UpdateCommand(
                FilterRequest::fromArray(array_merge(['id' => $id], $request->validated())),
                new Filter()
            )
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), $parentId))
            ->with(['message' => $message->getValue()]);
    }

    public function destroy(int $parentId, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $message = $this->storage->destroy(
            new DestroyCommand(ObjectImageRequest::fromArray(['id' => $id]), new Filter())
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), $parentId))
            ->with(['message' => $message->getValue()]);
    }
}
