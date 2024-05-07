<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResidentialBlockUpdateRequest extends FormRequest
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
            'code_block' => ['required', 'min:3'],
            'id_residential' => [],
            'name_block' => ['required', 'min:3'],
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
            'code_block.required' => 'Kode Blok Perumahan Harus diisi',
            'code_block.min' => 'Kode Blok Perumahan minimal harus memiliki :min karakter',
            'name_block.required' => 'Nama Blok Perumahan Harus diisi',
            'name_block.min' => 'Nama Blok Perumahan minimal harus memiliki :min karakter',
        ];
    }
}