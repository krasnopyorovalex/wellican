<?php

declare(strict_types=1);

namespace Domain\Entities\ObjectType;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Handler;
use Domain\Contracts\Persistence\HasEntity;
use Domain\Contracts\Persistence\HasPaginator;
use Domain\Entities\ObjectType\Commands\DestroyCommand;
use Domain\Entities\ObjectType\Commands\StoreCommand;
use Domain\Entities\ObjectType\Commands\UpdateCommand;
use Domain\Entities\ObjectType\Queries\GetAllQuery;
use Domain\Entities\ObjectType\Queries\GetByIdQuery;
use Domain\Persistence\Storage\ValueObjects\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

final class ObjectTypeService
{
    public function __construct(private readonly Handler $commandHandler)
    {
    }

    public function index(Request $request): LengthAwarePaginator
    {
        /** @var \Domain\Contracts\Persistence\HasPaginator $query */
        $query = $this->commandHandler->execute(
            new GetAllQuery($request)
        );

        return $query->getCollection();
    }

    public function getById(Request $request): Model
    {
        /** @var \Domain\Contracts\Persistence\HasEntity $hasPayload */
        $hasPayload = $this->commandHandler->execute(
            new GetByIdQuery($request)
        );

        return $hasPayload->getEntity();
    }

    public function store(Request $request): Message
    {
        $payload = new Message();

        try {
            $this->commandHandler->execute(
                new StoreCommand($request)
            );
            $payload->setMessage(__('actions.record.saved'));
        } catch (\Exception $exception) {
            $payload->setMessage($exception->getMessage());
        }

        return $payload;
    }

    public function update(Request $request): Message
    {
        $payload = new Message();

        try {
            $this->commandHandler->execute(
                new UpdateCommand($request)
            );
            $payload->setMessage(__('actions.record.updated'));
        } catch (\Exception $exception) {
            $payload->setMessage($exception->getMessage());
        }

        return $payload;
    }

    public function destroy(Request $request): Message
    {
        $payload = new Message();

        try {
            $this->commandHandler->execute(new DestroyCommand($request));
            $payload->setMessage(__('actions.record.deleted'));
        } catch (\Exception $exception) {
            $payload->setMessage($exception->getMessage());
        }

        return $payload;
    }
}
