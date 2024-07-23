<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailDanaCadangan;
use App\Models\Ipl;

class detailDanaCadanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ipls = Ipl::all();

        foreach ($ipls as $ipl) {
            DetailDanaCadangan::create([
                'ipl_id' => $ipl->id,
                'jumlah' => rand(5000, 20000),
            ]);
        }
    }
}