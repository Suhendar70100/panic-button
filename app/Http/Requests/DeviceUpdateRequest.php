<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceUpdateRequest extends FormRequest
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
            'guid' => ['required'],
            'code_block_residential'=> ['required'],
            'house_number'=> ['required'],
            'status'=> ['required'],
            'access' => ['required'],
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
            // 'code_block_resindential' => 'Kode Blok Perumahan Harus diisi',
            // 'code_block_resindential' => 'Kode Blok Perumahan minimal harus memiliki :min karakter',
            // 'house_number.required' => 'Nama Blok Perumahan Harus diisi',
            // 'house_number.min' => 'Nama Blok Perumahan minimal harus memiliki :min karakter',
        ];
    }
}
