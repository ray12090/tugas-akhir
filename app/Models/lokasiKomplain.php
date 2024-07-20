<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lokasiKomplain extends Model
{
    use HasFactory;
    protected $fillable = ['nama_bagian'];

    public function komplains()
{
    return $this->belongsToMany(Komplain::class, 'komplain_lokasi_pivot')
                ->withPivot('uraian_komplain', 'foto_komplain');
}

}
