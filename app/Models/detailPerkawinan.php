<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailPerkawinan extends Model
{
    protected $fillable = [
        'status_perkawinan'
    ];

    public function pemilik()
    {
        return $this->hasMany(Pemilik::class);
    }
    public function penyewa()
    {
        return $this->hasMany(Pemilik::class);
    }
}
