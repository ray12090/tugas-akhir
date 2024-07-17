<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class detailBiayaAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $biayaAdmin = [
            ['biaya_admin' => '10000'],
        ];

        DB::table('detail_biaya_admins')->insert($biayaAdmin);
    }
}
