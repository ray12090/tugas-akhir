<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komplain extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_laporan', 'tanggal_laporan', 'unit_id', 'jenis_komplain_id', 'status_komplain_id',
        'nama_pelapor', 'no_hp', 'uraian_komplain', 'foto_komplain'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function jenisKomplain()
    {
        return $this->belongsTo(JenisKomplain::class);
    }

    public function lokasiKomplains()
    {
        return $this->belongsToMany(LokasiKomplain::class, 'komplain_lokasi_pivot', 'komplain_id', 'lokasi_komplain_id');
    }

    public function statusKomplain()
    {
        return $this->belongsTo(StatusKomplain::class);
    }

    public function penanganan()
    {
        return $this->hasMany(Penanganan::class, 'komplain_id');
    }

}
