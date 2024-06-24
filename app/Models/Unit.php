<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = ['tower', 'lantai', 'unit'];

    public function kepenghunians()
    {
        return $this->hasMany(Kepenghunian::class, 'unit_id');
    }

    public function komplains()
    {
        return $this->hasMany(Komplain::class, 'unit_id');
    }

    public function pemilik()
    {
        return $this->hasOne(Kepenghunian::class, 'unit_id')
                    ->where('status', 'pemilik');
    }

    public function penyewas()
    {
        return $this->hasMany(Kepenghunian::class, 'unit_id')
                    ->where('status', 'penyewa');
    }
}
