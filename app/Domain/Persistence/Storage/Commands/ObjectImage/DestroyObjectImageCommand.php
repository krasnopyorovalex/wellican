<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Commands\ObjectImage;

use Domain\Contracts\Image\Uploader;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\DatabaseResource;
use Domain\Entities\ObjectImage\Configs\ObjectImagePath;
use Domain\Entities\ObjectImage\ObjectImage;
use Domain\Persistence\Storage\Resources\SingleRecourse;
use Domain\Services\ImageUploader\DataTransferObjects\FileUpload;

class DestroyObjectImageCommand implements Command
{
    public function __construct(
        private readonly Uploader $uploader,
        private readonly ObjectImage $objectImage
    ) {
    }

    public function handle(): DatabaseResource
    {
        $this->uploader->clear(
            new FileUpload(
                sprintf('%s.%s', $this->objectImage->filename, $this->objectImage->ext),
                ObjectImagePath::pathWithObject($this->objectImage->object_id)
            )
        );

        $this->objectImage->delete();

        return new SingleRecourse($this->objectImage);
    }
}
