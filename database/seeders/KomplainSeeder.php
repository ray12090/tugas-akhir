<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Komplain;
use App\Models\Unit;
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
        // You might want to truncate the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('komplains')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $dummyCategories = [
            'Engineering', 'Plumbing', 'Marmer', 'Parquet',
            'Sloping', 'Safety', 'Rembes', 'Sipl Lainnya',
            'Listrik', 'AC + Exhaust', 'TR', 'Mekanik',
            'Access Card/Parkir', 'Supervisi', 'Pest Control'
        ];

        // Get all unit IDs from the units table
        $unitIds = Unit::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            Komplain::create([
                'nomor_laporan' => 'KOMP-' . Str::random(5),
                'tanggal_laporan' => now()->subDays(rand(1, 30)),
                'unit_id' => $unitIds[array_rand($unitIds)], // Randomly select an existing unit ID
                'kategori_laporan' => 'Keluhan',
                'nama_pelapor' => 'Pelapor ' . ($i + 1),
                'nomor_kontak' => '0812345678' . $i,
                'uraian_komplain' => 'This is a dummy complaint description for complaint ' . ($i + 1),
                'kategori' => json_encode(array_rand(array_flip($dummyCategories), rand(1, 3))),
                'respon' => null,
                'analisis_awal' => null,
                'keterangan_selesai' => null,
                'foto_analisis_awal' => null,
                'foto_hasil_perbaikan' => null,
            ]);
        }
    }
}
