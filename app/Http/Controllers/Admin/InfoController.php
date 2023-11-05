<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Info\StoreInfoRequest;
use App\Http\Requests\Admin\Info\UpdateInfoRequest;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Image\ImageService;
use Domain\Entities\Info\Info;
use Domain\Entities\Info\Requests\InfoRequest;
use Domain\Exceptions\IdException;
use Domain\Persistence\Storage\Commands\DestroyCommand;
use Domain\Persistence\Storage\Commands\StoreCommand;
use Domain\Persistence\Storage\Commands\UpdateCommand;
use Domain\Persistence\Storage\Queries\GetAllQuery;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Domain\Persistence\Storage\ValueObjects\Id;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

final class InfoController extends Controller
{
    private const ROUTE_PLACEHOLDER = 'admin.news.%s';

    public function __construct(
        private readonly Storage $storage,
        private readonly ImageService $imageService
    ) {
    }

    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $request = InfoRequest::fromArray([
            'limit' => (int) config('database.per_page_admin'),
            'offset' => (int) $request->get('offset', 0),
        ]);

        $collection = $this->storage->getAll(new GetAllQuery($request, new Info()));

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['news' => $collection]);
    }

    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view(sprintf(self::ROUTE_PLACEHOLDER, 'create'));
    }

    /**
     * @throws IdException
     */
    public function store(StoreInfoRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $message = $this->storage->store(new StoreCommand(InfoRequest::fromArray($request->validated()), new Info()));

        $this->imageService->store($request, $message->getId(), new Info());

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $message->getValue()]);
    }

    public function edit(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $info = $this->storage->getByQuery(new GetByRequestQuery(InfoRequest::fromArray(['id' => $id]), new Info()));

        return view(sprintf(self::ROUTE_PLACEHOLDER, 'edit'), ['info' => $info]);
    }

    public function update(UpdateInfoRequest $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $message = $this->storage->update(
            new UpdateCommand(InfoRequest::fromArray(array_merge($request->validated(), ['id' => $id])), new Info())
        );

        if ($request->has('image')) {
            $this->imageService->replace($request, new Id($id), new Info());
        }

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index')))
            ->with(['message' => $message->getValue()]);
    }

    public function destroy(Request $request, int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $info = new Info();

        $infoRequest = InfoRequest::fromArray(['id' => $id]);
        $this->imageService->destroy($infoRequest, $info);
        $message = $this->storage->destroy(new DestroyCommand($infoRequest, $info));

        return redirect(route(sprintf(self::ROUTE_PLACEHOLDER, 'index'), ['page' => $request->get('redirect')]))
            ->with(['message' => $message->getValue()]);
    }
}
