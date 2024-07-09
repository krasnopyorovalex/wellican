<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ObjectImage\StoreObjectImageRequest;
use App\Http\Requests\Admin\ObjectImage\UpdateObjectImageRequest;
use Domain\Contracts\Image\Resizer;
use Domain\Contracts\Image\Uploader;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Object\Objects;
use Domain\Entities\Object\Requests\ObjectRequest;
use Domain\Entities\ObjectImage\ObjectImage;
use Domain\Entities\ObjectImage\Requests\ObjectImageRequest;
use Domain\Persistence\Storage\Commands\ObjectImage\DestroyObjectImageCommand;
use Domain\Persistence\Storage\Commands\ObjectImage\StoreObjectImageCommand;
use Domain\Persistence\Storage\Commands\UpdateCommand;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

final class ObjectImageController extends Controller
{
    public function __construct(
        private readonly Storage $storage,
        private readonly Uploader $uploader,
        private readonly Resizer $resizer
    ) {
    }

    public function index(int $objectId): \Illuminate\Foundation\Application|\Illuminate\Http\Response|Application|ResponseFactory
    {
        /** @var Objects $object */
        $object = $this->storage->getByQuery(
            new GetByRequestQuery(ObjectRequest::fromArray(['id' => $objectId]), new Objects())
        );

        return response(['data' => $object->images], Response::HTTP_OK);
    }

    public function store(StoreObjectImageRequest $request, int $objectId): \Illuminate\Foundation\Application|\Illuminate\Http\Response|Application|ResponseFactory
    {
        /** @var Objects $object */
        $object = $this->storage->getByQuery(
            new GetByRequestQuery(ObjectRequest::fromArray(['id' => $objectId]), new Objects())
        );

        $message = $this->storage->store(
            new StoreObjectImageCommand($this->uploader, $this->resizer, $request->file('image'), $object)
        );

        return response(['data' => ['message' => $message->getValue()]], Response::HTTP_CREATED);
    }

    public function update(UpdateObjectImageRequest $request, int $id): \Illuminate\Foundation\Application|\Illuminate\Http\Response|Application|ResponseFactory
    {
        $message = $this->storage->update(
            new UpdateCommand(
                ObjectImageRequest::fromArray(array_merge(['id' => $id], $request->validated())),
                new ObjectImage()
            )
        );

        return response(['data' => ['message' => $message->getValue()]], Response::HTTP_OK);
    }

    public function destroy(int $id): \Illuminate\Foundation\Application|\Illuminate\Http\Response|Application|ResponseFactory
    {
        /** @var ObjectImage $objectImage */
        $objectImage = $this->storage->getByQuery(
            new GetByRequestQuery(ObjectImageRequest::fromArray(['id' => $id]), new ObjectImage())
        );

        $message = $this->storage->destroy(new DestroyObjectImageCommand($this->uploader, $objectImage));

        return response(['data' => ['message' => $message->getValue()]], Response::HTTP_OK);
    }
}
