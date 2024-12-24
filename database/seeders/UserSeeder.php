<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use Faker\Factory as Faker;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => "user{$i}",
                'email' => "user{$i}@gmail.com",
                'password' => Hash::make('password'), // Hash the password
                'role' => 'user',
                'remember_token' => Str::random(10),
            ]);
        }


    }
}
