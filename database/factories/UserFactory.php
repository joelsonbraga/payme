<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(\App\Models\User::class, function (Faker $faker) {
    $person = factory(\App\Models\Person::class)->create();

    return [
        'uuid' => $faker->unique()->uuid,
        'person_id' => $person->id,
        'name' => $person->name,
        'email' => $person->email,
        'email_verified_at' => now(),
        'password' => \Illuminate\Support\Facades\Hash::make('password'),
        'remember_token' => Str::random(10),
    ];
});
