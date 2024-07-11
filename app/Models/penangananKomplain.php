<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penanganan extends Model
{
    protected $fillable = ['respon_awal', 'analisis_awal', 'penyelesaian_komplain', 'foto_analisis_awal', 'foto_hasil_perbaikan'];

    public function kategoriPenanganan()
    {
        return $this->belongsToMany(KategoriPenanganan::class, 'kategori_penanganan_pivot');
    }

    public function Komplain()
    {
        return $this->belongsTo(Komplain::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'penanganan_user_pivot');
    }
}
