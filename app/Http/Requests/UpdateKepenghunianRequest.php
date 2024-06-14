<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKepenghunianRequest extends FormRequest
{
    public function authorize()
    {
        // Ensure authorization is granted
        return true; 
    }

    public function rules()
    {
        return [
            'unit_id' => 'required|string',
            'tanggal_huni' => 'required|date',
            'status' => 'required|string',
            'nama' => 'required|string',
            'no_hp' => 'required|numeric|digits_between:10,15',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'warga_negara' => 'required|string',
            'no_ktp' => 'required|numeric|digits:16',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'awal_sewa' => 'nullable|date',
            'akhir_sewa' => 'nullable|date',
        ];
    }
}