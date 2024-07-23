<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailTitipanPengelolaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'ipl_id',
        'jumlah',
    ];

    public function Ipl()
    {
        return $this->belongsTo(Ipl::class, 'ipl_id');
    }
}
