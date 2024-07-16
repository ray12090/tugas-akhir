<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class detailPerkawinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status_perkawinan = [
            ['status_perkawinan' => 'Belum Kawin'],
            ['status_perkawinan' => 'Kawin'],
            ['status_perkawinan' => 'Cerai Hidup'],
            ['status_perkawinan' => 'Cerai Mati'],
        ];

        DB::table('detail_perkawinans')->insert($status_perkawinan);
    }
}
