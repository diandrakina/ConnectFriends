<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FriendRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 20; $i++) {
            $sender_id = $faker->numberBetween(1, 20);
            $receiver_id = $faker->numberBetween(1, 20);

            while ($sender_id === $receiver_id) {
                $receiver_id = $faker->numberBetween(1, 20);
            }

            DB::table('friend_requests')->insert([
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id
            ]);
        }
    }
}
