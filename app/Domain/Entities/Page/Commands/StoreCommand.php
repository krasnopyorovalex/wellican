<?php

declare(strict_types=1);

namespace Domain\Entities\Page\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Entities\Page\Page;

class StoreCommand implements Command
{
    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        Page::query()
            ->create($this->request->toDatabase());
    }
}
