<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route('product');

        return [
            'name' => ['required', 'string', 'max:50', Rule::unique('products')->ignore($id)],
            'image' => ['mimes:png,jpg,jpeg', 'max:2048'],
            'price' => ['required', 'numeric', 'min_digits:4'],
            'description' => ['required', 'string', 'max:1000'],
            'size' => ['required', 'string', 'max:1000'],
        ];
    }
}
