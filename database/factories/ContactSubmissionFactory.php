<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactSubmissionFactory extends Factory
{
    public function definition(): array
    {
        return ['full_name' => fake()->name(), 'email_address' => fake()->safeEmail(),
            'phone_number' => fake()->phoneNumber(), 'subject' => fake()->sentence(), 'message' => fake()->paragraph()];
    }
}
