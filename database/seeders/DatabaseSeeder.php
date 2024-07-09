<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            HargaAirSeeder::class,
            BiayaAdminSeeder::class,
            detailAgamaSeeder::class,
            detailPerkawinanSeeder::class,
            detailKewarganegaraanSeeder::class,
            PemilikSeeder::class,
            // PenyewaSeeder::class,
            TowerSeeder::class,
            LantaiSeeder::class,
            UnitSeeder::class,
            // KepenghunianSeeder::class,
            JenisKomplainSeeder::class,
            BagianKomplainSeeder::class,
            KomplainSeeder::class,
            komplainBagianSeeder::class,
            KategoriKomplainSeeder::class,
            StatusKomplainSeeder::class,
            PenangananKomplainSeeder::class,
            KomplainSeeder::class,
        ]);
    }
}
