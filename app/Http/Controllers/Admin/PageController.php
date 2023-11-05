<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Page\StorePageRequest;
use App\Http\Requests\Admin\Page\UpdatePageRequest;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Page\Page;
use Domain\Entities\Page\Requests\PageRequest;
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

final class PageController extends Controller
{
    private const ROUTE_PLACEHOLDER = 'admin.pages.%s';

    public function __construct(private readonly Storage $storage)
    {
    }

    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $request = PageRequest::fromArray([
            'limit' => (int) config('database.per_page_admin'),
            'offset' => (int) $request->get('offset', 0),
        ]);

        $pages = $this->storage->getAll(new GetAllQuery($request, new Page()));

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['pages' => $pages]);
    }

    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view(sprintf(self::ROUTE_PLACEHOLDER, 'create'));
    }

    public function store(StorePageRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->store(new StoreCommand(PageRequest::fromArray($request->validated()), new Page()));

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $payload->getValue()]);
    }

    public function edit(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $page = $this->storage->getByQuery(new GetByRequestQuery(PageRequest::fromArray(['id' => $id]), new Page()));

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'edit'), ['page' => $page]);
    }

    public function update(UpdatePageRequest $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->update(
            new UpdateCommand(PageRequest::fromArray(array_merge($request->validated(), ['id' => $id])), new Page())
        );

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $payload->getValue()]);
    }

    public function destroy(Request $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $payload = $this->storage->destroy(new DestroyCommand(PageRequest::fromArray(['id' => $id]), new Page()));

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['page' => $request->get('redirect')]))
            ->with(['message' => $payload->getValue()]);
    }
}
