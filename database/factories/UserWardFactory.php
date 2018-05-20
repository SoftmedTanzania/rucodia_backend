<?php

use Faker\Generator as Faker;
use App\User;
use App\Level;
use App\Location;
use App\Ward;
use App\Transaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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

$factory->define(App\User_Ward::class, function (Faker $faker) {
    static $user;

    return [
        'uuid' => $faker->uuid,
        'ward_id' => App\Ward::all()->random()->id,
    	'user_id' => App\User::all()->unique()->random()->id,
        'created_by' => $user ?: $user = 1,
        'created_at' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});