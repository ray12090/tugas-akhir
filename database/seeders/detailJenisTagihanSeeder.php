<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class detailJenisTagihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisTagihan = [
            ['nama_jenis_tagihan' => 'Total Tagihan yang Belum Dibayarkan'],
            ['nama_jenis_tagihan' => 'Titipan Iuran Pengelolaan'],
            ['nama_jenis_tagihan' => 'Titipan Iuran Sinking Fund'],
            ['nama_jenis_tagihan' => 'Titipan Air'],
            ['nama_jenis_tagihan' => 'Iuran Pengelolaan'],
            ['nama_jenis_tagihan' => 'Dana Cadangan'],
            ['nama_jenis_tagihan' => 'Denda'],

        ];

        DB::table('detail_jenis_tagihans')->insert($jenisTagihan);
    }
}
