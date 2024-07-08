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
        DB::table('status_komplain')->insert([
            ['status_komplain' => 'Belum Diproses'],
            ['status_komplain' => 'Sedang Diproses'],
            ['status_komplain' => 'Selesai'],
            ['status_komplain' => 'Ditolak'],
        ]);
    }
}
