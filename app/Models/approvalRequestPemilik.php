<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class approvalRequestPemilik extends Model
{
    use HasFactory;
    protected $fillable = [
        'pemilik_id',
        'status',
        'approved_by',
    ];

    public function Pemilik()
    {
        return $this->belongsTo(Pemilik::class);
    }
}
