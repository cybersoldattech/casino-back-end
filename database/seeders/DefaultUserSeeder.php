<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Création d'un utilisateur par défaut
        User::create([
            'name' => 'Admin casino',
            'email' => 'admin@casino.com',
            'password' => Hash::make('password'),
        ]);
    }
}
