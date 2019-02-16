<?php

use Faker\Generator as Faker;
use App\Models\Supplier;
use App\Models\City;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'birth_year' => rand(1945, 2018),
        'city_id' => function () {
            return factory(City::class)->create()->id;
        },
    ];
});
