<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'title' => fake()->sentence(),
            'description' => fake()->sentence(),
            'keywords' => '',
            'body' => fake()->realText(),
            'alias' => fake()->unique()->slug(),
        ];
    }
}
