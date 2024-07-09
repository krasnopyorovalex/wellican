<?php

declare(strict_types=1);

namespace Domain\Persistence\Configs;

use Illuminate\Http\UploadedFile;

final readonly class FileConfig
{
    public function __construct(
        private UploadedFile $uploadedFile,
        private int $imageableId,
        private string $imageableType,
        private bool $mustBeDestroyed = false
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
