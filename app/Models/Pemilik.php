<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\detailKewarganegaraan;
use App\Models\detailAgama;
use App\Models\detailPerkawinan;

class Pemilik extends Model
{
    protected $fillable = ['nama_pemilik', 'no_hp', 'tempat_lahir', 'tanggal_lahir', 'warga_negara_id', 'user_id', 'nik', 'agama_id', 'perkawinan_id', 'alamat'];

    public function unit()
    {
        return $this->belongsToMany(Unit::class, 'pemilik_units', 'pemilik_id', 'unit_id');
    }
    public function detailKewarganegaraan()
    {
        return $this->belongsTo(detailKewarganegaraan::class, 'warga_negara_id');
    }

    public function detailAgama()
    {
        return $this->belongsTo(detailAgama::class, 'agama_id');
    }

    public function detailPerkawinan()
    {
        return $this->belongsTo(detailPerkawinan::class, 'perkawinan_id');
    }
    public function approvalRequestPemilik()
    {
        return $this->hasMany(approvalRequestPemilik::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
