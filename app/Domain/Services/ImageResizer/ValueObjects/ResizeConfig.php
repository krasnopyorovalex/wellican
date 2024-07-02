<?php

declare(strict_types=1);

namespace Domain\Services\ImageResizer\ValueObjects;

use Domain\Services\ImageUploader\DataTransferObjects\FileUpload;

final readonly class ResizeConfig
{
    public function __construct(private FileUpload $imageUpload, private array $sizes)
    {
    }

    public function getImageUpload(): FileUpload
    {
        return $this->imageUpload;
    }

    public function getSizes(): array
    {
        return $this->sizes;
    }
}
