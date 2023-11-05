<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage;

use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\DatabaseResource;
use Domain\Contracts\Persistence\Handler;

final class CommandHandler implements Handler
{
    public function execute(Command $command): DatabaseResource
    {
        return $command->handle();
    }
}
