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
            Unit::create([
                'tower' => 'Tower ' . chr(64 + $i), // A, B, C, etc.
                'lantai' => rand(1, 20), // Random floor number
                'unit' => 'Unit ' . $i,
            ]);
        }
    }
}
