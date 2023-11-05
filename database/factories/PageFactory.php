<?php

namespace Database\Factories;

use Domain\Entities\Page\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<Page>
 */
class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Model>
     */
    protected $model = Page::class;

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
