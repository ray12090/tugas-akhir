<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the table
        Unit::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create 10 dummy units
        for ($i = 1; $i <= 10; $i++) {
            $tower = chr(64 + $i);
            $lantai = rand(1, 20);
            $nomor_unit = $i;

            Unit::create([
                'tower' => $tower,
                'lantai' => sprintf('%02d', $lantai),
                'unit' => $tower . '-' . sprintf('%02d', $lantai) . sprintf('%02d', $nomor_unit),
            ]);
        }
    }
}
