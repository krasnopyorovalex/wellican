<?php

declare(strict_types=1);

namespace Domain\Exceptions;

use Exception;

final class IdException extends Exception
{
    public static function idRequired(): IdException
    {
        return new self(__('persistence.required.id'));
    }
}
