<?php

namespace Domain\Contracts\Image;

use Domain\Services\ImageResizer\ValueObjects\ResizeConfig;

interface Resizer
{
    public function resize(ResizeConfig $config): void;
}
