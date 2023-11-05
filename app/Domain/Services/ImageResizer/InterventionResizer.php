<?php

declare(strict_types=1);

namespace Domain\Services\ImageResizer;

use Domain\Contracts\Image\Resizer;
use Domain\Services\ImageResizer\ValueObjects\ResizeConfig;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

final class InterventionResizer implements Resizer
{
    public function __construct(private readonly ImageManager $imageManager)
    {
    }

    public function resize(ResizeConfig $config): void
    {
        $uploadImage = $config->getImageUpload();

        $filename = pathinfo($uploadImage->basename, PATHINFO_FILENAME);

        $absolutePath = Storage::path(sprintf('%s', $uploadImage->directory));

        $source = sprintf('%s%s', $absolutePath, $uploadImage->basename);
        $thumb = sprintf('%s%s', $absolutePath, str_replace($filename, $filename.'_thumb', $uploadImage->basename));

        $this->imageManager->read($source)
            ->coverDown($config->getWidth(), $config->getHeight())
            ->save($thumb);
    }
}
