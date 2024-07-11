<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Komplain;
use App\Models\LokasiKomplain;

class komplainLokasiPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $komplains = Komplain::all();
        $lokasiKomplains = LokasiKomplain::all();

        foreach ($komplains as $komplain) {
            $randomLokasiKomplains = $lokasiKomplains->random(rand(1, 3))->pluck('id')->toArray();

            $komplain->lokasiKomplains()->sync($randomLokasiKomplains);
        }
    }
}
