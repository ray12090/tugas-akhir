<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailTagihanAir extends Model
{
    use HasFactory;
    protected $fillable = [
        'meter_air_awal',
        'meter_air_akhir',
        'pemakaian_air',
        'tagihan_air',
        'biaya_air_id',
        'unit_id',
    ];

    public function detailBiayaAir()
    {
        return $this->belongsTo(detailBiayaAir::class, 'biaya_air_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function Ipl()
    {
        return $this->hasOne(Ipl::class, 'tagihan_air_id');
    }
}
