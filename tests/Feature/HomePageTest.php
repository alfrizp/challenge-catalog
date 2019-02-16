<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Product;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_see_product_list_in_home_page()
    {
        $product = factory(Product::class)->create();

        $this->visit(route('home'));
        $this->see($product->name);
    }
}
