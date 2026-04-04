<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'middle_name' => '',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'age' => 35,
            'profile_image' => null,
        ]);

        // Create teacher users
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'first_name' => "Teacher",
                'last_name' => "User $i",
                'middle_name' => '',
                'email' => "teacher$i@example.com",
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'status' => 'active',
                'age' => 30 + $i,
                'profile_image' => null,
            ]);
        }

        // Create student users
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'first_name' => "Student",
                'last_name' => "User $i",
                'middle_name' => '',
                'email' => "student$i@example.com",
                'password' => Hash::make('password'),
                'role' => 'student',
                'status' => 'active',
                'age' => 18 + ($i % 5),
                'profile_image' => null,
            ]);
        }
    }
}
