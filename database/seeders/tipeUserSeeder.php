<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipe_users')->insert([
            ['nama_tipe_user' => 'Admin'],
            ['nama_tipe_user' => 'Tenant Relation'],
            ['nama_tipe_user' => 'Finance'],
            ['nama_tipe_user' => 'Engineers'],
            ['nama_tipe_user' => 'Security'],
            ['nama_tipe_user' => 'House Keeping'],
            ['nama_tipe_user' => 'Parking'],
            ['nama_tipe_user' => 'IT'],
            ['nama_tipe_user' => 'Marketing'],
            ['nama_tipe_user' => 'HR'],
            ['nama_tipe_user' => 'Pemilik'],
            ['nama_tipe_user' => 'Penyewa'],
        ]);
    }
}
