<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'detail_tagihan_id',
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


    public function detailJenisTagihan()
    {
        return $this->belongsToMany(detailJenisTagihan::class, 'ipl_jenis_tagihan_pivot', 'ipl_id', 'jenis_tagihan_id')
            ->withPivot('jumlah');
    }


}
