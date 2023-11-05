<?php

declare(strict_types=1);

namespace Domain\Entities\Location;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Handler;
use Domain\Contracts\Persistence\HasPaginator;
use Domain\Entities\Location\Commands\DestroyCommand;
use Domain\Entities\Location\Commands\StoreCommand;
use Domain\Entities\Location\Commands\UpdateCommand;
use Domain\Entities\Location\Queries\GetAllQuery;
use Domain\Entities\Location\Queries\GetByIdQuery;
use Domain\Persistence\Storage\ValueObjects\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

final class LocationService
{
    public function __construct(private readonly Handler $commandHandler)
    {
    }

    public function index(Request $request): LengthAwarePaginator
    {
        /** @var HasPaginator $query */
        $query = $this->commandHandler->execute(
            new GetAllQuery($request)
        );

        return $query->getCollection();
    }

    public function getByRequest(Request $request): Model
    {
        /** @var \Domain\Contracts\Persistence\HasEntity $hasPayload */
        $hasPayload = $this->commandHandler->execute(
            new GetByIdQuery($request)
        );

        return $hasPayload->getEntity();
    }

    public function store(Request $request): Message
    {
        $message = new Message();

        try {
            $this->commandHandler->execute(
                new StoreCommand($request)
            );
            $message->setMessage(__('actions.record.saved'));
        } catch (\Exception $exception) {
            $message->setMessage($exception->getMessage());
        }

        return $message;
    }

    public function update(Request $request): Message
    {
        $message = new Message();

        try {
            $this->commandHandler->execute(
                new UpdateCommand($request)
            );
            $message->setMessage(__('actions.record.updated'));
        } catch (\Exception $exception) {
            $message->setMessage($exception->getMessage());
        }

        return $message;
    }

    public function destroy(Request $request): Message
    {
        $message = new Message();

        try {
            $this->commandHandler->execute(new DestroyCommand($request));
            $message->setMessage(__('actions.record.deleted'));
        } catch (\Exception $exception) {
            $message->setMessage($exception->getMessage());
        }

        return $message;
    }
}
