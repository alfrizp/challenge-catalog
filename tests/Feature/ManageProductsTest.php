<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Supplier;
use App\Models\Product;

class ManageProductsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_see_product_list_in_product_index_page()
    {
        $product = factory(Product::class)->create();

        $this->visit(route('products.index'));
        $this->see($product->name);
    }

    /** @test */
    public function can_create_a_product()
    {
        $supplier = factory(Supplier::class)->create();
        $image = UploadedFile::fake()->image('avatar.jpg');

        $this->visit(route('products.index'));

        $this->click(__('product.add_product'));
        $this->seePageIs(route('products.index', ['action' => 'create']));

        $this->submitForm(__('product.save'), [
            'name'        => 'Product Name',
            'price'       => 100000,
            'supplier_id' => $supplier->id,
            'image' => $image
        ]);

        $this->seePageIs(route('products.index'));

        $this->seeInDatabase('products', [
            'name'        => 'Product Name',
            'price'       => 100000,
            'supplier_id' => $supplier->id,
            'is_active' => 0,
        ]);
    }

    /** @test */
    public function can_edit_a_product_within_search_query()
    {
        $product = factory(Product::class)->create();
        $image = UploadedFile::fake()->image('avatar.jpg');

        $this->visit(route('products.index'));
        $this->click('edit-product-'.$product->id);
        $this->seePageIs(route('products.index', ['action' => 'edit', 'id' => $product->id]));

        $this->submitForm(__('product.edit'), [
            'name' => 'Product Name 1',
            'price' => 350000,
            'supplier_id' => $product->supplier_id,
            'is_active' => 'on',
            'image' => $image
        ]);

        // dump(Product::all()->toArray());
        $this->seePageIs(route('products.index'));
        $this->seeInDatabase('products', [
            'name'        => 'Product Name 1',
            'price'       => 350000,
            'supplier_id' => $product->supplier_id,
            'is_active' => 1,
        ]);
    }

    /** @test */
    public function can_delete_a_product()
    {
        $product = factory(Product::class)->create();

        $this->visit(route('products.index'));
        $this->click('del-product-'.$product->id);
        $this->seePageIs(route('products.index', ['action' => 'delete', 'id' => $product->id]));

        $this->seeInDatabase('products', [
            'id' => $product->id,
        ]);

        $this->press(__('product.delete_confirm_btn'));

        $this->dontSeeInDatabase('products', [
            'id' => $product->id,
            'deleted_at' => null,
        ]);
    }
}
