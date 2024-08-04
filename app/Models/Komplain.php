<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Komplain extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_laporan', 'tanggal_laporan', 'unit_id', 'jenis_komplain_id', 'status_komplain_id',
        'nama_pelapor', 'no_hp', 'uraian_komplain', 'foto_komplain', 'pelapor_id'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function idPelapor()
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }

    public function jenisKomplain()
    {
        return $this->belongsTo(JenisKomplain::class);
    }

    public function lokasiKomplains()
    {
        return $this->belongsToMany(LokasiKomplain::class, 'komplain_lokasi_pivot', 'komplain_id', 'lokasi_komplain_id')
            ->withPivot('uraian_komplain', 'foto_komplain');
    }
    public function statusKomplain()
    {
        return $this->belongsTo(StatusKomplain::class, 'status_komplain_id');
    }

    public function penanganan()
    {
        return $this->hasMany(Penanganan::class, 'komplain_id');
    }
    public static function generateNomorLaporan()
    {
        $lastKomplain = DB::table('komplains')->latest('id')->first();
        $today = now()->format('Y/m/d');
        $number = 1;

        if ($lastKomplain) {
            $lastNomor = $lastKomplain->nomor_laporan;
            $lastNumber = (int) substr($lastNomor, -6);
            $number = $lastNumber + 1;
        }

        return 'KOMP/' . now()->format('Ymd') . '/' . str_pad($number, 6, '0', STR_PAD_LEFT);
    }
}
