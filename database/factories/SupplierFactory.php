<?php

use Faker\Generator as Faker;
use App\Models\Supplier;
use App\Models\City;

$factory->define(Supplier::class, function (Faker $faker) {
    $cityCount = City::count();
    $allCity = City::all();

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'city_id' => $allCity[$faker->numberBetween(0, $cityCount - 1)]->id,
        'birth_year' => $faker->numberBetween(1945, 2018),
    ];
});
