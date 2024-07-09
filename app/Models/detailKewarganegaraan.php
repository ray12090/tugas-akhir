<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailKewarganegaraan extends Model
{
    protected $fillable = [
        'status_kewarganegaraan'
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
