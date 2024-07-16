<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\detailKewarganegaraan;
use App\Models\detailAgama;
use App\Models\detailPerkawinan;

class Pemilik extends Model
{
    protected $fillable = ['nama_pemilik', 'no_hp', 'tempat_lahir', 'tanggal_lahir', 'warga_negara_id', 'nik', 'agama_id', 'perkawinan_id', 'alamat'];

    public function unit()
    {
        return $this->belongsToMany(Unit::class, 'pemilik_units', 'pemilik_id', 'unit_id');
    }
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
