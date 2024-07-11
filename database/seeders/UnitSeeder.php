<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Unit;
use App\Models\Lantai;
use App\Models\Tower;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lantais = Lantai::with('tower')->get();

        foreach ($lantais as $lantai) {
            for ($i = 1; $i <= 10; $i++) {
                $unit_number = str_pad($i, 2, '0', STR_PAD_LEFT);
                $unit_name = $lantai->tower->nama_tower . '-' . str_pad($lantai->nama_lantai, 2, '0', STR_PAD_LEFT) . $unit_number;

                Unit::create([
                    'lantai_id' => $lantai->id,
                    'nama_unit' => $unit_name,
                ]);
            }
        }
    }
}
