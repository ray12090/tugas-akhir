<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailTitipanPengelolaan;
use App\Models\Ipl;

class detailTitipanPengelolaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ipls = Ipl::all();

        foreach ($ipls as $ipl) {
            DetailTitipanPengelolaan::create([
                'ipl_id' => $ipl->id,
                'jumlah' => rand(10000, 50000),
            ]);
        }
    }
}