<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class detailBiayaAirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $biayaAir = [
            ['biaya_air' => '10000'],
        ];

        DB::table('detail_biaya_airs')->insert($biayaAir);
    }
}
