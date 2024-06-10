<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepenghunian extends Model
{
    use HasFactory;
    protected $fillable = ['unit_id', 'tanggal_huni', 'status', 'nama', 'no_hp', 'tanggal_lahir', 'warna_negara', 'no_ktp', 'agama', 'alamat', 'awal_sewa', 'akhir_sewa'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
