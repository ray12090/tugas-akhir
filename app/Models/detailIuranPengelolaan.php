<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailIuranPengelolaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'jumlah',
    ];

    public function Ipl()
    {
        return $this->hasOne(Ipl::class, 'iuran_pengelolaan_id');
    }
}
