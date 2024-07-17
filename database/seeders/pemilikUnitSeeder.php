<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pemilik;
use App\Models\Unit;
use Faker\Factory as Faker;

class PemilikUnitSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $pemiliks = Pemilik::all();
        $units = Unit::all();

        foreach ($pemiliks as $pemilik) {
            $randomUnits = $units->random(rand(1, 3));
            $syncData = [];

            foreach ($randomUnits as $unit) {
                $awal_huni = $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d');
                $akhir_huni = $faker->dateTimeBetween($awal_huni, '+2 years')->format('Y-m-d');

                $syncData[$unit->id] = [
                    'awal_huni' => $awal_huni,
                    'akhir_huni' => $akhir_huni,
                ];
            }

            $pemilik->unit()->sync($syncData);
        }
    }
}
