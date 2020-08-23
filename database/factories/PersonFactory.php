<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'city_id' => factory(\App\Models\City::class)->create()->id,
        'contract_service_id' => factory(\App\Models\ContractService::class)->create()->id,
        'type' => 'conductor',
        'type_document' => 'other',
        'document' => '111.111.111/0001-01',
        'name' => $faker->name,
        'email' => $faker->email(),
        'cellphone' => $faker->phoneNumber,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'zip_code'  => '41207-205',
        'coordinates'  => $faker->word,
    ];
});

