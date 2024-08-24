<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create("id_ID");
        for ($i = 0; $i < 20; $i++) {
            $user_id = $faker->numberBetween(1, 20);
            $friend_id = $faker->numberBetween(1, 20);

            while ($user_id === $friend_id) {
                $friend_id = $faker->numberBetween(1, 20);
            }

            DB::table('friends')->insert([
                'user_id' => $user_id,
                'friend_id' => $friend_id]
            );   
        }
    }
}
