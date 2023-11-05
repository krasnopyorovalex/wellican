<?php

declare(strict_types=1);

namespace Domain\Persistence\Configs;

use Illuminate\Http\UploadedFile;

final class FileConfig
{
    public function __construct(
        private readonly UploadedFile $uploadedFile,
        private readonly int $imageableId,
        private readonly string $imageableType,
        private readonly bool $mustBeDestroyed = false
    ) {

    }

    public function getUploadedFile(): UploadedFile
    {
        return $this->uploadedFile;
    }

    public function getImageableType(): string
    {
        return $this->imageableType;
    }

    public function getImageableId(): int
    {
        return $this->imageableId;
    }

    public function isMustBeDestroyed(): bool
    {
        return $this->mustBeDestroyed;
    }
}
