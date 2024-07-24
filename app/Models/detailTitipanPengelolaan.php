<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailTitipanPengelolaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'jumlah',
    ];

    public function Ipl()
    {
        return $this->hasOne(Ipl::class, 'titipan_pengelolaan_id');
    }
}
