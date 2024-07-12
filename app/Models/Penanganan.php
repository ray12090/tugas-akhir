<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penanganan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_penanganan', 'komplain_id', 'respon_awal', 'pemeriksaan_awal', 'penyelesaian_komplain',
        'foto_pemeriksaan_awal', 'foto_hasil_perbaikan', 'persetujuan_selesai_tr', 'persetujuan_selesai_pelaksana', 'tanggal_penanganan', 'created_by', 'updated_by'
    ];

    protected $dates = ['tanggal_penanganan'];

    public function kategoriPenanganan()
    {
        return $this->belongsToMany(KategoriPenanganan::class, 'kategori_penanganan_pivot');
    }

    public function komplain()
    {
        return $this->belongsTo(Komplain::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'penanganan_user_pivot');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
