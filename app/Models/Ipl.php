<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ipl extends Model
{
    use HasFactory;
    protected $fillable = [
        'unit_id', 
        'tagihan_air_id',
        'biaya_admin_id',       
        'nomor_invoice',
        'bulan_ipl',
        'tanggal_invoice',
        'jatuh_tempo',
        'tagihan_awal_id',
        'titipan_pengelolaan_id',
        'titipan_air_id',
        'iuran_pengelolaan_id',
        'dana_cadangan_id',
        'denda_id',
        'total',
        'foto_bukti_pembayaran',
        'status'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function detailTagihanAir()
    {
        return $this->belongsTo(detailTagihanAir::class, 'tagihan_air_id');
    }
    
    public function detailBiayaAdmin()
    {
        return $this->belongsTo(detailBiayaAdmin::class, 'biaya_admin_id');
    }
    public function detailTagihanAwal()
    {
        return $this->hasOne(detailTagihanAwal::class,'tagihan_awal_id');
    }
    public function detailTitipanPengelolaan()
    {
        return $this->hasOne(detailTitipanPengelolaan::class, 'titipan_pengelolaan_id');
    }
    public function detailIuranPengelolaan()
    {
        return $this->hasOne(detailIuranPengelolaan::class,'iuran_pengelolaan_id');
    }
    public function detailTitipanAir()
    {
        return $this->hasOne(detailTitipanAir::class,'titipan_air_id');
    }
    public function detailDanaCadangan()
    {
        return $this->hasOne(detailDanaCadangan::class,'dana_cadangan_id');
    }
    public function detailDenda()
    {
        return $this->hasOne(detailDenda::class,'denda_id');
    }
}
