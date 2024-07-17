<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailBiayaAir extends Model
{
    use HasFactory;
    protected $fillable = [
        'biaya_air',
    ];

    public function detailTagihanAir()
    {
        return $this->hasMany(detailTagihanAir::class);
    }
}
