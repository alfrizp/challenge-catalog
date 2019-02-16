<?php

use Illuminate\Database\Seeder;

use App\Models\Supplier;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CitiesTableSeeder::class);

        factory(Supplier::class)->times(100)->create();

        $this->call(ProductsTableSeeder::class);
    }
}
