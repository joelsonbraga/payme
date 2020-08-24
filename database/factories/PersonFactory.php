<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'type' => 'master',
        'type_document' => 'cnpj',
        'document' => '111.111.111/0001-01',
        'name' => $faker->name,
        'email' => $faker->email(),
        'cellphone' => $faker->phoneNumber,
    ];
});

