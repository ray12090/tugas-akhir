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
        $users = User::whereNotIn('tipe_user_id', [11, 12])->pluck('id')->toArray();

        foreach ($penanganans as $penanganan) {
            $randomUsers = array_rand(array_flip($users), rand(1, 3));

            if (!is_array($randomUsers)) {
                $randomUsers = [$randomUsers];
            }

            $penanganan->users()->sync($randomUsers);
        }
    }
}
