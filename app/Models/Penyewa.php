<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    use HasFactory;
    protected $fillable = ['nik', 'unit_id', 'warga_negara_id', 'agama_id', 'perkawinan_id', 'user_id', 'nama_penyewa', 'no_hp', 'tempat_lahir_id', 'tanggal_lahir', 'alamat', 'awal_sewa', 'akhir_sewa'];

    public function detailKewarganegaraan()
    {
        return $this->belongsTo(detailKewarganegaraan::class, 'warga_negara_id', 'id');
    }

    public function detailAgama()
    {
        return $this->belongsTo(detailAgama::class, 'agama_id', 'id');
    }

    public function detailPerkawinan()
    {
        return $this->belongsTo(detailPerkawinan::class, 'perkawinan_id', 'id');
    }

    public function detailTempatLahir()
    {
        return $this->belongsTo(detailTempatLahir::class, 'tempat_lahir_id', 'id');
    }
    public function approvalRequestPenyewa()
    {
        return $this->hasMany(approvalRequestPenyewa::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
