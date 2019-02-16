<?php

namespace Tests\Unit\Models;

use Tests\TestCase as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;

use App\Models\City;
use App\Models\Product;
use App\Models\Supplier;

class SupplierTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_supplier_has_age_attribute()
    {
        $supplier = factory(Supplier::class)->create([
            'birth_year' => 2000
        ]);

        $this->assertEquals(19, $supplier->age);
    }

    /** @test */
    public function a_supplier_has_belongs_to_city_relation()
    {
        $supplier = factory(Supplier::class)->make();

        $this->assertInstanceOf(City::class, $supplier->city);
        $this->assertEquals($supplier->city_id, $supplier->city->id);
    }

    /** @test */
    public function a_supplier_has_many_products_relation()
    {
        $supplier = factory(Supplier::class)->create();
        $product = factory(Product::class)->create([
            'supplier_id' => $supplier->id
        ]);

        $this->assertInstanceOf(Collection::class, $supplier->products);
        $this->assertInstanceOf(Product::class, $supplier->products->first());
    }
}
