<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriKomplain extends Model
{
    protected $fillable = ['nama_kategori'];

    public function penangananKomplains()
    {
        return $this->belongsToMany(PenangananKomplain::class, 'penanganan_komplain_kategori');
    }
}
