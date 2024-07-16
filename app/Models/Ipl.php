<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ipl extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_invoice',
        'bulan_ipl',
        'tanggal_invoice',
        'jatuh_tempo',
        'unit_id',
        'pemilik_unit_id',
        'total_tagihan_belum_dibayar',
        'titipan_pengelolaan',
        'titipan_air',
        'iuran_pengelolaan',
        'dana_cadangan',
        'meter_air_awal',
        'meter_air_akhir',
        'tarif_id',
        'pemakaian_air',
        'tagihan_air',
        'denda',
        'total',
        'foto_bukti_pembayaran',
        'status'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function pemilikUnit()
    {
        return $this->belongsTo(PemilikUnit::class);
    }
    public function tarif()
    {
        return $this->belongsTo(Tarif::class);
    }
}
