<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKepenghunianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        // Implement your authorization logic here.
        // For now, return true to allow any authenticated user to make this request.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'unit_id' => 'required|string',
            'tanggal_huni' => 'required|date',
            'status' => 'required|string',
            'nama' => 'required|string',
            'no_hp' => 'required|numeric',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'warga_negara' => 'required|string',
            'no_ktp' => 'required|numeric|digits:16', // Ensure it's 16 digits
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'awal_sewa' => 'nullable|date', // Make these nullable if not always required
            'akhir_sewa' => 'nullable|date',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages()
    {
        return [
            'unit_id.required' => 'Unit ID wajib diisi.',
            'tanggal_huni.required' => 'Tanggal huni wajib diisi.',
            'status.required' => 'Status wajib diisi.',
            'nama.required' => 'Nama penghuni wajib diisi.',
            'no_hp.required' => 'No HP wajib diisi.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'warga_negara.required' => 'Warga negara wajib diisi.',
            'no_ktp.required' => 'No KTP wajib diisi.',
            'no_ktp.digits' => 'No KTP harus 16 digit.',
            'agama.required' => 'Agama wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ];
    }
}
