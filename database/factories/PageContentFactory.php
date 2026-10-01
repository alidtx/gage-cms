<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PageContentFactory extends Factory
{
    public function definition(): array
    {
        return ['name' => fake()->sentence(3), 'page' => fake()->unique()->slug(), 'content' => [],
            'meta' => [], 'is_active' => true, 'is_featured' => false, 'sort_order' => 0];
    }
}
