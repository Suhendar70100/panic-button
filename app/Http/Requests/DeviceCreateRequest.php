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
            'code_device' => ['required'],
            'id_residential_block'=> ['required'],
            'owner_device' => ['required'],
            'house_number'=> ['required'],
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
            'code_device.required' => 'Kode Harus diisi',
            'id_residential_block.required' => 'Kode Blok Perumahan Harus diisi',
            'house_number.required' => 'Nomor Perumahan Harus diisi',
            'owner_device.required' => 'Nama Pemilik Harus memiliki :min karakter',
            'house_number.min' => 'Nomor Perumahan Harus memiliki :min karakter',
            'access.required' => 'Akses Harus diisi',
            // 'name_block.required' => 'Nama Blok Perumahan Harus diisi',
            // 'name_block.min' => 'Nama Blok Perumahan minimal harus memiliki :min karakter',
        ];
    }
}
