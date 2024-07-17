<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = ['lantai_id', 'nama_unit'];

    public function lantai()
    {
        return $this->belongsTo(Lantai::class, 'lantai_id', 'id');
    }
    public function kepemilikan()
    {
        return $this->hasMany(Kepemilikan::class, 'unit_id');
    }

    public function komplain()
    {
        return $this->hasMany(Komplain::class, 'unit_id');
    }

    public function detailTagihanAir()
    {
        return $this->hasMany(detailTagihanAir::class, 'unit_id');
    }
    public function Ipl()
    {
        return $this->hasMany(detailTagihanAir::class);
    }
}
