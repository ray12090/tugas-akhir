<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pemilik;
use App\Models\User;
use App\Models\ApprovalRequestPemilik;
use Faker\Factory as Faker;

class approvalRequestPemilikSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $pemiliks = Pemilik::all();
        $trUsers = User::where('usertype', 'tr')->get();

        foreach ($pemiliks as $pemilik) {
            $status = (rand(1, 100) <= 95) ? 'Diterima' : 'Ditolak';
            ApprovalRequestPemilik::create([
                'pemilik_id' => $pemilik->id,
                'status' => $status,
                'approved_by' => $faker->randomElement($trUsers)->id,
            ]);
        }
    }
}
