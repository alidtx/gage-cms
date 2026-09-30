<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EntityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'slug' => fake()->unique()->slug(),
            'category' => 'security',
            'is_active' => true,
            'is_featured' => false,
            'sort_order' => 0,
            'content' => [],
            'meta' => [],
        ];
    }
}
