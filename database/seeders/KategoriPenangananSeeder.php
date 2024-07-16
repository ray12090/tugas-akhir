<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriPenangananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriPenanganan = [
            ['nama_kategori_penanganan' => 'Perbaikan'],
            ['nama_kategori_penanganan' => 'Pembersihan'],
            ['nama_kategori_penanganan' => 'Pemeliharaan'],
            ['nama_kategori_penanganan' => 'Pengawasan'],
            ['nama_kategori_penanganan' => 'Pengaduan Lanjutan'],
        ];

        DB::table('kategori_penanganans')->insert($kategoriPenanganan);
    }
}
