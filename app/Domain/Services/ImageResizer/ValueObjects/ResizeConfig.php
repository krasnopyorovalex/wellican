<?php

declare(strict_types=1);

namespace Domain\Services\ImageResizer\ValueObjects;

use Domain\Services\ImageUploader\DataTransferObjects\FileUpload;

final readonly class ResizeConfig
{
    public function __construct(
        private FileUpload $imageUpload,
        private int $width,
        private int $height,
    ) {

    }

    public function getImageUpload(): FileUpload
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
