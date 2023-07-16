<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:30|min:3',
            'image' => 'nullable|image|dimensions:min_width=400,min-height:400|max:1024',
        ];
    }

    public function messages() :array
    {
        return [
            'required'=> 'The Name field is Required',
            'min' => 'The minimum characters is 3 characters',
            'max' => 'the maximum characters is 50 characters'
        ];
    }
}
