<?php

declare(strict_types=1);

namespace Domain\Services\ImageUploader\DataTransferObjects;

final class FileUpload
{
    public function __construct(
        public readonly string $basename,
        public readonly string $directory
    ) {
    }
}
