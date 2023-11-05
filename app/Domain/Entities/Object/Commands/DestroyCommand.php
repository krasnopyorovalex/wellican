<?php

declare(strict_types=1);

namespace App\Domain\Entities\Object\Commands;

use App\Domain\Contracts\Persistence\HasPayload;
use App\Domain\Entities\Object\Requests\DestroyRequest;
use App\Domain\Entities\Object\ValueObjects\Payload;
use App\Models\Objects;
use Domain\Contracts\Persistence\Command;

class DestroyCommand implements Command, HasPayload
{
    private int $payload;

    public function __construct(private readonly DestroyRequest $request)
    {

    }

    public function handle(): void
    {
        $this->payload = Objects::query()->where('id', $this->request->id)->delete();
    }

    public function getPayload(): Payload
    {
        return new Payload($this->payload);
    }
}
