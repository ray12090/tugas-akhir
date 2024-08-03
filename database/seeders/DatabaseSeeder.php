<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Vermaysha\Wilayah\Seeds\CitySeeder;
use Vermaysha\Wilayah\Seeds\DistrictSeeder;
use Vermaysha\Wilayah\Seeds\ProvinceSeeder;
use Vermaysha\Wilayah\Seeds\VillageSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(VillageSeeder::class);
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
            JenisKomplainSeeder::class,
            LokasiKomplainSeeder::class,
            StatusKomplainSeeder::class,
            // KomplainSeeder::class,
            // komplainLokasiPivotSeeder::class,
            KategoriPenangananSeeder::class,
            // PenangananSeeder::class,
            // penangananUserPivotSeeder::class,
            // kategoriPenangananPivotSeeder::class,
            detailJenisTagihanSeeder::class,
        ]);
    }
}
