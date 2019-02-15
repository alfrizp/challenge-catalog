<?php

use Illuminate\Database\Seeder;
use App\Services\CsvToArray;
use App\Models\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $Csv = new CsvtoArray;
        $file = __DIR__. '/csv/cities.csv';
        $header = array('id', 'name');
        $data = $Csv->csv_to_array($file, $header);
        $collection = collect($data);
        foreach($collection->chunk(50) as $chunk) {
            \DB::table('cities')->insert($chunk->toArray());
        }
    }
}
