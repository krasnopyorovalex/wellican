<?php

declare(strict_types=1);

namespace Domain\Entities\User;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Handler;
use Domain\Contracts\Persistence\HasEntity;
use Domain\Contracts\Persistence\HasPaginator;
use Domain\Entities\User\Commands\DestroyCommand;
use Domain\Entities\User\Commands\StoreCommand;
use Domain\Entities\User\Commands\UpdateCommand;
use Domain\Entities\User\Queries\GetAllQuery;
use Domain\Entities\User\Queries\GetByIdQuery;
use Domain\Entities\User\ValueObjects\Role;
use Domain\Persistence\Storage\ValueObjects\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

final class UserService
{
    public function __construct(private readonly Handler $commandHandler)
    {
    }

    public function index(Request $request): LengthAwarePaginator
    {
        /** @var HasPaginator $query */
        $query = $this->commandHandler->execute(new GetAllQuery($request));

        return $query->getCollection();
    }

    public function store(Request $request, Role $role): Message
    {
        $message = new Message();

        try {
            /** @var User $user */
            $this->commandHandler->execute(new StoreCommand($request, $role));
            $message->setMessage(__('actions.record.saved'));
        } catch (\Exception $exception) {
            $message->setMessage($exception->getMessage());
        }

        return $message;
    }

    public function getByRequest(Request $request): Model
    {
        /** @var HasEntity $hasEntity */
        $hasEntity = $this->commandHandler->execute(
            new GetByIdQuery($request)
        );

        return $hasEntity->getEntity();
    }

    public function update(Request $request, Role $role): Message
    {
        $message = new Message();

        try {
            $this->commandHandler->execute(new UpdateCommand($request, $role));
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
