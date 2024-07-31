<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailBiayaAdmin extends Model
{
    use HasFactory;
    protected $fillable = [
        'biaya_admin','tanggal_awal_berlaku', 'tanggal_akhir_berlaku'
    ];
    public function Ipl()
    {
        return $this->hasMany(Ipl::class);
    }
}
