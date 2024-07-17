<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
    use HasFactory;
    protected $fillable = ['nama_tower'];

    public function lantai()
    {
        return $this->hasMany(Lantai::class, 'tower_id', 'id');
    }
}
