<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class messages_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $user_id = DB::table('users')->pluck('id')->toArray();
        // show user_id data to debug
        
        print_r($user_id);
        

        for ($i = 0; $i < 150; $i++) {
            DB::table('messages')->insert([
                'id' => $faker->uuid(),
                'user_id' => $faker->randomElement($user_id),
                'message_sender' => $faker->name(),
                'message_title' => $faker->sentence(1),
                'message_content' => $faker->text(),
                'created_at' => now(),
            ]);
        }
    }
}
