<?php

declare(strict_types=1);

namespace Domain\Entities\User\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Entities\User\User;

class DestroyCommand implements Command
{
    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        User::query()
            ->where('id', $this->request->getId())
            ->delete();
    }
}
