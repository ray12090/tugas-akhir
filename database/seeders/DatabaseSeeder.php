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
            tipeUserSeeder::class,
            detailBiayaAirSeeder::class,
            detailBiayaAdminSeeder::class,
            detailTempatLahir::class,
            detailAgamaSeeder::class,
            detailPerkawinanSeeder::class,
            detailKewarganegaraanSeeder::class,
            TowerSeeder::class,
            LantaiSeeder::class,
            UnitSeeder::class,
            UserSeeder::class,
            PemilikSeeder::class,
            PenyewaSeeder::class,
            pemilikUnitSeeder::class,
            ApprovalRequestPemilikSeeder::class,
            ApprovalRequestPenyewaSeeder::class,
            detailTagihanAirSeeder::class,
            detailTagihanAwalSeeder::class,
            detailTitipanPengelolaanSeeder::class,
            detailIuranPengelolaanSeeder::class,
            detailTitipanAirSeeder::class,
            detailDanaCadanganSeeder::class,
            detailDendaSeeder::class,
            JenisKomplainSeeder::class,
            LokasiKomplainSeeder::class,
            StatusKomplainSeeder::class,
            KomplainSeeder::class,
            komplainLokasiPivotSeeder::class,
            KategoriPenangananSeeder::class,
            PenangananSeeder::class,
            penangananUserPivotSeeder::class,
            kategoriPenangananPivotSeeder::class,
        ]);
    }
}
