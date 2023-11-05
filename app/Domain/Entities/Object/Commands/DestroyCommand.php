<?php

declare(strict_types=1);

namespace Domain\Entities\Object\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Entities\Object\Objects;

final class DestroyCommand implements Command
{
    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        Objects::query()
            ->where('id', $this->request->getId())
            ->delete();
    }
}
