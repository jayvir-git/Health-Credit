<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->company(),
            'specialty' => fake()->randomElement(['Cosmetic', 'Vision', 'Dental', 'Hearing', 'Veterinary', 'General', 'Other']),
            'address' => fake()->address(),
        ];
    }
}
