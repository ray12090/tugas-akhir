<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailTagihanAwal;
use App\Models\Ipl;

class detailTagihanAwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ipls = Ipl::all();

        foreach ($ipls as $ipl) {
            DetailTagihanAwal::create([
                'ipl_id' => $ipl->id,
                'jumlah' => rand(100000, 500000),
            ]);
        }
    }
}