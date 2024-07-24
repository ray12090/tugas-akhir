<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailDanaCadangan extends Model
{
    use HasFactory;
    protected $fillable = [
        'jumlah',
    ];

    public function Ipl()
    {
        return $this->hasOne(Ipl::class, 'dana_cadangan_id');
    }
}
