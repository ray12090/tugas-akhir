<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penyewa;
use App\Models\User;
use App\Models\ApprovalRequestPenyewa;
use Faker\Factory as Faker;

class approvalRequestPenyewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $penyewas = Penyewa::all();
        $trUsers = User::where('tipe_user_id', '2')->get();

        foreach ($penyewas as $penyewa) {
            $status = (rand(1, 100) <= 95) ? 'Diterima' : 'Ditolak';
            ApprovalRequestPenyewa::create([
                'penyewa_id' => $penyewa->id,
                'status' => $status,
                'approved_by' => $faker->randomElement($trUsers)->id,
            ]);
        }
    }
}
