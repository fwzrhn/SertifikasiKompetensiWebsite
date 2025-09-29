<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin default
        User::firstOrCreate(
            ['username' => 'admin'], 
            [
                'name' => 'Administrator',  // tambahkan ini
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Buat user biasa
        User::firstOrCreate(
            ['username' => 'user1'],
            [
                'name' => 'User Satu',  // tambahkan ini juga
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );
    }
}
