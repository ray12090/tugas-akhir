<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Komplain;
use App\Models\BagianKomplain;

class komplainBagianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $komplains = Komplain::all();
        $bagianKomplains = BagianKomplain::all();

        foreach ($komplains as $komplain) {
            $randomBagianKomplains = $bagianKomplains->random(rand(1, 3))->pluck('id')->toArray();

            $komplain->bagianKomplains()->sync($randomBagianKomplains);
        }
    }
}
