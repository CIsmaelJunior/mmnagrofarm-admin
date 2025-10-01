<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un utilisateur administrateur par défaut
        User::firstOrCreate(
            ['email' => 'admin@mmbagrofarm.com'],
            [
                'name' => 'Administrateur MMB Agro Farm',
                'password' => Hash::make('admin123456'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Utilisateur administrateur créé avec succès !');
        $this->command->info('Email: admin@mmbagrofarm.com');
        $this->command->info('Mot de passe: admin123456');
        $this->command->warn('⚠️  IMPORTANT: Changez ce mot de passe après votre première connexion !');
    }
}
