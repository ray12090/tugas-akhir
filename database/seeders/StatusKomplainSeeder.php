<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusKomplainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status_komplains')->insert([
            ['nama_status_komplain' => 'Belum Diproses'],
            ['nama_status_komplain' => 'Sedang Diproses'],
            ['nama_status_komplain' => 'Selesai'],
            ['nama_status_komplain' => 'Ditolak'],
        ]);
    }
}
