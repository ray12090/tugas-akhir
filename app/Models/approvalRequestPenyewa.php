<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class approvalRequestPenyewa extends Model
{
    use HasFactory;
    protected $fillable = [
        'penyewa_id',
        'status',
        'approved_by',
    ];

    public function Penyewa()
    {
        return $this->belongsTo(Penyewa::class);
    }
}
