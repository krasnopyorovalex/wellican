<?php

declare(strict_types=1);

namespace Domain\Entities\Page\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Entities\Page\Page;

class UpdateCommand implements Command
{
    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        Page::query()
            ->where('id', $this->request->getId())
            ->update($this->request->toDatabase());
    }
}
