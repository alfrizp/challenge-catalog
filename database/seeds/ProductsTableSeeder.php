<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use App\Models\Supplier;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    protected function deleteAllImageStorage()
    {
        $allFiles = Storage::files('public/images');
        foreach ($allFiles as $file) {
            Storage::delete($file);
        }
    }

    protected function getAllDummyImage()
    {
        $imgDir = __DIR__. '/images/';
        $imgNameList = array_diff(scandir($imgDir), ['..', '.']);
        $imgFiles = [];

        foreach ($imgNameList as $imgName) {
            $imgFiles[] = $imgDir . $imgName;
        }

        return $imgFiles;
    }

    public function run(Faker $faker)
    {
        $this->deleteAllImageStorage();

        $imgFiles = $this->getAllDummyImage();

        $suppliers = Supplier::all();

        $productType = ['Jaket', 'Tshirt', 'Sepatu', 'Celana', 'Topi'];

        foreach ($suppliers as $supplier) {

            for ($i=0; $i < 3; $i++) {
                $imgFilesIdx = rand(0, count($imgFiles) - 1);
                $imagePath = $imgFiles[$imgFilesIdx];

                $productTypeIdx = $faker->numberBetween(0, count($productType) - 1);
                $suppliersIdx = $faker->numberBetween(0, $suppliers->count() - 1);
                $productName = $productType[$productTypeIdx] . ' ' . $faker->colorName . ' ' . $faker->numberBetween(1, 99);

                $imageFile = Storage::putFile('public/images', new File($imagePath));

                Product::create([
                    'name' => $productName,
                    'supplier_id' => $suppliers[$suppliersIdx]->id,
                    'price' =>  $faker->numberBetween(50000, 1500000),
                    'is_active' => $faker->boolean,
                    'image_file' => $imageFile,
                ]);
            }
        }
    }
}
