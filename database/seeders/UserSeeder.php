<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
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
                'name' => 'Engineering',
                'email' => 'eg@landmark.com',
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
        ]);
    }
}
