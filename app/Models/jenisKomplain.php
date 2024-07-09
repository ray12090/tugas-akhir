<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisKomplain extends Model
{
    protected $fillable = ['jenis_komplain'];

    public function komplain()
    {
        return $this->hasMany(Komplain::class);
    }
}
