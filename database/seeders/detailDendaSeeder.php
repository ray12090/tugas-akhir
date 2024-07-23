<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailDenda;
use App\Models\Ipl;

class detailDendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ipls = Ipl::all();

        foreach ($ipls as $ipl) {
            DetailDenda::create([
                'ipl_id' => $ipl->id,
                'jumlah' => rand(0, 100),
            ]);
        }
    }
}
