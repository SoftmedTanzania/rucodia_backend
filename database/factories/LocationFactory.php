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

$factory->define(App\Location::class, function (Faker $faker) {
    static $user;

    return [
        'uuid' => $faker->uuid,
        'name' => $faker->streetName,
    	'latitude' => $faker->latitude($min = -5, $max = -1),
    	'longitude' => $faker->longitude($min = -27, $max = 31),
        'created_by' => $user ?: $user = 1,
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});