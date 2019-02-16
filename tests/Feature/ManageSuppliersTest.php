<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Supplier;
use App\Models\City;

class ManageSuppliersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_see_supplier_list_in_supplier_index_page()
    {
        $supplier = factory(Supplier::class)->create();

        $this->visit(route('suppliers.index'));
        $this->see($supplier->name);
    }

    /** @test */
    public function can_create_a_supplier()
    {
        $city = factory(City::class)->create();

        $this->visit(route('suppliers.index'));

        $this->click(__('supplier.add_supplier'));
        $this->seePageIs(route('suppliers.index', ['action' => 'create']));

        $this->submitForm(__('supplier.save'), [
            'name'        => 'Supplier Name',
            'email'       => 'supplier@mail.com',
            'city_id' => $city->id,
            'birth_year' => 1990
        ]);

        $this->seePageIs(route('suppliers.index'));

        $this->seeInDatabase('suppliers', [
            'name'        => 'Supplier Name',
            'email'       => 'supplier@mail.com',
            'city_id' => $city->id,
            'birth_year' => 1990
        ]);
    }

    /** @test */
    public function can_edit_a_supplier_within_search_query()
    {
        $supplier = factory(Supplier::class)->create();

        $this->visit(route('suppliers.index'));
        $this->click('edit-supplier-'.$supplier->id);
        $this->seePageIs(route('suppliers.index', ['action' => 'edit', 'id' => $supplier->id]));

        $this->submitForm(__('supplier.edit'), [
            'name'        => 'Supplier Name',
            'city_id' => $supplier->city_id,
            'birth_year' => 1980
        ]);

        $this->seePageIs(route('suppliers.index'));
        $this->seeInDatabase('suppliers', [
            'name'        => 'Supplier Name',
            'email'       => $supplier->email,
            'city_id' => $supplier->city_id,
            'birth_year' => 1980
        ]);
    }

    /** @test */
    public function can_delete_a_supplier()
    {
        $supplier = factory(Supplier::class)->create();

        $this->visit(route('suppliers.index'));
        $this->click('del-supplier-'.$supplier->id);
        $this->seePageIs(route('suppliers.index', ['action' => 'delete', 'id' => $supplier->id]));

        $this->seeInDatabase('suppliers', [
            'id' => $supplier->id,
        ]);

        $this->press(__('supplier.delete_confirm_btn'));

        $this->dontSeeInDatabase('suppliers', [
            'id' => $supplier->id,
            'deleted_at' => null,
        ]);
    }
}
