<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penyewa;
use App\Models\DetailKewarganegaraan;
use App\Models\DetailAgama;
use App\Models\DetailPerkawinan;
use Faker\Factory as Faker;

class PenyewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $kewarganegaraans = DetailKewarganegaraan::all();
        $agamas = DetailAgama::all();
        $perkawinans = DetailPerkawinan::all();

        for ($i = 0; $i < 400; $i++) {
            Penyewa::create([
                'nama_penyewa' => $faker->name,
                'no_hp' => $faker->phoneNumber,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date(),
                'warga_negara_id' => $kewarganegaraans->random()->id,
                'nik' => $faker->unique()->numerify('################'),
                'agama_id' => $agamas->random()->id,
                'perkawinan_id' => $perkawinans->random()->id,
                'alamat' => $faker->address,
            ]);
        }
    }
}
