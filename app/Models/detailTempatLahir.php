<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailTempatLahir extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_kota'
    ];

    public function pemilik()
    {
        return $this->hasMany(Pemilik::class, 'tempat_lahir_id', 'id');
    }
    public function penyewa()
    {
        return $this->hasMany(Pemilik::class, 'tempat_lahir_id', 'id');
    }
}
