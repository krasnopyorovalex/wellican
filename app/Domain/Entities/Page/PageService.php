<?php

declare(strict_types=1);

namespace Domain\Entities\Page;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Handler;
use Domain\Contracts\Persistence\HasEntity;
use Domain\Contracts\Persistence\HasPaginator;
use Domain\Entities\Page\Commands\DestroyCommand;
use Domain\Entities\Page\Commands\StoreCommand;
use Domain\Entities\Page\Commands\UpdateCommand;
use Domain\Entities\Page\Queries\GetAllQuery;
use Domain\Entities\Page\Queries\GetByIdQuery;
use Domain\Persistence\Storage\ValueObjects\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

final class PageService
{
    public function __construct(private readonly Handler $commandHandler)
    {
    }

    public function index(Request $request): LengthAwarePaginator
    {
        /** @var \Domain\Contracts\Persistence\HasPaginator $query */
        $query = $this->commandHandler->execute(new GetAllQuery($request));

        return $query->getCollection();
    }

    public function store(Request $request): Message
    {
        $payload = new Message();

        try {
            $this->commandHandler->execute(new StoreCommand($request));
            $payload->setMessage(__('actions.record.saved'));
        } catch (\Exception $exception) {
            $payload->setMessage($exception->getMessage());
        }

        return $payload;
    }

    public function getById(Request $request): Model
    {
        /** @var HasEntity $hasPayload */
        $hasPayload = $this->commandHandler->execute(
            new GetByIdQuery($request)
        );

        return $hasPayload->getEntity();
    }

    public function update(Request $request): Message
    {
        $payload = new Message();

        try {
            $this->commandHandler->execute(new UpdateCommand($request));
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
