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
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            'alamat' => ['nullable', 'string', 'max:255'],

            'no_telepon' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('users', 'no_telepon')->ignore($this->user()->id),
            ],

            'nik' => [
                'nullable',
                'string',
                Rule::unique('users', 'nik')->ignore($this->user()->id),
            ],
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan oleh pengguna lain.',

            'no_telepon.max' => 'Nomor telepon maksimal 20 karakter.',
            'no_telepon.unique' => 'Nomor telepon ini sudah digunakan oleh pengguna lain.',

            'nik.unique' => 'NIK ini sudah terdaftar.',
        ];
    }
}
