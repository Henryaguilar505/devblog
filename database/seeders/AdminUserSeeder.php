<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        User::create([
            'name' => 'Admin Dev',
            'email' => 'henryelcrack850@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Mileña@250901'),
            'rol' => 1, // Define un rol de administrador
        ]);
    }
}
