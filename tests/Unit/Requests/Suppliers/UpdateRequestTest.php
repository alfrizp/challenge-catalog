<?php

namespace Tests\Unit\Requests\Suppliers;

use Tests\TestCase;
use Tests\Traits\ValidateFormRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Requests\Suppliers\UpdateRequest as SupplierUpdateRequest;

use App\Models\City;
use App\Models\Supplier;

class UpdateRequestTest extends TestCase
{
    use RefreshDatabase, ValidateFormRequest;

    private function getUpdateAttributes($overrides = [])
    {
        $city = factory(City::class)->create();

        return array_merge([
            'name'        => 'Supplier Name',
            'city_id' => $city->id,
            'birth_year' => 1990
        ], $overrides);
    }

    /** @test */
    public function it_pass_for_required_attributes()
    {
        $this->assertValidationPasses(new SupplierUpdateRequest(), $this->getUpdateAttributes());
    }

    /** @test */
    public function it_fails_for_empty_attributes()
    {
        $this->assertValidationFails(new SupplierUpdateRequest(), [], function ($errors) {
            $this->assertCount(3, $errors);
            $this->assertEquals(__('validation.required'), $errors->first('name'));
            $this->assertEquals(__('validation.required'), $errors->first('city_id'));
            $this->assertEquals(__('validation.required'), $errors->first('birth_year'));
        });
    }

    /** @test */
    public function it_fails_if_city_id_does_not_exists()
    {
        $attributes = $this->getUpdateAttributes([
            'city_id' => 99
        ]);

        $this->assertValidationFails(new SupplierUpdateRequest(), $attributes, function ($errors) {
            $this->assertEquals(
                __('validation.exists', ['attribute' => 'city id']),
                $errors->first('city_id')
            );
        });
    }

    /** @test */
    public function it_fails_if_birth_year_more_than_now()
    {
        $attributes = $this->getUpdateAttributes([
            'birth_year' => 2100
        ]);

        $this->assertValidationFails(new SupplierUpdateRequest(), $attributes, function ($errors) {
            $this->assertEquals(
                __('validation.lt.numeric', ['attribute' => 'birth year', 'value' => date("Y")]),
                $errors->first('birth_year')
            );
        });
    }
}
