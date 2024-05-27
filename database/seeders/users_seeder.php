<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class users_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 15; $i++) {
            DB::table('users')->insert([
                'id' => $faker->uuid(),
                'username' => $faker->userName(),
                'display_name' => $faker->name(),
                'email' => $faker->email(),
                'email' => $faker->email(),
                'avatar' => $faker->imageUrl(640, 480, 'people', true),
                'password' => bcrypt('12341234'),
            ]);
        }
    }
}
