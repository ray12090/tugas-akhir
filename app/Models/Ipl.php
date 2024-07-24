<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ipl extends Model
{
    use HasFactory;
    protected $fillable = [
        'unit_id', 
        'pemilik_id',
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
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'pemilik_id');
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
        return $this->belongsTo(detailTagihanAwal::class,'tagihan_awal_id')->withTrashed();
    }
    public function detailTitipanPengelolaan()
    {
        return $this->belongsTo(detailTitipanPengelolaan::class, 'titipan_pengelolaan_id')->withTrashed();
    }
    public function detailIuranPengelolaan()
    {
        return $this->belongsTo(detailIuranPengelolaan::class,'iuran_pengelolaan_id')->withTrashed();
    }
    public function detailTitipanAir()
    {
        return $this->belongsTo(detailTitipanAir::class,'titipan_air_id')->withTrashed();
    }
    public function detailDanaCadangan()
    {
        return $this->belongsTo(detailDanaCadangan::class,'dana_cadangan_id')->withTrashed();
    }
    public function detailDenda()
    {
        return $this->belongsTo(detailDenda::class,'denda_id')->withTrashed();
    }
}
