<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lokasiKomplain extends Model
{
    use HasFactory;
    protected $fillable = ['nama_lokasi_komplain'];

    public function komplains()
    {
        return $this->belongsToMany(Komplain::class, 'komplain_lokasi_pivot')
            ->withPivot('uraian_komplain', 'foto_komplain');
    }
    public function penanganans()
    {
        return $this->hasMany(Penanganan::class);
    }
}
