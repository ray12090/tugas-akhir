<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bagianKomplain extends Model
{
    use HasFactory;
    protected $fillable = ['nama_bagian'];

    public function komplains()
    {
        return $this->belongsToMany(Komplain::class,  'komplain_bagians', 'bagian_komplain_id', 'komplain_id');
    }
}
