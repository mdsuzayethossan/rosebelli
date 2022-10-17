<?php

namespace App\Http\Requests;

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
        return [
            'category' => 'required',
            'subcategory' => 'required',
            'product_name' => 'required',
            'product_group' => 'required',
            'product_price' => 'required',
            'discount' => 'required',
            'description' => 'required',
            'product_image' => 'required|image',
        ];
    }
}
