<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
            'price' => 'required|numeric|min:1',
            'is_active' => 'nullable',
            'image' => 'required|image|max:2048',
        ];
    }

    public function save()
    {
        $newProduct = $this->validated();
        $newProduct['is_active'] = isset($newProduct['is_active']);

        $path = $newProduct['image']->store('public/images');
        $newProduct['image_file'] = $path;

        return Product::create($newProduct);
    }
}
