<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Medicine;
use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'storename' => '',
            'role' => 'admin',
            'status' => 'accept',
            'email' => 'admin@gmail.com',
            'password' =>  Hash::make(12345678),
        ]);
        User::create([
            'firstname' => 'Manager',
            'lastname' => 'Manager',
            'storename' => '',
            'role' => 'driverManager',
            'status' => 'accept',
            'email' => 'driverManager@gmail.com',
            'password' =>  Hash::make(12345678),
        ]);
    }
}
