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
                'usertype' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tenant Relation',
                'email' => 'tr@landmark.com',
                'password' => Hash::make('12345678'),
                'usertype' => 'tr',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tenant Relation 2',
                'email' => 'tr2@landmark.com',
                'password' => Hash::make('12345678'),
                'usertype' => 'tr',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Engineering',
                'email' => 'eg@landmark.com',
                'password' => Hash::make('12345678'),
                'usertype' => 'eg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Engineering 2',
                'email' => 'eg2@landmark.com',
                'password' => Hash::make('12345678'),
                'usertype' => 'eg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Engineering 3',
                'email' => 'eg3@landmark.com',
                'password' => Hash::make('12345678'),
                'usertype' => 'eg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Finance',
                'email' => 'fa@landmark.com',
                'password' => Hash::make('12345678'),
                'usertype' => 'fa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pemilik 1',
                'email' => 'pemilik1@landmark.com',
                'password' => Hash::make('12345678'),
                'usertype' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pemilik 2',
                'email' => 'pemilik2@landmark.com',
                'password' => Hash::make('12345678'),
                'usertype' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Penyewa 1',
                'email' => 'penyewa1@landmark.com',
                'password' => Hash::make('12345678'),
                'usertype' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert predefined users
        User::insert($users);

    }
}
