<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Image\UpdateImageRequest;
use Domain\Contracts\Image\Uploader;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Image\Image;
use Domain\Entities\Image\Requests\ImageRequest;
use Domain\Persistence\Storage\Commands\File\DestroyFileCommand;
use Domain\Persistence\Storage\Commands\UpdateCommand;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

final class ImageController extends Controller
{
    public function __construct(
        private readonly Storage $storage,
        private readonly Uploader $imageUploader
    ) {
    }

    public function update(UpdateImageRequest $request, int $id): \Illuminate\Foundation\Application|\Illuminate\Http\Response|Application|ResponseFactory
    {
        $message = $this->storage->update(
            new UpdateCommand(ImageRequest::fromArray(array_merge(['id' => $id], $request->validated())), new Image())
        );

        return response(['data' => ['message' => $message->getValue()]], Response::HTTP_OK);
    }

    public function destroy(int $id): \Illuminate\Foundation\Application|\Illuminate\Http\Response|Application|ResponseFactory
    {
        $message = $this->storage->destroy(
            new DestroyFileCommand($this->imageUploader, ImageRequest::fromArray(['id' => $id]), new Image())
        );

        return response(['data' => ['message' => $message->getValue()]], Response::HTTP_OK);
    }
}
