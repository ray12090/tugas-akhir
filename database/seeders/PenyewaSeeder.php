<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penyewa;
use App\Models\Unit;
use App\Models\DetailKewarganegaraan;
use App\Models\DetailAgama;
use App\Models\DetailPerkawinan;
use App\Models\User;
use Faker\Factory as Faker;

class PenyewaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $units = Unit::all();
        $wargaNegaraIds = DetailKewarganegaraan::pluck('id')->toArray();
        $agamaIds = DetailAgama::pluck('id')->toArray();
        $perkawinanIds = DetailPerkawinan::pluck('id')->toArray();
        $namaUser = User::all();
        $userIds = User::where('tipe_user_id', '12')->pluck('id')->toArray();

    Penyewa::create([
        'nik' => $faker->unique()->numerify('##########'),
        'unit_id' => 1,
        'user_id' => 10,
        'warga_negara_id' => $faker->randomElement($wargaNegaraIds),
        'agama_id' => $faker->randomElement($agamaIds),
        'perkawinan_id' => $faker->randomElement($perkawinanIds),
        'nama_penyewa' => 'Penyewa 1',
        'no_hp' => $faker->phoneNumber,
        'tempat_lahir_id' => 1,
        'tanggal_lahir' => $faker->date,
        'alamat' => $faker->address,
        'awal_sewa' => $faker->dateTimeBetween('-2 years', 'now'),
        'akhir_sewa' => $faker->dateTimeBetween('now', '+2 years'),
    ]);


    }
}
