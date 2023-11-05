<?php

declare(strict_types=1);

namespace Domain\Entities\Role\Enums;

enum RolesEnum: string
{
    case SUPER_ADMIN = 'super_admin';
    case MANAGER = 'manager';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Супер администратор',
            self::MANAGER => 'Менеджер',
        };
    }
}
