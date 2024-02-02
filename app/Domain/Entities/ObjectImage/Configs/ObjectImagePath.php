<?php

declare(strict_types=1);

namespace Domain\Entities\ObjectImage\Configs;

final class ObjectImagePath
{
    public static function pathWithObject(int $objectId): string
    {
        return sprintf('%s%d/', self::pathWithOutObject(), $objectId);
    }

    public static function pathWithOutObject(): string
    {
        return sprintf('%s/', config('images.persist.object_images'));
    }
}
