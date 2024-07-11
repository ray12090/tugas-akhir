<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    use HasFactory;
    protected $fillable = ['nik', 'unit_id', 'warga_negara_id', 'agama_id', 'perkawinan_id', 'nama_penyewa', 'no_hp', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'awal_sewa', 'akhir_sewa', 'akhir_sewa', 'akhir_sewa'];

    public function detailKewarganegaraan()
    {
        return $this->belongsTo(detailKewarganegaraan::class);
    }

    public function detailAgama()
    {
        return $this->belongsTo(detailAgama::class);
    }

    public function detailPerkawinan()
    {
        return $this->belongsTo(detailPerkawinan::class);
    }
}
