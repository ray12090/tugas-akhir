<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipeUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_tipe_user',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'tipe_user_id');
    }
}
