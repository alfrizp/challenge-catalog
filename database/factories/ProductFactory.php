<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use App\Models\Product;
use App\Models\Supplier;

$factory->define(Product::class, function (Faker $faker) {
    $imgDir = __DIR__. '/../seeds/images/';
    $imgNameList = array_diff(scandir($imgDir), ['..', '.']);
    $imgFiles = [];

    foreach ($imgNameList as $imgName) {
        $imgFiles[] = $imgDir . $imgName;
    }

    $imgFilesIdx = rand(0, count($imgFiles) - 1);
    $imagePath = $imgFiles[$imgFilesIdx];

    $productType = ['Jaket', 'Tshirt', 'Sepatu', 'Celana', 'Topi'];
    $productTypeIdx = rand(0, count($productType) - 1);
    $productName = $productType[$productTypeIdx] . ' ' . $faker->colorName . ' ' . rand(1, 99);

    $imageFile = Storage::putFile('public/images', new File($imagePath));

    return [
        'name' => $productName,
        'price' =>  $faker->numberBetween(50000, 1500000),
        'is_active' => $faker->boolean,
        'supplier_id' => function () {
            return factory(Supplier::class)->create()->id;
        },
        'image_file' => $imageFile,
    ];
});
