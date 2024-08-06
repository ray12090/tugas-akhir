<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\detailKewarganegaraan;
use App\Models\detailAgama;
use App\Models\detailPerkawinan;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Village;

class Pemilik extends Model
{
    protected $fillable = [
        'nama_pemilik',
        'no_hp',
        'tempat_lahir_id',
        'tanggal_lahir',
        'warga_negara_id',
        'user_id',
        'nik',
        'agama_id',
        'perkawinan_id',
        'alamat',
        'jenis_kelamin',
        'alamat_village_id',
        'alamat_kecamatan_id',
        'alamat_kabupaten_id',
        'alamat_provinsi_id'
    ];

    public function unit()
    {
        return $this->belongsToMany(Unit::class, 'pemilik_units', 'pemilik_id', 'unit_id')
            ->withPivot('awal_huni', 'akhir_huni');
    }
    public function Komplain()
    {
        return $this->hasMany(Komplain::class);
    }
    public function ipl()
    {
        return $this->hasMany(Ipl::class);
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
    public function detailTempatLahir()
    {
        return $this->belongsTo(City::class, 'tempat_lahir_id');
    }
    public function detailAlamatVillages()
    {
        return $this->belongsTo(Village::class, 'alamat_village_id');
    }
    public function detailAlamatKecamatan()
    {
        return $this->belongsTo(District::class, 'alamat_kecamatan_id');
    }
    public function detailAlamatKabupaten()
    {
        return $this->belongsTo(City::class, 'alamat_kabupaten_id');
    }
    public function detailAlamatProvinsi()
    {
        return $this->belongsTo(Province::class, 'alamat_provinsi_id');
    }
}
