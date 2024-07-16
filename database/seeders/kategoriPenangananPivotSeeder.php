<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penanganan;
use App\Models\kategoriPenanganan;

class kategoriPenangananPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penanganans = Penanganan::all();
        $kategoriPenanganans = kategoriPenanganan::all();

        foreach ($penanganans as $penanganan) {
            $randomkategoriPenanganans = $kategoriPenanganans->random(rand(1, 3))->pluck('id')->toArray();

            $penanganan->kategoriPenanganan()->sync($randomkategoriPenanganans);
        }
    }
}
