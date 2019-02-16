<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\Supplier;
use App\Models\City;

class SupplierTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $cityCount = City::count();
        $allCity = City::all();

        for ($i=0; $i < 100 ; $i++) {
            Supplier::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'city_id' => $allCity[rand(0, $cityCount - 1)]->id,
                'birth_year' => rand(1945, 2018),
            ]);
        }
    }
}
