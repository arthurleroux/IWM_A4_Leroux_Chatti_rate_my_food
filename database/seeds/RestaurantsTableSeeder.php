<?php

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $users = User::where('is_restaurant', 1)->get();
        $all_users = [];
        foreach($users as $user) {
            array_push($all_users, $user->id);
        }

        for($i = 1; $i <= 10; $i++){
            Restaurant::create([
                'user_id' => $faker->randomElement($all_users),
                'name' => $faker->company,
                'status' => "pending",
                'address' => $faker->address,
                'city' => $faker->city,
                'zip_code' => "92000",
                'average_price' => $faker->numberBetween(10,20),
                'average_rate' => $faker->numberBetween(0,10),
                'opening_time' => $faker->numberBetween(0,14)
            ]);
        }

    }
}
