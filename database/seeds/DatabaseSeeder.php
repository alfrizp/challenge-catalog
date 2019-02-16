<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CitiesTableSeeder::class);

        $this->call(SupplierTableSeeder::class);

        $this->call(ProductsTableSeeder::class);
    }
}
