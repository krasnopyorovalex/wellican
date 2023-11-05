<?php

declare(strict_types=1);

namespace Domain\Services\ImageResizer\ValueObjects;

use Domain\Services\ImageUploader\DataTransferObjects\ImageUpload;

class Config
{
    public function __construct(
        private readonly ImageUpload $imageUpload,
        private readonly int $width,
        private readonly int $height,
    ) {

    }

    public function getImageUpload(): ImageUpload
    {
        return $this->imageUpload;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}
