<?php

namespace Database\Factories;

use App\Domain\Entities\Object\Enums\TypePurchase;
use App\Models\Locations;
use App\Models\ObjectTypes;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ObjectsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_id' => ObjectTypes::query()->get()->random()->id,
            'location_id' => Locations::query()->get()->random()->id,
            'alias' => fake()->unique()->slug(),
            'name' => fake()->streetAddress(),
            'price' => fake()->numberBetween(5000, 55000000),
            'type_purchase' => fake()->randomElement([TypePurchase::Rent, TypePurchase::Buy]),
            'square' => fake()->numberBetween(1, 50000),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'description' => fake()->realText()
        ];
    }
}
