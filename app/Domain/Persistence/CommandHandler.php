<?php

declare(strict_types=1);

namespace Domain\Persistence;

use Domain\Contracts\Persistence\Handler;
use Domain\Contracts\Persistence\Command;

final class CommandHandler implements Handler
{
    public function execute(Command $query): Command
    {
        $query->handle();

        return $query;
    }
}
