<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class detailKewarganegaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status_kewarganegaraan = [
            ['status_kewarganegaraan' => 'WNI'],
            ['status_kewarganegaraan' => 'WNA'],
        ];

        DB::table('detail_kewarganegaraans')->insert($status_kewarganegaraan);
    }
}
