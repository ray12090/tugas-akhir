<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penangananKomplain extends Model
{
    protected $fillable = ['respon', 'analisis_awal', 'keterangan_selesai', 'foto_analisis_awal', 'foto_hasil_perbaikan'];

    public function kategoriKomplain()
    {
        return $this->belongsToMany(KategoriKomplain::class, 'penanganan_komplain_kategori');
    }
}
