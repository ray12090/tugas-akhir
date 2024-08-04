<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Village;

class Penyewa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik',
        'unit_id',
        'warga_negara_id',
        'agama_id',
        'perkawinan_id',
        'user_id',
        'nama_penyewa',
        'no_hp',
        'tempat_lahir_id',
        'tanggal_lahir',
        'alamat',
        'awal_sewa',
        'akhir_sewa',
        'jenis_kelamin',
        'alamat_village_id',
        'alamat_kecamatan_id',
        'alamat_kabupaten_id',
        'alamat_provinsi_id'
    ];

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
    public function approvalRequestPenyewa()
    {
        return $this->hasMany(approvalRequestPenyewa::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Komplain()
    {
        return $this->hasMany(Komplain::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
    public function detailTempatLahir()
    {
        return $this->belongsTo(City::class, 'tempat_lahir_id');
    }
    public function detailAlamatVillage()
    {
        return $this->belongsTo(Village::class, 'alamat_village_id', 'id');
    }
    public function detailAlamatKecamatan()
    {
        return $this->belongsTo(District::class, 'alamat_kecamatan_id', 'id');
    }
    public function detailAlamatKabupaten()
    {
        return $this->belongsTo(City::class, 'alamat_kabupaten_id', 'id');
    }
    public function detailAlamatProvinsi()
    {
        return $this->belongsTo(Province::class, 'alamat_provinsi_id', 'id');
    }
}
