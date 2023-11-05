<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Commands\File;

use Domain\Contracts\Image\Uploader;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\DatabaseResource;
use Domain\Persistence\Configs\FileConfig;
use Domain\Persistence\Configs\FilePath;
use Domain\Persistence\Storage\Resources\SingleRecourse;
use Illuminate\Database\Eloquent\Model;

final class StoreFileCommand implements Command
{
    public function __construct(
        private readonly Uploader $uploader,
        private readonly FileConfig $fileConfig,
        private readonly Model $model
    ) {
    }

    public function handle(): DatabaseResource
    {
        $path = FilePath::createDir($this->fileConfig->getImageableType());
        $fileUploaded = $this->uploader->upload($this->fileConfig->getUploadedFile(), $path);

        return new SingleRecourse(
            $this->model::query()->create([
                'imageable_id' => $this->fileConfig->getImageableId(),
                'imageable_type' => $this->fileConfig->getImageableType(),
                'filename' => pathinfo($fileUploaded->basename, PATHINFO_FILENAME),
                'ext' => pathinfo($fileUploaded->basename, PATHINFO_EXTENSION),
            ])
        );
    }
}
