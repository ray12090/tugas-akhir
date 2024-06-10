<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $towers = ['A', 'B'];
        $units = [];

        foreach ($towers as $tower) {
            for ($i = 1; $i <= 3; $i++) {
                $floor = str_pad($i, 2, '0', STR_PAD_LEFT);
                $units[] = [
                    'tower' => $tower,
                    'lantai' => $floor,
                    'unit' => $floor . $floor,
                ];
            }
        }

        DB::table('units')->insert($units);
    }
}
