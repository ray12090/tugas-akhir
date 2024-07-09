<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BagianKomplainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bagian_komplains')->insert([
            ['bagian_komplain' => 'Kamar Tidur'],
            ['bagian_komplain' => 'Kamar Mandi'],
            ['bagian_komplain' => 'Ruang Tamu'],
            ['bagian_komplain' => 'Dapur'],
            ['bagian_komplain' => 'Teras'],
            ['bagian_komplain' => 'Lainnya'],
        ]);
    }
}
