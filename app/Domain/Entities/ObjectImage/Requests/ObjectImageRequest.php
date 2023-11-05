<?php

declare(strict_types=1);

namespace Domain\Entities\ObjectImage\Requests;

use Domain\Contracts\Http\Request;

final class ObjectImageRequest extends Request
{
    protected int $objectId;

    protected string $basename;

    protected string $directory;

    protected string $ext;

    protected int $position = 0;

    protected string $alt = '';

    protected string $title = '';

    public function toDatabase(): array
    {
        return array_filter([
            'object_id' => $this->objectId ?? false,
            'alt' => $this->alt,
            'title' => $this->title,
            'filename' => isset($this->basename) ? pathinfo($this->basename, PATHINFO_FILENAME) : false,
            'ext' => isset($this->basename) ? pathinfo($this->basename, PATHINFO_EXTENSION) : false,
            'position' => $this->position,
            'directory' => $this->directory ?? false,
        ]);
    }
}
