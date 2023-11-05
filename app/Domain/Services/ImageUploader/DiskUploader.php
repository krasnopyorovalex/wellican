<?php

declare(strict_types=1);

namespace Domain\Services\ImageUploader;

use Domain\Contracts\Image\Uploader;
use Domain\Services\ImageUploader\DataTransferObjects\FileUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class DiskUploader implements Uploader
{
    public function upload(UploadedFile $file, string $uploadedPath): FileUpload
    {
        $publicUploadedPath = sprintf('%s', $uploadedPath);

        $file->store($publicUploadedPath);

        return new FileUpload(pathinfo($file->hashName(), PATHINFO_BASENAME), $publicUploadedPath);
    }

    public function clear(FileUpload $imageUpload): void
    {
        $filename = pathinfo($imageUpload->basename, PATHINFO_FILENAME);

        $source = sprintf('%s/%s', $imageUpload->directory, $imageUpload->basename);
        $thumb = str_replace($filename, sprintf('%s_thumb', $filename), $source);

        Storage::delete([$source, $thumb]);
    }

    public function clearAll(string $path): void
    {
        Storage::deleteDirectory($path);
    }
}
