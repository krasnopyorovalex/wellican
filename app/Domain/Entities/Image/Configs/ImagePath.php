<?php

declare(strict_types=1);

namespace Domain\Entities\Image\Configs;

use Illuminate\Support\Str;

final class ImagePath
{
    public static function createDir(string $entity): string
    {
        $imageableType = Str::kebab(Str::of($entity)->explode('\\')->last());

        return sprintf('%s', $imageableType);
    }
}
