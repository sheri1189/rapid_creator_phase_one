<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFontRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            // 'font_file' => 'required|file|mimes:ttf',
            'font_name' => 'required|string|unique:fonts,font_name',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // 'font_file.required' => 'Please select a font file.',
            // 'font_file.file' => 'Please select a valid file.',
            // 'font_file.mimes' => 'The file must be a .ttf or .zip file.',
            'font_name.required' => 'Please enter a name for the font.',
            'font_name.string' => 'The font name must be a string.',
            'font_name.unique' => 'This Font Has Already Been taken. Please Use Another..',
        ];
    }
}
