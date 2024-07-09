<?php

namespace Database\Factories;

use Domain\Entities\Location\Location;
use Domain\Entities\Object\Enums\IsPremium;
use Domain\Entities\Object\Enums\TypePurchase;
use Domain\Entities\Object\Objects;
use Domain\Entities\ObjectLabel\ObjectLabel;
use Domain\Entities\ObjectType\ObjectType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<Objects>
 */
class ObjectsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Model>
     */
    protected $model = Objects::class;

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
            'label_id' => ObjectLabel::query()->get()->random()->id,
            'alias' => fake()->unique()->slug(),
            'articul' => sprintf('%s-%s', fake()->countryCode(), uniqid()),
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
