<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;
use App\Models\detailBiayaAir;
use App\Models\detailTagihanAir;


class detailTagihanAirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all units and detail_biaya_airs
        $units = Unit::all();
        $detailBiayaAirs = DetailBiayaAir::all();

        // Iterate through each unit and create a detail_tagihan_air record
        foreach ($units as $unit) {
            $detailBiayaAir = $detailBiayaAirs->random(); // Assuming random biaya_air_id for each unit
            $meter_air_awal = rand(1, 1000); // Random initial meter reading
            $meter_air_akhir = $meter_air_awal + rand(1, 100); // Random final meter reading greater than initial
            $pemakaian_air = $meter_air_akhir - $meter_air_awal; // Water usage
            $tagihan_air = $pemakaian_air * $detailBiayaAir->biaya_air; // Calculate bill amount

            DetailTagihanAir::create([
                'biaya_air_id' => $detailBiayaAir->id,
                'unit_id' => $unit->id,
                'meter_air_awal' => $meter_air_awal,
                'meter_air_akhir' => $meter_air_akhir,
                'pemakaian_air' => $pemakaian_air,
                'tagihan_air' => $tagihan_air
            ]);
        }
    }
}
