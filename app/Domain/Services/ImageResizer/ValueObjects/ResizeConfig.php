<?php

declare(strict_types=1);

namespace Domain\Services\ImageResizer\ValueObjects;

use Domain\Services\ImageUploader\DataTransferObjects\FileUpload;

final class ResizeConfig
{
    public function __construct(
        private readonly FileUpload $imageUpload,
        private readonly int $width,
        private readonly int $height,
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
