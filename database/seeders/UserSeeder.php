<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 20; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => Hash::make('123456789'),
                'gender' => $faker->randomElement($array = ['Male', 'Female']),
                'job' => $faker->jobTitle(),
                'phone_number' => $faker->phoneNumber(),
                'has_paid' => 1,
                'register_price' => rand(100000, 125000),
                'profile' => 'profile/' . $faker->numberBetween(1, 4) . '.jpg',
            ]);
        }

    }
}
