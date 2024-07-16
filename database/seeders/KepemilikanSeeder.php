<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KepemilikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unitIds = DB::table('units')->pluck('id')->toArray();
        $statuses = ['Pemilik', 'Penyewa'];
        $names = ['John Doe', 'Jane Smith', 'Alice Johnson', 'Bob Brown'];
        $countries = ['WNI', 'WNA'];
        $religions = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu', 'Lainnya'];
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
                    'tempat_lahir' => 'Bogor',
                    'tanggal_lahir' => now()->subYears(rand(20, 60))->subDays(rand(1, 365)),
                    'warga_negara' => $countries[array_rand($countries)],
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
