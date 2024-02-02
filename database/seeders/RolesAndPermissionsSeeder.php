<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domain\Entities\Role\Enums\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()['cache']->forget('spatie.permission.cache');

        Permission::query()->create(['guard_name' => 'web', 'name' => 'users.edit_own_profile']);

        Role::query()->create(['name' => RolesEnum::SUPER_ADMIN, 'guard_name' => 'web']);
        Role::query()->create(['name' => RolesEnum::MANAGER, 'guard_name' => 'web']);
    }
}
