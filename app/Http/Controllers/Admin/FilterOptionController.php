<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilterOption\StoreFilterOptionRequest;
use App\Http\Requests\Admin\FilterOption\UpdateFilterOptionRequest;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Filter\Filter;
use Domain\Entities\Filter\Requests\FilterRequest;
use Domain\Entities\FilterOption\FilterOption;
use Domain\Entities\FilterOption\Requests\FilterOptionRequest;
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

final class FilterOptionController extends Controller
{
    private const string ROUTE_PLACEHOLDER = 'admin.filter-options.%s';

    public function __construct(private readonly Storage $storage)
    {
    }

    public function index(\Illuminate\Http\Request $request, int $filterId): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $filterOptionRequest = FilterOptionRequest::fromArray(
            array_merge(['filter_id' => $filterId], [
                'limit' => (int) config('database.per_page_admin'),
                'offset' => (int) $request->get('offset', 0),
            ])
        );

        $filter = $this->storage->getByQuery(new GetByRequestQuery(FilterRequest::fromArray(['id' => $filterId]), new Filter()));

        $filterOptions = $this->storage->getAll(new GetAllQuery($filterOptionRequest, new FilterOption()));

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['filterOptions' => $filterOptions, 'filter' => $filter]);
    }

    public function create(int $filterId): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $filter = $this->storage->getByQuery(new GetByRequestQuery(FilterRequest::fromArray(['id' => $filterId]), new Filter()));

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'create'), ['filter' => $filter]);
    }

    public function store(StoreFilterOptionRequest $request, int $filterId): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $message = $this->storage->store(
            new StoreCommand(
                FilterOptionRequest::fromArray(array_merge(['filter_id' => $filterId], $request->validated())),
                new FilterOption()
            )
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), $filterId))
            ->with(['message' => $message->getValue()]);
    }

    public function edit(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $filterOption = $this->storage->getByQuery(
            new GetByRequestQuery(FilterOptionRequest::fromArray(['id' => $id]), new FilterOption())
        );

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'edit'), ['filterOption' => $filterOption]);
    }

    public function update(UpdateFilterOptionRequest $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $message = $this->storage->update(
            new UpdateCommand(
                FilterOptionRequest::fromArray(array_merge(['id' => $id], $request->validated())),
                new FilterOption()
            )
        );

        /** @var FilterOption $filterOption */
        $filterOption = $this->storage->getByQuery(
            new GetByRequestQuery(FilterOptionRequest::fromArray(['id' => $id]), new FilterOption())
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), $filterOption->filter->id))
            ->with(['message' => $message->getValue()]);
    }

    public function destroy(int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        /** @var FilterOption $filterOption */
        $filterOption = $this->storage->getByQuery(
            new GetByRequestQuery(FilterOptionRequest::fromArray(['id' => $id]), new FilterOption())
        );

        $message = $this->storage->destroy(
            new DestroyCommand(ObjectImageRequest::fromArray(['id' => $id]), new FilterOption())
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), $filterOption->filter->id))
            ->with(['message' => $message->getValue()]);
    }
}
