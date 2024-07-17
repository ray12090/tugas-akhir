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
        'tagihan_awal',
        'titipan_pengelolaan',
        'titipan_air',
        'iuran_pengelolaan',
        'dana_cadangan',
        'tagihan_air_id',
        'denda',
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
        return $this->belongsTo(detailTagihanAir::class);
    }
    public function detailBiayaAdmin()
    {
        return $this->belongsTo(detailBiayaAdmin::class);
    }
}
