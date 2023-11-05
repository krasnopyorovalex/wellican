<?php

declare(strict_types=1);

namespace Domain\Entities\Image;

use Domain\Contracts\Image\Uploader;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Image\Requests\ImageRequest;
use Domain\Entities\Info\Requests\InfoRequest;
use Domain\Persistence\Configs\FileConfig;
use Domain\Persistence\Storage\Commands\File\DestroyFileCommand;
use Domain\Persistence\Storage\Commands\File\StoreFileCommand;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Domain\Persistence\Storage\ValueObjects\Id;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

final class ImageService
{
    public function __construct(
        private readonly Uploader $uploader,
        private readonly Storage $storage
    ) {
    }

    public function store(Request $request, Id $id, Model $model): void
    {
        if ($request->has('image')) {
            $fileConfig = new FileConfig($request->file('image'), $id->getValue(), $model::class);
            $this->storage->store(new StoreFileCommand($this->uploader, $fileConfig, new Image()));
        }
    }

    public function destroy(\Domain\Contracts\Http\Request $request, Model $model): void
    {
        $entity = $this->storage->getByQuery(new GetByRequestQuery($request, $model));

        if ($entity->image) {
            $imageRequest = ImageRequest::fromArray(['id' => $entity->image->id]);
            $this->storage->destroy(new DestroyFileCommand($this->uploader, $imageRequest, new Image()));
        }
    }

    public function replace(Request $request, Id $id, Model $model): void
    {
        $entity = $this->storage->getByQuery(
            new GetByRequestQuery(InfoRequest::fromArray(['id' => $id->getValue()]), $model)
        );

        if ($entity->image) {
            $imageRequest = ImageRequest::fromArray(['id' => $entity->image->id]);
            $this->storage->destroy(new DestroyFileCommand($this->uploader, $imageRequest, new Image()));
        }

        $entity->touch();

        $fileConfig = new FileConfig($request->file('image'), $entity->id, $model::class);
        $this->storage->store(new StoreFileCommand($this->uploader, $fileConfig, new Image()));
    }
}
