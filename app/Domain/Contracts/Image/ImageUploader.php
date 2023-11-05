<?php

declare(strict_types=1);

namespace Domain\Contracts\Image;

use Domain\Services\ImageUploader\DataTransferObjects\ImageUpload;
use Illuminate\Http\UploadedFile;

interface ImageUploader
{
    public function upload(UploadedFile $file, string $uploadedPath): ImageUpload;

    public function clear(ImageUpload $imageUpload): void;
}
