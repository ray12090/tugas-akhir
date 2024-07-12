<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penanganan;
use App\Models\User;

class penangananUserPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penanganans = Penanganan::all();
        $users = User::all();

        foreach ($penanganans as $penanganan) {
            $randomUsers = $users->random(rand(1, 3))->pluck('id')->toArray();

            $penanganan->users()->sync($randomUsers);
        }
    }
}
