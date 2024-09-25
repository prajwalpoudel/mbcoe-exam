<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'name' => 'required',
            'site_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'logo' => 'nullable'
        ];
    }
    public function messages()
    {
        return [
            'site_name.required' => 'The website name is required'
        ];
    }
}