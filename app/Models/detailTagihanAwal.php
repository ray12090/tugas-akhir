<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailTagihanAwal extends Model
{
    use HasFactory;
    protected $fillable = [
        'jumlah',
    ];

    public function Ipl()
    {
        return $this->hasOne(Ipl::class, 'tagihan_awal_id');
    }
}
