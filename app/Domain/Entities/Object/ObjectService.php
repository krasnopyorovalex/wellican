<?php

declare(strict_types=1);

namespace Domain\Entities\Object;

use App\Domain\Entities\Object\Commands\DestroyCommand;
use App\Domain\Entities\Object\Requests\DestroyRequest;
use App\Domain\Entities\Object\ValueObjects\Payload;
use Domain\Contracts\Persistence\Handler;
use Domain\Entities\Object\Queries\GetObjectByIdQuery;
use Domain\Entities\Object\Requests\EditRequest;
use Domain\Entities\Object\Requests\IndexRequest;
use Domain\Entities\Object\Queries\GetAllObjectsQuery;

final class ObjectService
{
    public function __construct(private readonly Handler $commandHandler)
    {
    }

    public function index(IndexRequest $request): Payload
    {
        $command = $this->commandHandler->execute(
            new GetAllObjectsQuery($request)
        );

        return $command->getPayload();
    }

    public function edit(EditRequest $request): Payload
    {
        $command = $this->commandHandler->execute(
            new GetObjectByIdQuery($request)
        );

        return $command->getPayload();
    }

    public function destroy(DestroyRequest $request): void
    {
        $this->commandHandler->execute(
            new DestroyCommand($request)
        );
    }
}
