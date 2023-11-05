<?php

declare(strict_types=1);

namespace Domain\Services\ImageUploader;

use Domain\Contracts\Image\ImageUploader;
use Domain\Services\ImageUploader\DataTransferObjects\ImageUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class SSDImageUploader implements ImageUploader
{
    public function upload(UploadedFile $file, string $uploadedPath): ImageUpload
    {
        $file->store($uploadedPath);

        return new ImageUpload(pathinfo($file->hashName(), PATHINFO_BASENAME), $uploadedPath);
    }

    public function clear(ImageUpload $imageUpload): void
    {
        $filename = pathinfo($imageUpload->basename, PATHINFO_FILENAME);

        $source = str_replace('/storage', '', $imageUpload->directory);
        $thumb = str_replace($filename, sprintf('%s_thumb', $filename), $source);

        Storage::delete([$source, $thumb]);
    }
}
