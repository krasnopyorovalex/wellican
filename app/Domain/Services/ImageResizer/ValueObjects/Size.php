<?php

declare(strict_types=1);

namespace Domain\Services\ImageResizer\ValueObjects;

final readonly class Size
{
    public function __construct(private int $width, private int $height, private string $postfix = '')
    {
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getPostfix(): string
    {
        return $this->postfix;
    }
}
