<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Komplain;
use App\Models\LokasiKomplain;
use Illuminate\Support\Facades\DB;

class komplainLokasiPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $komplains = Komplain::all();
        $lokasiKomplains = LokasiKomplain::all();

        foreach ($komplains as $komplain) {
            $randomLokasiKomplains = $lokasiKomplains->random(rand(1, 3));

            foreach ($randomLokasiKomplains as $lokasiKomplain) {
                DB::table('komplain_lokasi_pivot')->insert([
                    'komplain_id' => $komplain->id,
                    'lokasi_komplain_id' => $lokasiKomplain->id,
                    'uraian_komplain' => 'Uraian komplain untuk lokasi ' . $lokasiKomplain->nama_lokasi_komplain,
                ]);
            }
        }
    }
}
