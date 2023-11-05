<?php

declare(strict_types=1);

namespace Domain\Entities\Permission\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Spatie\Permission\Models\Permission;

final class UpdateCommand implements Command
{
    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        Permission::query()
            ->where('id', $this->request->getId())
            ->update($this->request->toDatabase());
    }
}
