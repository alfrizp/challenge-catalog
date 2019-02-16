<?php

namespace Tests\Unit\Requests\Products;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Tests\Traits\ValidateFormRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Product;
use App\Models\Supplier;
use App\Http\Requests\Products\CreateRequest as ProductCreateRequest;

class CreateRequestTest extends TestCase
{
    use RefreshDatabase, ValidateFormRequest;

    private function getCreateAttributes($overrides = [])
    {
        $image = UploadedFile::fake()->image('avatar.jpg');

        $supplier = factory(Supplier::class)->create();

        return array_merge([
            'name'        => 'Product Name',
            'price'       => 100000,
            'supplier_id' => $supplier->id,
            'image' => $image
        ], $overrides);
    }

    /** @test */
    public function it_pass_for_required_attributes()
    {
        $attributes = $this->getCreateAttributes();
        $this->assertValidationPasses(new ProductCreateRequest(), $attributes);
    }

    /** @test */
    public function it_fails_for_empty_attributes()
    {
        $this->assertValidationFails(new ProductCreateRequest(), [], function ($errors) {
            $this->assertCount(4, $errors);
            $this->assertEquals(__('validation.required'), $errors->first('name'));
            $this->assertEquals(__('validation.required'), $errors->first('price'));
            $this->assertEquals(__('validation.required'), $errors->first('supplier_id'));
            $this->assertEquals(__('validation.required'), $errors->first('image'));
        });
    }


    /** @test */
    public function it_fails_if_supplier_id_does_not_exists()
    {
        $attributes = $this->getCreateAttributes([
            'supplier_id' => 99
        ]);

        $this->assertValidationFails(new ProductCreateRequest(), $attributes, function ($errors) {
            $this->assertEquals(
                __('validation.exists', ['attribute' => 'supplier id']),
                $errors->first('supplier_id')
            );
        });
    }

    /** @test */
    public function it_fails_if_upload_not_image_file()
    {
        $attributes = $this->getCreateAttributes([
            'image' => UploadedFile::fake()->create('document.pdf', 512),
        ]);

        $this->assertValidationFails(new ProductCreateRequest(), $attributes, function ($errors) {
            $this->assertEquals(
                __('validation.image', ['attribute' => 'image']),
                $errors->first('image')
            );
        });
    }

    /** @test */
    public function it_fails_if_iamge_file_size_more_than_2048_kilobytes()
    {
        $attributes = $this->getCreateAttributes([
            'image' => UploadedFile::fake()->image('avatar.jpg')->size(3192),
        ]);

        $this->assertValidationFails(new ProductCreateRequest(), $attributes, function ($errors) {
            $this->assertEquals(
                __('validation.max.file', ['attribute' => 'image', 'max' => 2048]),
                $errors->first('image')
            );
        });
    }
}
