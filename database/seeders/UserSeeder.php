<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Unit;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Create predefined users
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@landmark.com',
                'password' => Hash::make('12345678'),
                'tipe_user_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tenant Relation',
                'email' => 'tr@landmark.com',
                'password' => Hash::make('12345678'),
                'tipe_user_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tenant Relation 2',
                'email' => 'tr2@landmark.com',
                'password' => Hash::make('12345678'),
                'tipe_user_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tenant Relation 3',
                'email' => 'tr3@landmark.com',
                'password' => Hash::make('12345678'),
                'tipe_user_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Engineering',
                'email' => 'eg@landmark.com',
                'password' => Hash::make('12345678'),
                'tipe_user_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Engineering 2',
                'email' => 'eg2@landmark.com',
                'password' => Hash::make('12345678'),
                'tipe_user_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Engineering 3',
                'email' => 'eg3@landmark.com',
                'password' => Hash::make('12345678'),
                'tipe_user_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Finance',
                'email' => 'fa@landmark.com',
                'password' => Hash::make('12345678'),
                'tipe_user_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Finance 2',
                'email' => 'fa2@landmark.com',
                'password' => Hash::make('12345678'),
                'tipe_user_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Finance 3',
                'email' => 'fa3@landmark.com',
                'password' => Hash::make('12345678'),
                'tipe_user_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pemilik 1',
                'email' => 'pemilik1@landmark.com',
                'password' => Hash::make('12345678'),
                'tipe_user_id' => '11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pemilik 2',
                'email' => 'pemilik2@landmark.com',
                'password' => Hash::make('12345678'),
                'tipe_user_id' => '11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Penyewa 1',
                'email' => 'penyewa1@landmark.com',
                'password' => Hash::make('12345678'),
                'tipe_user_id' => '12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert predefined users
        User::insert($users);

    }
}
