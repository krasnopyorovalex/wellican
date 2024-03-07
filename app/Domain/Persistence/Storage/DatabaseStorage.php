<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage;

use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\Handler;
use Domain\Contracts\Persistence\Storage;
use Domain\Persistence\Storage\ValueObjects\Id;
use Domain\Persistence\Storage\ValueObjects\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

final readonly class DatabaseStorage implements Storage
{
    public function __construct(private Handler $handler)
    {
    }

    public function getAll(Command $command): LengthAwarePaginator|Collection
    {
        return $this->handler->execute($command)->get();
    }

    public function store(Command $command): Message
    {
        $message = new Message();

        try {
            $model = $this->handler->execute($command)->get();
            $message->setId(new Id($model->id));
            $message->setValue(__('actions.record.saved'));
        } catch (\Exception $exception) {
            $message->setValue($exception->getMessage());
        }

        return $message;
    }

    public function getByQuery(Command $query): Model
    {
        return $this->handler->execute($query)->get();
    }

    public function update(Command $command): Message
    {
        $message = new Message();

        try {
            $model = $this->handler->execute($command)->get();
            $message->setValue(__('actions.record.updated', ['id' => $model->id]));
        } catch (\Exception $exception) {
            $message->setValue($exception->getMessage());
        }

        return $message;
    }

    public function destroy(Command $command): Message
    {
        $message = new Message();

        try {
            $model = $this->handler->execute($command)->get();
            $message->setValue(__('actions.record.deleted', ['id' => $model->id]));
        } catch (\Exception $exception) {
            $message->setValue($exception->getMessage());
        }

        return $message;
    }
}
