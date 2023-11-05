<?php

declare(strict_types=1);

namespace Domain\Entities\Image\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Entities\Image\Image;

final class DestroyImageCommand implements Command
{
    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        Image::query()->where('id', $this->request->getId())->delete();
    }
}
