<?php

declare(strict_types=1);

namespace Domain\Contracts\Persistence;

use Domain\Contracts\Http\Request;
use Illuminate\Database\Eloquent\Model;

abstract class EntityCommand implements Command
{
    public function __construct(protected readonly Request $request, protected readonly Model $model)
    {
    }
}
