<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KepenghunianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unitIds = DB::table('units')->pluck('id')->toArray();
        $statuses = [0, 1];
        $names = ['John Doe', 'Jane Smith', 'Alice Johnson', 'Bob Brown'];
        $countries = [1, 2];
        $religions = [1, 2, 3, 4, 5, 6, 7];
        $startDate = '2023-01-01';
        $endDate = '2024-01-01';

        $kepenghunians = [];

        foreach ($unitIds as $unitId) {
            foreach ($names as $name) {
                $kepenghunians[] = [
                    'unit_id' => $unitId,
                    'tanggal_huni' => now()->subDays(rand(1, 365)),
                    'status' => $statuses[array_rand($statuses)],
                    'nama' => $name,
                    'no_hp' => '08123456789' . rand(0, 9),
                    'tanggal_lahir' => now()->subYears(rand(20, 60))->subDays(rand(1, 365)),
                    'warna_negara' => $countries[array_rand($countries)],
                    'no_ktp' => '1234567890123456' . rand(0, 9),
                    'agama' => $religions[array_rand($religions)],
                    'alamat' => 'Jl. Contoh Alamat No. ' . rand(1, 100),
                    'awal_sewa' => $startDate,
                    'akhir_sewa' => $endDate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('kepenghunians')->insert($kepenghunians);
    }
}
