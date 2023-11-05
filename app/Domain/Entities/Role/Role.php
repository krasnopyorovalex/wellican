<?php

declare(strict_types=1);

namespace Domain\Entities\Role;

final class Role extends \Spatie\Permission\Models\Role
{
    protected $with = ['permissions'];
}
