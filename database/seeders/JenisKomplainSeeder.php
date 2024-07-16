<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKomplainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_komplains')->insert([
            ['nama_jenis_komplain' => 'Keluhan'],
            ['nama_jenis_komplain' => 'Permintaan'],
        ]);
    }
}
