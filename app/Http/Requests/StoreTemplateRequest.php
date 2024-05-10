<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTemplateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "template_title" => 'required|unique:templates,template_title',
            'template_picture' => 'required|image|mimes:png,jpeg,jpg|dimensions:max_width=4500,max_height=3939',
        ];
    }
    /**
     * Get custom error messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'template_title.unique' => 'User another title. This title has already been taken.',
            'template_title.required' => 'Please provide a title for the template.',
            'template_picture.required' => 'Please upload a template picture.',
            'template_picture.image' => 'The uploaded file must be an image.',
            'template_picture.mimes' => 'The image must be a PNG, JPEG, or JPG file.',
            'template_picture.dimensions' => 'The image dimensions must not exceed 4500x3939 pixels.',
        ];
    }
}
