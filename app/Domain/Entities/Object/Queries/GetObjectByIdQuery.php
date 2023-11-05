<?php

declare(strict_types=1);

namespace Domain\Entities\Object\Queries;

use App\Domain\Contracts\Persistence\HasPayload;
use App\Domain\Entities\Object\ValueObjects\Payload;
use Domain\Contracts\Persistence\Command;
use Domain\Entities\Object\Requests\EditRequest;
use App\Models\Objects;
use Illuminate\Database\Eloquent\Model;

final class GetObjectByIdQuery implements Command, HasPayload
{
    private Model $payload;

    public function __construct(public readonly EditRequest $request)
    {
    }

    public function getPayload(): Payload
    {
        return new Payload($this->payload);
    }

    public function handle(): void
    {
        $this->payload = Objects::query()
            ->where('id', $this->request->id)
            ->firstOrFail();
    }
}
