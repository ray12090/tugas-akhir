<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statusKomplain extends Model
{
    protected $fillable = [
        'status_komplain',
    ];

    public function komplain()
    {
        return $this->hasMany(Komplain::class);
    }
}
