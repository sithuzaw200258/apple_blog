<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            "title" => "bail|required|min:2|unique:posts",
            "category" => "required|exists:categories,id",
            "photos" => "required",
            "photos.*" => "mimes:png,jpg,jpeg|file|max:5000",
            "description" => "required|min:5",
            "featured_image" => "nullable|mimes:png,jpg,jpeg|file|max:5000"
        ];
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'photos.*' => 'photos',
        ];
    }
}
