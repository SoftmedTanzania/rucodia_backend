<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Location_User::class, function (Faker $faker) {
    static $user;

    return [
        'uuid' => $faker->uuid,
        'location_id' => App\Location::all()->random()->id,
    	'user_id' => App\User::all()->unique()->random()->id,
        'created_by' => $user ?: $user = 1,
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});