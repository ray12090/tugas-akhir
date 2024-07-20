<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Komplain;
use App\Models\Unit;
use App\Models\JenisKomplain;
use App\Models\LokasiKomplain;
use App\Models\statusKomplain;
use Illuminate\Support\Str;


class KomplainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = Unit::all();
        $jenisKomplains = JenisKomplain::all();
        $lokasiKomplains = LokasiKomplain::all();
        $statusKomplains = StatusKomplain::all();

        for ($i = 0; $i < 10; $i++) {
            $unit = $units->random();
            $jenisKomplain = $jenisKomplains->random();
            $statusKomplain = $statusKomplains->random();

            $nomor_laporan = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $komplain = Komplain::create([
                'nomor_laporan' => $nomor_laporan,
                'tanggal_laporan' => now()->subDays(rand(0, 30)),
                'unit_id' => $unit->id,
                'jenis_komplain_id' => $jenisKomplain->id,
                'status_komplain_id' => $statusKomplain->id,
                'nama_pelapor' => 'Pelapor ' . ($i + 1),
                'no_hp' => '08123456789' . rand(0, 9),
            ]);

            $randomLokasiKomplains = $lokasiKomplains->random(rand(1, 3))->pluck('id')->toArray();

            $komplain->lokasiKomplains()->sync($randomLokasiKomplains);
        }
    }
}
