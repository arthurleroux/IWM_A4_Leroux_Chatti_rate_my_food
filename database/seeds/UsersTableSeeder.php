<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        static $password;
        for($i = 1; $i <= 10; $i++)
        {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => $password ?: $password = bcrypt('secret'),
                'remember_token' => str_random(10),
                'is_restaurant' => $faker->numberBetween(0,1)
            ]);
        }

    }
}

