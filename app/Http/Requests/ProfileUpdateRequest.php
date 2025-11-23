<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
   public function rules(): array
{
    return [
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'email',
            Rule::unique('users', 'email')->ignore($this->user()->id),
        ],
        'nik' => [
            'nullable',
            'digits:16',
            Rule::unique('users', 'nik')->ignore($this->user()->id),
        ],
        'no_telepon' => [
            'nullable',
            'digits_between:10,16',
            Rule::unique('users', 'no_telepon')->ignore($this->user()->id),
        ],
        'alamat' => ['nullable', 'string'],
    ];
}

public function messages()
{
    return [
        'nik.digits' => 'NIK harus 16 digit.',
        'nik.unique' => 'NIK sudah digunakan.',
        'no_telepon.digits_between' => 'Nomor telepon harus 10–16 digit.',
        'no_telepon.unique' => 'Nomor telepon sudah digunakan.',
    ];
}
}
