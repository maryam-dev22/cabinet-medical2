<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@medical.com',
            'password' => Hash::make('password'),
            'role' => 'doctor',
            'email_verified_at' => now(),
        ]);

        // Create additional users using factory
        User::factory()->count(10)->create();
    }
}
