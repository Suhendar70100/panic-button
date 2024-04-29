<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResidentialCreateRequest extends FormRequest
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
            'name' => ['required', 'min:3'],
            'address' => ['required', 'min:3'],
        ];
    }

    /**
     * Get the validation messages for the rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama Perumahan Harus diisi',
            'name.min' => 'Nama Perumahan minimal harus memiliki :min karakter',
            'address.required' => 'Alamat Perumahan Harus diisi',
            'address.min' => 'Alamat Perumahan minimal harus memiliki :min karakter',
        ];
    }
}