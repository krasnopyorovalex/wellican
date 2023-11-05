<?php

namespace Database\Factories;

use Domain\Entities\Location\Location;
use Domain\Entities\Object\Enums\IsPremium;
use Domain\Entities\Object\Enums\TypePurchase;
use Domain\Entities\ObjectType\ObjectType;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'type_id' => ObjectType::query()->get()->random()->id,
            'location_id' => Location::query()->get()->random()->id,
            'alias' => fake()->unique()->slug(),
            'name' => fake()->streetAddress(),
            'price' => fake()->numberBetween(5000, 55000000),
            'type_purchase' => fake()->randomElement([TypePurchase::Rent, TypePurchase::Buy]),
            'square' => fake()->randomFloat(1, 2, 90000000),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'description' => fake()->realText(),
            'address' => fake()->address(),
            'is_premium' => fake()->randomElement([IsPremium::Yes, IsPremium::Not]),
        ];
    }
}
