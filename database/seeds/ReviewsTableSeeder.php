<?php

use App\Models\Restaurant;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $users = User::all();
        $users_id = [];
        foreach($users as $user) {
            array_push($users_id, $user->id);
        }

        $restaurants = Restaurant::all();
        $restaurants_id = [];
        foreach($restaurants as $restaurant) {
            array_push($restaurants_id, $restaurant->id);
        }

        for($i = 1; $i <= 10; $i++){
            Review::create([
                'user_id' => $faker->randomElement($users_id),
                'restaurant_id' => $faker->randomElement($restaurants_id),
                'status' => "pending",
                'comment' => $faker->text($maxNbChars = 200),
                'price' => $faker->numberBetween(1,5),
                'rating' => $faker->numberBetween(1,5)
            ]);
        }

    }
}
