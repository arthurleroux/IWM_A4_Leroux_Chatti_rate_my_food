<?php

use App\Models\Picture;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PicturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $restaurants = Restaurant::all();
        $restaurants_id = [];
        foreach($restaurants as $restaurant) {
            array_push($restaurants_id, $restaurant->id);
        }

        for($i = 1; $i <= 20; $i++){
            Picture::create([
                'restaurant_id' => $faker->randomElement($restaurants_id),
                'path' => 'http://lorempixel.com/600/400/food/'
            ]);
        }
    }
}
