<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Destination::create([
                'name' => $faker->company(),
                'location' => $faker->address(),
                'contact' => $faker->phoneNumber(),
                'email' => $faker->safeEmail(),
                'cover' => $faker->imageUrl(640, 480, 'business', true, 'cover'),
                'entrance_fee' => $faker->randomFloat(2, 0, 500),
                'availability' => $faker->boolean(),
                'service_offer' => $faker->sentence(6),
                'events' => $faker->sentence(8),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
