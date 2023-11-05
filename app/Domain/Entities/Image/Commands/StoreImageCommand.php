<?php

declare(strict_types=1);

namespace Domain\Entities\Image\Commands;

use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\HasEntity;
use Domain\Entities\Image\Configs\ImageConfig;
use Domain\Entities\Image\Image;
use Domain\Services\ImageUploader\DataTransferObjects\ImageUpload;
use Illuminate\Database\Eloquent\Model;

final class StoreImageCommand implements Command, HasEntity
{
    private Model $entity;

    public function __construct(
        private readonly ImageUpload $imageUpload,
        private readonly ImageConfig $imageConfig
    ) {

    }

    public function handle(): void
    {
        $this->entity = Image::query()->create([
            'imageable_id' => $this->imageConfig->getImageableId(),
            'imageable_type' => $this->imageConfig->getImageableType(),
            'filename' => pathinfo($this->imageUpload->basename, PATHINFO_FILENAME),
            'ext' => pathinfo($this->imageUpload->basename, PATHINFO_EXTENSION),
        ]);
    }

    public function getEntity(): Model
    {
        return $this->entity;
    }
}
