<?php

declare(strict_types=1);

namespace Domain\Services\ImageResizer;

use Domain\Contracts\Image\Resizer;
use Domain\Services\ImageResizer\ValueObjects\ResizeConfig;
use Domain\Services\ImageResizer\ValueObjects\Size;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

final readonly class InterventionResizer implements Resizer
{
    public function __construct(private ImageManager $imageManager)
    {
    }

    public function resize(ResizeConfig $config): void
    {
        $uploadImage = $config->getImageUpload();

        $filename = pathinfo($uploadImage->basename, PATHINFO_FILENAME);

        $absolutePath = Storage::path(sprintf('%s', $uploadImage->directory));
        $source = sprintf('%s%s', $absolutePath, $uploadImage->basename);

        foreach ($config->getSizes() as $size) {
            /** @var Size $size */
            $image = sprintf('%s%s', $absolutePath, str_replace($filename, $filename.$size->getPostfix() , $uploadImage->basename));

            $this->imageManager->read($source)
                ->coverDown($size->getWidth(), $size->getHeight())
                ->save($image);
        }
    }
}
