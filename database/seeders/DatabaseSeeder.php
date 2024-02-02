<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Domain\Entities\Location\Location;
use Domain\Entities\Object\Objects;
use Domain\Entities\ObjectType\ObjectType;
use Domain\Entities\Page\Enums\Template;
use Domain\Entities\Page\Page;
use Domain\Entities\Role\Enums\RolesEnum;
use Domain\Entities\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        $user = User::factory()->create([
            'name' => 'Федя',
            'email' => 'test@example.com',
        ]);

        $user->assignRole(RolesEnum::SUPER_ADMIN);

        foreach (['Квартиры', 'Коммерческая недвижимость', 'Дома, коттеджи, таунхаусы', 'Земельные участки'] as $item) {
            ObjectType::factory()->create([
                'name' => $item,
                'alias' => Str::slug($item, '-'),
            ]);
        }

        Location::factory()->count(5)->create();
        Objects::factory()->count(5)->create();

        Page::factory()->create(['alias' => 'index']);
        Page::factory()->create(['alias' => 'catalog', 'name' => 'Каталог', 'template' => Template::PAGE,]);
        Page::factory()->create(['alias' => 'contacts', 'name' => 'Контакты', 'template' => Template::CONTACTS,]);
    }
}
