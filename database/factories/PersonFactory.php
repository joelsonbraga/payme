<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'uuid' => $faker->unique()->uuid,
        'type' => 'master',
        'type_document' => 'cnpj',
        'document' => \Illuminate\Support\Str::random(10),
        'name' => $faker->name,
        'email' => $faker->unique()->email(),
        'cellphone' => $faker->phoneNumber,
    ];
});

