<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'nom' => 'Amadou Traoré',
                'email' => 'amadou.traore@email.com',
                'telephone' => '+223 70 12 34 56',
                'entreprise' => 'Traoré & Fils SARL',
                'adresse_livraison' => 'Quartier Hippodrome, Rue 123',
                'ville' => 'Bamako',
                'code_postal' => 'BP 1234',
                'notes' => 'Client fidèle depuis 2020. Préfère les livraisons le matin.',
                'actif' => true,
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(5),
            ],
            [
                'nom' => 'Fatoumata Diallo',
                'email' => 'fatoumata.diallo@email.com',
                'telephone' => '+223 65 78 90 12',
                'entreprise' => null,
                'adresse_livraison' => 'Aci 2000, Immeuble Alpha',
                'ville' => 'Bamako',
                'code_postal' => 'BP 5678',
                'notes' => 'Particulier. Commandes régulières de fruits et légumes.',
                'actif' => true,
                'created_at' => now()->subDays(25),
                'updated_at' => now()->subDays(2),
            ],
            [
                'nom' => 'Ibrahim Keita',
                'email' => 'ibrahim.keita@restaurant.com',
                'telephone' => '+223 76 54 32 10',
                'entreprise' => 'Restaurant Le Savoureux',
                'adresse_livraison' => 'Zone Industrielle, Avenue du Commerce',
                'ville' => 'Bamako',
                'code_postal' => 'BP 9012',
                'notes' => 'Restaurant. Commandes importantes chaque semaine.',
                'actif' => true,
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(1),
            ],
            [
                'nom' => 'Aïcha Coulibaly',
                'email' => 'aicha.coulibaly@email.com',
                'telephone' => '+223 69 87 65 43',
                'entreprise' => 'Épicerie du Quartier',
                'adresse_livraison' => 'Quartier Sotuba, Rue du Marché',
                'ville' => 'Bamako',
                'code_postal' => 'BP 3456',
                'notes' => 'Épicerie de quartier. Revendeur de nos produits.',
                'actif' => true,
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(3),
            ],
            [
                'nom' => 'Moussa Diarra',
                'email' => 'moussa.diarra@email.com',
                'telephone' => '+223 71 23 45 67',
                'entreprise' => null,
                'adresse_livraison' => 'Badalabougou, Rue 456',
                'ville' => 'Bamako',
                'code_postal' => 'BP 7890',
                'notes' => 'Particulier. Nouveau client depuis ce mois.',
                'actif' => true,
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(1),
            ],
            [
                'nom' => 'Mariam Sangaré',
                'email' => 'mariam.sangare@hotel.com',
                'telephone' => '+223 66 11 22 33',
                'entreprise' => 'Hôtel La Paix',
                'adresse_livraison' => 'Centre-ville, Avenue de l\'Indépendance',
                'ville' => 'Bamako',
                'code_postal' => 'BP 1111',
                'notes' => 'Hôtel 4 étoiles. Commandes pour le restaurant de l\'hôtel.',
                'actif' => true,
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(1),
            ],
            [
                'nom' => 'Boubacar Koné',
                'email' => 'boubacar.kone@email.com',
                'telephone' => '+223 64 99 88 77',
                'entreprise' => 'Super Marché Koné',
                'adresse_livraison' => 'Quartier Niamakoro, Avenue du Mali',
                'ville' => 'Bamako',
                'code_postal' => 'BP 2222',
                'notes' => 'Super marché. Partenaire commercial important.',
                'actif' => true,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(1),
            ],
            [
                'nom' => 'Kadiatou Traoré',
                'email' => 'kadiatou.traore@email.com',
                'telephone' => '+223 72 44 55 66',
                'entreprise' => null,
                'adresse_livraison' => 'Magnambougou, Rue 789',
                'ville' => 'Bamako',
                'code_postal' => 'BP 3333',
                'notes' => 'Particulier. Commandes occasionnelles.',
                'actif' => false,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(1),
            ],
            [
                'nom' => 'Sékou Doumbia',
                'email' => 'sekou.doumbia@cantine.com',
                'telephone' => '+223 68 77 66 55',
                'entreprise' => 'Cantine Scolaire Moderne',
                'adresse_livraison' => 'Quartier Point G, Rue de l\'École',
                'ville' => 'Bamako',
                'code_postal' => 'BP 4444',
                'notes' => 'Cantine scolaire. Commandes pour les repas des élèves.',
                'actif' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(1),
            ],
            [
                'nom' => 'Aminata Maïga',
                'email' => 'aminata.maiga@email.com',
                'telephone' => '+223 63 22 33 44',
                'entreprise' => null,
                'adresse_livraison' => 'Quartier Lafiabougou, Rue 101',
                'ville' => 'Bamako',
                'code_postal' => 'BP 5555',
                'notes' => 'Particulier. Nouveau client cette semaine.',
                'actif' => true,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
        ];

        DB::table('clients')->insert($clients);
    }
}
