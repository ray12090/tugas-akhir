<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailBiayaAir extends Model
{
    use HasFactory;
    protected $fillable = [
        'biaya_air',
        'tanggal_awal_berlaku',
        'tanggal_akhir_berlaku'
    ];

    public function detailTagihanAir()
    {
        return $this->hasMany(detailTagihanAir::class);
    }

}
