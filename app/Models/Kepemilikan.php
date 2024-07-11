<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepemilikan extends Model
{
    use HasFactory;
    protected $fillable = ['pemilik_id', 'unit_id', 'awal_huni', 'akhir_huni'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
