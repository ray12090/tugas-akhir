<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pemilik;
use App\Models\DetailKewarganegaraan;
use App\Models\DetailAgama;
use App\Models\DetailPerkawinan;
use App\Models\User;
use Faker\Factory as Faker;

class PemilikSeeder extends Seeder
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
        $namaUser = User::all();
        $users = User::where('tipe_user_id', '11')->get();

        Pemilik::create([
            'nama_pemilik' => 'Pemilik 1',
            'no_hp' => $faker->phoneNumber,
            'tempat_lahir_id' => 1,
            'tanggal_lahir' => $faker->date(),
            'warga_negara_id' => 1,
            'user_id' => 8,
            'nik' => $faker->unique()->numerify('################'),
            'agama_id' => $agamas->random()->id,
            'perkawinan_id' => $perkawinans->random()->id,
            'alamat' => $faker->address,
            'jenis_kelamin' => 'Laki-laki',
            'alamat_village_id' => 1,
            'alamat_kecamatan_id' => 1,
            'alamat_kabupaten_id' => 1,
            'alamat_provinsi_id' => 1,
        ]);
        Pemilik::create([
            'nama_pemilik' => 'Pemilik 2',
            'no_hp' => $faker->phoneNumber,
            'tempat_lahir_id' => 1,
            'tanggal_lahir' => $faker->date(),
            'warga_negara_id' => 1,
            'user_id' => 9,
            'nik' => $faker->unique()->numerify('################'),
            'agama_id' => $agamas->random()->id,
            'perkawinan_id' => $perkawinans->random()->id,
            'alamat' => $faker->address,
            'jenis_kelamin' => 'Perempuan',
            'alamat_village_id' => 1,
            'alamat_kecamatan_id' => 1,
            'alamat_kabupaten_id' => 1,
            'alamat_provinsi_id' => 1,
        ]);
    }
}
