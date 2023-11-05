<?php

declare(strict_types=1);

namespace Domain\Entities\ObjectType\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Entities\ObjectType\ObjectType;

final class DestroyCommand implements Command
{
    public function __construct(private readonly Request $request)
    {

    }

    public function handle(): void
    {
        ObjectType::query()
            ->where('id', $this->request->getId())
            ->delete();
    }
}
