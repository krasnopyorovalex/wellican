<?php

declare(strict_types=1);

namespace Domain\Entities\ObjectImage\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Entities\ObjectImage\ObjectImage;

final class DestroyCommand implements Command
{
    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        ObjectImage::query()
            ->where('id', $this->request->getId())
            ->delete();
    }
}
