<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tower;

class TowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('towers')->insert([
            [
                'nama_tower' => 'A'
            ],
            [
                'nama_tower' => 'B'
            ]
        ]);
    }
}
