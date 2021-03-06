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

$factory->define(App\User::class, function (Faker $faker) {
    static $user, $status;

    return [
    	'uuid' => $faker->uuid,
        'firstname' => $faker->firstName,
        'middlename' => $faker->firstNameMale,
        'surname' => $faker->lastName,
        'email' => $faker->email,
        'username' => $faker->userName,
        'password' => $faker->password,
        'created_by' => $user ?: $user = 1,
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = date_default_timezone_get())
    ];
});
