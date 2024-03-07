<?php

declare(strict_types=1);

namespace Domain\Services\ImageResizer;

use Domain\Contracts\Image\ImageResizer;
use Domain\Services\ImageResizer\ValueObjects\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

final readonly class InterventionImageResizer implements ImageResizer
{
    public function __construct(private ImageManager $imageManager)
    {
    }

    public function resize(Config $config): void
    {
        $uploadImage = $config->getImageUpload();

        $filename = pathinfo($uploadImage->basename, PATHINFO_FILENAME);

        $absolutePath = Storage::disk('public')->path(sprintf('%s', $uploadImage->directory));

        $source = sprintf('%s%s', $absolutePath, $uploadImage->basename);
        $thumb = sprintf('%s%s', $absolutePath, str_replace($filename, $filename.'_thumb', $uploadImage->basename));

        $this->imageManager->make($source)
            ->fit($config->getWidth(), $config->getHeight(), fn ($constraint) => $constraint->upsize())
            ->save($thumb);
    }
}
