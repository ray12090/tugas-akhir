<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Komplain;
use App\Models\Unit;
use App\Models\JenisKomplain;
use App\Models\bagianKomplain;
use app\Models\komplainBagian;
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
        $bagianKomplains = BagianKomplain::all();

        for ($i = 0; $i < 10; $i++) {
            $unit = $units->random();
            $jenisKomplain = $jenisKomplains->random();

            // Buat komplain baru
            $komplain = Komplain::create([
                'nomor_laporan' => Str::uuid(),
                'tanggal_laporan' => now()->subDays(rand(0, 30)),
                'unit_id' => $unit->id,
                'jenis_komplain_id' => $jenisKomplain->id,
                'nama_pelapor' => 'Pelapor ' . ($i + 1),
                'no_hp' => '08123456789' . rand(0, 9),
                'uraian_komplain' => 'Uraian komplain ' . ($i + 1),
            ]);

            // Pilih bagian komplain secara acak (1 hingga 3 bagian komplain)
            $randomBagianKomplains = $bagianKomplains->random(rand(1, 3))->pluck('id')->toArray();

            // Simpan relasi dengan bagian komplain
            $komplain->bagianKomplains()->sync($randomBagianKomplains);
        }
    }
}
