<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer l'utilisateur administrateur en premier
        $this->call([
            AdminUserSeeder::class,
        ]);

        // Appeler les autres seeders
        $this->call([
            ProduitsSeeder::class,
            ClientsSeeder::class,
            DevisSeeder::class,
        ]);
    }
}
