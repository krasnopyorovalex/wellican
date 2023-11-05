<?php

declare(strict_types=1);

namespace Domain\Entities\Location\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Entities\Location\Location;

final class StoreCommand implements Command
{
    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        Location::query()->create($this->request->toDatabase());
    }
}
