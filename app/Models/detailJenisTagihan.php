<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailJenisTagihan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_jenis_tagihan',

    ];
    public function ipl()
    {
        return $this->belongsToMany(Ipl::class, 'ipl_jenis_tagihans_pivot', 'jenis_tagihan_id', 'ipl_id')
            ->withPivot('jumlah');
    }
}
