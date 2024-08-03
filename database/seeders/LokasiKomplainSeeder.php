<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiKomplainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lokasi_komplains')->insert([
            ['nama_lokasi_komplain' => 'Balkon'],
            ['nama_lokasi_komplain' => 'Dapur'],
            ['nama_lokasi_komplain' => 'Kamar Tidur'],
            ['nama_lokasi_komplain' => 'Kamar Mandi'],
            ['nama_lokasi_komplain' => 'Ruang Tamu'],
        ]);
    }
}
