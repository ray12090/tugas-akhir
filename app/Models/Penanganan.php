<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penanganan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_penanganan', 'komplain_id', 'respon_awal', 'pemeriksaan_awal', 'penyelesaian_komplain',
        'foto_pemeriksaan_awal', 'foto_hasil_perbaikan', 'persetujuan_selesai_tr', 'persetujuan_selesai_pelaksana', 'tanggal_penanganan', 'created_by', 'updated_by'
    ];

    protected $dates = ['tanggal_penanganan'];
    protected $casts = [
        'tanggal_penanganan' => 'datetime',
        'persetujuan_selesai_tr' => 'boolean',
        'persetujuan_selesai_pelaksana' => 'boolean',
    ];

    public function kategoriPenanganan()
    {
        return $this->belongsToMany(KategoriPenanganan::class, 'kategori_penanganan_pivot');
    }

    public function komplain()
    {
        return $this->belongsTo(Komplain::class, 'komplain_id');
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
    public static function generateNomorPenanganan()
    {
        $lastPenanganan = DB::table('penanganans')->latest('id')->first();
        $today = now()->format('Y/m/d');
        $number = 1;

        if ($lastPenanganan) {
            $lastNomor = $lastPenanganan->nomor_penanganan;
            $lastNumber = (int) substr($lastNomor, -6);
            $number = $lastNumber + 1;
        }

        return 'HDL/' . now()->format('Ymd') . '/' . str_pad($number, 6, '0', STR_PAD_LEFT);
    }
}
