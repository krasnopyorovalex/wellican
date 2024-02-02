<?php

namespace Database\Factories;

use Domain\Entities\ObjectType\ObjectType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @extends Factory<ObjectType>
 */
class ObjectTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Model>
     */
    protected $model = ObjectType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();

        return [
            'name' => $name,
            'alias' => Str::slug($name, '-'),
            'description' => fake()->text(),
        ];
    }
}
