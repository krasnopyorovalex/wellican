<?php

declare(strict_types=1);

namespace Domain\Services\ImageUploader;

use Domain\Contracts\Image\ImageUploader;
use Domain\Services\ImageUploader\DataTransferObjects\ImageUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class DiskImageUploader implements ImageUploader
{
    public function upload(UploadedFile $file, string $uploadedPath): ImageUpload
    {
        $publicUploadedPath = sprintf('%s', $uploadedPath);

        $file->store($publicUploadedPath, ['disk' => 'public']);

        return new ImageUpload(pathinfo($file->hashName(), PATHINFO_BASENAME), $publicUploadedPath);
    }

    public function clear(ImageUpload $imageUpload): void
    {
        $filename = pathinfo($imageUpload->basename, PATHINFO_FILENAME);

        $source = sprintf('%s/%s', $imageUpload->directory, $imageUpload->basename);
        $thumb = str_replace($filename, sprintf('%s_thumb', $filename), $source);

        Storage::disk('public')->delete([$source, $thumb]);
    }
}
