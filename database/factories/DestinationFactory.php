<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destination>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'location' => $this->faker->address(),
            'contact' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'cover' => $this->faker->imageUrl(640, 480, 'business', true, 'cover'),
            'entrance_fee' => $this->faker->randomFloat(2, 0, 500),
            'availability' => $this->faker->boolean(),
            'service_offer' => $this->faker->sentence(6),
            'events' => $this->faker->sentence(8),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
