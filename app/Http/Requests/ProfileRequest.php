<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'namaKaryawan' => 'required|min:2',
            'email' => 'required|email|min:2',
            'password' => 'nullable|min:5',
            'no_telp' => 'nullable|regex:/^[0-9\+\s]+$/|min:5',
            'tanda_tangan' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'namaKaryawan.required' => 'Kolom nama karyawan harus diisi.',
            'namaKaryawan.min' => 'Kolom nama karyawan minimal harus memiliki :min karakter.',
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.min' => 'Kolom email minimal harus memiliki :min karakter.',
            'password.required' => 'Kolom password harus diisi.',
            'password.min' => 'Kolom password minimal harus memiliki :min karakter.',
            'no_telp.required' => 'Kolom nomor telepon harus diisi.',
            'no_telp.regex' => 'Format nomor telepon tidak valid.',
            'no_telp.min' => 'Kolom nomor telepon minimal harus memiliki :min karakter.',
            'tanda_tangan.image' => 'File tanda tangan harus berupa gambar.',
            'tanda_tangan.mimes' => 'Format file tanda tangan harus PNG, JPG, JPEG, atau WEBP (disarankan PNG transparan).',
            'tanda_tangan.max' => 'Ukuran file tanda tangan maksimal 2 MB.',
        ];
    }
}
