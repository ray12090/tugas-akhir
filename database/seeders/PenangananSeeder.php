<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Komplain;
use Faker\Factory as Faker;

class PenangananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $komplainIds = Komplain::pluck('id')->toArray();

        $createdByIds = User::where('usertype', 'tr')->pluck('id')->toArray();

        $updatedByIds = User::pluck('id')->toArray();

        shuffle($komplainIds);
        $selectedKomplainIds = array_slice($komplainIds, 0, 10);

        foreach ($selectedKomplainIds as $komplainId) {
            DB::table('penanganans')->insert([
                'komplain_id' => $komplainId,
                'nomor_penanganan' => $faker->unique()->numerify('PN-####'),
                'respon_awal' => $faker->sentence(),
                'pemeriksaan_awal' => $faker->sentence(),
                'penyelesaian_komplain' => $faker->sentence(),
                'foto_pemeriksaan_awal' => null,
                'foto_hasil_perbaikan' => null,
                'persetujuan_selesai_tr' => $faker->numberBetween(0, 1),
                'persetujuan_selesai_pelaksana' => $faker->numberBetween(0, 1),
                'tanggal_penanganan' => $faker->dateTimeThisYear(),
                'created_by' => $faker->randomElement($createdByIds),
                'updated_by' => $faker->randomElement($updatedByIds),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
