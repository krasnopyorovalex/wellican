<?php

declare(strict_types=1);

namespace Domain\Entities\Info\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Entities\Info\Info;

final class UpdateCommand implements Command
{
    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        Info::query()
            ->where('id', $this->request->getId())
            ->update($this->request->toDatabase());
    }
}
