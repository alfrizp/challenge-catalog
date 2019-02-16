<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;

class UpdateRequest extends FormRequest
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
            'image' => 'sometimes|image|max:2048',
        ];
    }

    public function save()
    {
        $product = $this->route('product');

        $dataUpdate = $this->validated();
        $dataUpdate['is_active'] = isset($dataUpdate['is_active']);

        if ($this->hasFile('image')) {
            $path = $dataUpdate['image']->store('public/images');
            Storage::delete($product->image_file);
            $dataUpdate['image_file'] = $path;
        }

        return $product->update($dataUpdate);
    }
}
