<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCsv_FileRequest extends FormRequest
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
            // 'csv_file' => 'required|file|mimes:csv',
            'csv_name' => 'required|string',
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
            // 'csv_file.required' => 'Please upload a CSV file.',
            // 'csv_file.file' => 'The uploaded file must be a file.',
            // 'csv_file.mimes' => 'The file must be a CSV file.',
            'csv_name.required' => 'Please provide a name for the CSV file.',
            'csv_name.string' => 'The name must be a string.',
        ];
    }
}
