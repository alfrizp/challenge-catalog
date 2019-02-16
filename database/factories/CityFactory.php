<?php

use Faker\Generator as Faker;

use App\Models\City;

$factory->define(City::class, function (Faker $faker) {
    return [
        'id' => rand(10001, 14999),
        'name' => $faker->city,
    ];
});
