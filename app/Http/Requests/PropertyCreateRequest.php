<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyCreateRequest extends FormRequest
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
            'name' => 'required',
            'bhk' => 'integer|min:1',
            'location' => 'required',
            'desc' => 'array|required',
            'price' => 'required|numeric',
            'is_available' => 'required|boolean',
            'thumbnail' => 'required',
            'images' => 'nullable',
            'category_id' => 'required|exists:categories,id'
        ];
    }
}
