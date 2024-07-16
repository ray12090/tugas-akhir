<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lantai extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'tower_id', 'lantai'];

    public function tower()
    {
        return $this->belongsTo(Tower::class, 'tower_id', 'id');
    }

    public function unit()
    {
        return $this->hasMany(Unit::class);
    }
}
