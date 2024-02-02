<?php

declare(strict_types=1);

namespace Domain\Entities\Image\Requests;

use Domain\Contracts\Http\Request;

final class ImageRequest extends Request
{
    protected string $alt;

    protected string $title;

    protected int $imageableId;

    protected string $imageableType;

    public function toDatabase(): array
    {
        return array_filter([
            'alt' => $this->alt ?? '',
            'title' => $this->title ?? '',
            'imageable_id' => $this->imageableId ?? 0,
            'imageable_type' => $this->imageableType ?? '',
        ]);
    }
}
