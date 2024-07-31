<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class detailBiayaAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate = Carbon::now();
        $biayaAdmin = [
            [
                'biaya_admin' => '10000',
                'tanggal_awal_berlaku' => $currentDate->format('Y-m-d'),
                'tanggal_akhir_berlaku' => null, // biarkan null jika tidak ada akhir berlaku
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
        ];

        DB::table('detail_biaya_admins')->insert($biayaAdmin);
    }
}
