<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriPenanganan extends Model
{
    use HasFactory;
    protected $fillable = ['nama_kategori_penanganan'];

    public function Penanganan()
    {
        return $this->belongsToMany(Penanganan::class);
    }

}
