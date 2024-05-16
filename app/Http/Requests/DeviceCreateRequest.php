<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceCreateRequest extends FormRequest
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
            'house_number'=> ['required', 'min:3'],
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
            'guid.required' => 'Guid Harus diisi',
            'code_block_residential.required' => 'Kode Blok Perumahan Harus diisi',
            'house_number.required' => 'Nomor Perumahan Harus diisi',
            'house_number.min' => 'Nomor Perumahan Harus memiliki :min karakter',
            'status.required' => 'Status Harus diisi',
            'access.required' => 'Akses Harus diisi',
            // 'name_block.required' => 'Nama Blok Perumahan Harus diisi',
            // 'name_block.min' => 'Nama Blok Perumahan minimal harus memiliki :min karakter',
        ];
    }
}