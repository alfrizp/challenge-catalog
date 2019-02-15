<?php

namespace App\Http\Requests\Suppliers;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Supplier;

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
            'city_id' => 'required|exists:cities,id',
            'birth_year' => [
                'required',
                'integer',
                'gt:' . 1900,
                'lt:' . date("Y"),
            ]
        ];
    }

    public function save()
    {
        $supplier = $this->route('supplier');
        $supplier->update($this->validated());

        return $supplier;
    }
}
