<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailAgama extends Model
{
    use HasFactory;
    protected $fillable = [
        'agama',
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
