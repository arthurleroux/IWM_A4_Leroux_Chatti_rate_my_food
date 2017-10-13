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
        $users_id = [];
        foreach($users as $user) {
            array_push($users_id, $user->id);
        }

        for($i = 1; $i <= 5; $i++){
            Restaurant::create([
                'user_id' => $faker->randomElement($users_id),
                'name' => $faker->company,
                'description' => $faker->text($maxNbChars = 200),
                'status' => "pending",
                'address' => $faker->address,
                'city' => $faker->city,
                'zip_code' => "92000",
                'average_price' => $faker->numberBetween(10,20),
                'average_rate' => $faker->numberBetween(0,10),
            ]);
        }

    }
}
