<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailIuranPengelolaan;
use App\Models\Ipl;

class detailIuranPengelolaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ipls = Ipl::all();

        foreach ($ipls as $ipl) {
            DetailIuranPengelolaan::create([
                'ipl_id' => $ipl->id,
                'jumlah' => rand(5000, 20000),
            ]);
        }
    }
}