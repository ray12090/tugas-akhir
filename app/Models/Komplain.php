<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komplain extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_laporan',
        'tanggal_laporan',
        'unit_id',
        'kategori_laporan',
        'nama_pelapor',
        'nomor_kontak',
        'uraian_komplain',
        'kategori',
        'respon',
        'analisis_awal',
        'keterangan_selesai',
        'foto_analisis_awal',
        'foto_hasil_perbaikan'
    ];

    protected $casts = [
        'kategori' => 'array',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
