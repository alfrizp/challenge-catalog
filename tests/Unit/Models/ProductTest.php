<?php

namespace Tests\Unit\Models;

use Tests\TestCase as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use App\Models\Supplier;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_product_has_status_label_attribute()
    {
        $product = factory(Product::class)->create([
            'is_active' => true
        ]);
        $this->assertEquals('<span class="badge badge-md badge-success">Aktif</span>', $product->status_label);

        $product = factory(Product::class)->create([
            'is_active' => false
        ]);
        $this->assertEquals('<span class="badge badge-md badge-danger">Nonaktif</span>', $product->status_label);
    }

    /** @test */
    public function a_product_has_format_price_attribute()
    {
        $product = factory(Product::class)->create([
            'price' => 10000
        ]);

        $this->assertEquals('Rp 10.000,00', $product->format_price);
    }

    /** @test */
    public function a_product_has_image_url_attribute()
    {
        $product = factory(Product::class)->create();

        $this->assertEquals(Storage::url($product->image_file), $product->image_url);
    }

    /** @test */
    public function a_product_has_belongs_to_supplier_relation()
    {
        $product = factory(Product::class)->make();

        $this->assertInstanceOf(Supplier::class, $product->supplier);
        $this->assertEquals($product->supplier_id, $product->supplier->id);
    }
}
