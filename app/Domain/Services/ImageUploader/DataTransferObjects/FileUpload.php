<?php

declare(strict_types=1);

namespace Domain\Services\ImageUploader\DataTransferObjects;

final readonly class FileUpload
{
    public function __construct(
        public string $basename,
        public string $directory
    ) {
    }
}
