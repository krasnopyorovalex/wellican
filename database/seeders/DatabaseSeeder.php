<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Locations;
use App\Models\Objects;
use App\Models\ObjectTypes;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);

         foreach (['Квартиры', 'Коммерческая недвижимость', 'Дома, коттеджи, таунхаусы', 'Земельные участки'] as $item) {
             ObjectTypes::factory()->create([
                 'name' => $item,
                 'alias' => Str::slug($item, '-')
             ]);
         }

         Locations::factory()->count(50)->create();

         Objects::factory()->count(100)->create();
    }
}
