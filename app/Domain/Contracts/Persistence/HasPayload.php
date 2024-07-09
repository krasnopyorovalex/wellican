<?php

namespace App\Domain\Contracts\Persistence;

use Domain\Entities\Object\ValueObjects\Payload;

interface HasPayload
{
    public function getPayload(): Payload;
}
