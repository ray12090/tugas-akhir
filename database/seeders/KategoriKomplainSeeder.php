<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriKomplainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_komplains')->insert([
            ['kategori_komplain' => 'Air'],
            ['kategori_komplain' => 'Kebersihan'],
            ['kategori_komplain' => 'Keamanan'],
            ['kategori_komplain' => 'Fasilitas'],
        ]);
    }
}
