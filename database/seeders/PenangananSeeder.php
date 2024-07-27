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
        $createdByIds = User::where('tipe_user_id', '2')->pluck('id')->toArray();
        $updatedByIds = User::pluck('id')->toArray();

        shuffle($komplainIds);
        $selectedKomplainIds = array_slice($komplainIds, 0, 10);

        // Get the last inserted number
        $lastPenanganan = DB::table('penanganans')->orderBy('id', 'desc')->first();
        $lastNumber = $lastPenanganan ? intval(substr($lastPenanganan->nomor_penanganan, -6)) : 0;

        foreach ($selectedKomplainIds as $index => $komplainId) {
            $tanggalPenanganan = $faker->dateTimeThisYear();
            $prefix = 'HDL';
            $currentDate = $tanggalPenanganan->format('Ymd'); // Format tanggal YYYYMMDD

            // Increment the number for each new entry
            $currentIncrement = str_pad($lastNumber + $index + 1, 6, '0', STR_PAD_LEFT);
            $nomor_penanganan = $prefix . '/' . $currentDate . '/' . $currentIncrement;

            DB::table('penanganans')->insert([
                'komplain_id' => $komplainId,
                'nomor_penanganan' => $nomor_penanganan,
                'respon_awal' => $faker->sentence(),
                'pemeriksaan_awal' => $faker->sentence(),
                'penyelesaian_komplain' => $faker->sentence(),
                'foto_pemeriksaan_awal' => null,
                'foto_hasil_perbaikan' => null,
                'persetujuan_selesai_tr' => $faker->numberBetween(0, 1),
                'persetujuan_selesai_pelaksana' => $faker->numberBetween(0, 1),
                'tanggal_penanganan' => $tanggalPenanganan,
                'created_by' => $faker->randomElement($createdByIds),
                'updated_by' => $faker->randomElement($updatedByIds),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
