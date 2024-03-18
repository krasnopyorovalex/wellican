<?php

declare(strict_types=1);

namespace Domain\Services\ImageResizer\ValueObjects;

use Domain\Services\ImageUploader\DataTransferObjects\ImageUpload;

readonly class Config
{
    public function __construct(
        private ImageUpload $imageUpload,
        private int $width,
        private int $height,
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
