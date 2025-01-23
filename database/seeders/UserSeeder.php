<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);
    
        User::create([
            'name' => 'Guest',
            'email' => 'guest@example.com',
            'password' => bcrypt('password'),
            'role' => 'guest',
        ]);
        User::create([
            'name' => 'Guest',
            'email' => 'guest@example.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
        ]);
    }
}
