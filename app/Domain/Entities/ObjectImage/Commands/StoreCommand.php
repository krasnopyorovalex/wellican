<?php

declare(strict_types=1);

namespace Domain\Entities\ObjectImage\Commands;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Entities\ObjectImage\ObjectImage;

final class StoreCommand implements Command
{
    public function __construct(private readonly Request $request)
    {
    }

    public function handle(): void
    {
        $query = ObjectImage::query();

        $toDatabase = $this->request->toDatabase();
        $toDatabase = array_merge($toDatabase, [
            'position' => $query->where('object_id', $toDatabase['object_id'])->max('position') + 1,
        ]);

        $query->create($toDatabase);
    }
}
