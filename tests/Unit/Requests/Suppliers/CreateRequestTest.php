<?php

namespace Tests\Unit\Requests\Suppliers;

use Tests\TestCase;
use Tests\Traits\ValidateFormRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Requests\Suppliers\CreateRequest as SupplierCreateRequest;

use App\Models\City;
use App\Models\Supplier;

class CreateRequestTest extends TestCase
{
    use RefreshDatabase, ValidateFormRequest;

    private function getCreateAttributes($overrides = [])
    {
        $city = factory(City::class)->create();

        return array_merge([
            'name'        => 'Supplier Name',
            'email'       => 'supplier@mail.com',
            'city_id' => $city->id,
            'birth_year' => 1990
        ], $overrides);
    }

    /** @test */
    public function it_pass_for_required_attributes()
    {
        $this->assertValidationPasses(new SupplierCreateRequest(), $this->getCreateAttributes());
    }

    /** @test */
    public function it_fails_for_empty_attributes()
    {
        $this->assertValidationFails(new SupplierCreateRequest(), [], function ($errors) {
            $this->assertCount(4, $errors);
            $this->assertEquals(__('validation.required'), $errors->first('name'));
            $this->assertEquals(__('validation.required'), $errors->first('email'));
            $this->assertEquals(__('validation.required'), $errors->first('city_id'));
            $this->assertEquals(__('validation.required'), $errors->first('birth_year'));
        });
    }

    /** @test */
    public function it_fails_if_email_does_not_valid()
    {
        $attributes = $this->getCreateAttributes([
            'email' => 'email@email'
        ]);

        $this->assertValidationFails(new SupplierCreateRequest(), $attributes, function ($errors) {
            $this->assertEquals(
                __('validation.email', ['attribute' => 'email']),
                $errors->first('email')
            );
        });
    }

    /** @test */
    public function it_fails_if_email_is_already_exist()
    {
        $supplier = factory(Supplier::class)->create([
            'email' => 'user@mail.com',
        ]);

        $attributes = $this->getCreateAttributes([
            'email' => $supplier->email
        ]);

        $this->assertValidationFails(new SupplierCreateRequest(), $attributes, function ($errors) {
            $this->assertEquals(
                __('validation.unique', ['attribute' => 'email']),
                $errors->first('email')
            );
        });
    }

    /** @test */
    public function it_fails_if_city_id_does_not_exists()
    {
        $attributes = $this->getCreateAttributes([
            'city_id' => 99
        ]);

        $this->assertValidationFails(new SupplierCreateRequest(), $attributes, function ($errors) {
            $this->assertEquals(
                __('validation.exists', ['attribute' => 'city id']),
                $errors->first('city_id')
            );
        });
    }

    /** @test */
    public function it_fails_if_birth_year_more_than_now()
    {
        $attributes = $this->getCreateAttributes([
            'birth_year' => 2100
        ]);

        $this->assertValidationFails(new SupplierCreateRequest(), $attributes, function ($errors) {
            $this->assertEquals(
                __('validation.lt.numeric', ['attribute' => 'birth year', 'value' => date("Y")]),
                $errors->first('birth_year')
            );
        });
    }
}
