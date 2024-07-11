<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tower;
use App\Models\Lantai;

class LantaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $towers = Tower::all();

        foreach ($towers as $tower) {
            for ($i = 1; $i <= 20; $i++) {
                Lantai::create([
                    'tower_id' => $tower->id,
                    'nama_lantai' => $i,
                ]);
            }
        }
    }
}
