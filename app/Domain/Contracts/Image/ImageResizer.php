<?php

namespace Domain\Contracts\Image;

use Domain\Services\ImageResizer\ValueObjects\Config;

interface ImageResizer
{
    public function resize(Config $config): void;
}
