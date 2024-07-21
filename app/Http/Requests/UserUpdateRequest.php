<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'username' => ['required', 'min:3'],
            'password' => ['required', 'min:6'],
            'access' => ['required'],
            'role' => ['required'],
            'id_residential' => ['nullable'],
        ];
    }

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
