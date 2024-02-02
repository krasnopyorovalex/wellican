<?php

declare(strict_types=1);

namespace Domain\Contracts\Image;

use Domain\Services\ImageUploader\DataTransferObjects\FileUpload;
use Illuminate\Http\UploadedFile;

interface Uploader
{
    public function upload(UploadedFile $file, string $uploadedPath): FileUpload;

    public function clear(FileUpload $imageUpload): void;

    public function clearAll(string $path): void;
}
