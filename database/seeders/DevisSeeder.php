<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Commande;
use App\Models\Client;
use App\Models\Produit;
use Carbon\Carbon;

class DevisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les clients existants
        $clients = Client::all();
        $produits = Produit::all();

        if ($clients->isEmpty() || $produits->isEmpty()) {
            $this->command->info('Aucun client ou produit trouvé. Veuillez d\'abord exécuter les seeders Clients et Produits.');
            return;
        }

        // Données d'exemple pour les demandes de devis
        $devisData = [
            [
                'client_id' => $clients->random()->id,
                'produits' => [
                    [
                        'id' => $produits->random()->id,
                        'nom' => 'Oignon Safari',
                        'variete' => 'Safari',
                        'conditionnement' => '20kg',
                        'quantite' => 5,
                        'image' => '/img/produits/oignon-safari.jpg'
                    ],
                    [
                        'id' => $produits->random()->id,
                        'nom' => 'Tomate Cobra',
                        'variete' => 'Cobra',
                        'conditionnement' => '20kg',
                        'quantite' => 3,
                        'image' => '/img/produits/tomate-cobra.jpg'
                    ]
                ],
                'commentaires' => 'Besoin urgent pour un événement. Livraison souhaitée dans 3 jours.',
                'date_livraison_souhaitee' => Carbon::now()->addDays(3),
                'notes_admin' => 'Demande de devis reçue depuis le site web'
            ],
            [
                'client_id' => $clients->random()->id,
                'produits' => [
                    [
                        'id' => $produits->random()->id,
                        'nom' => 'Gombo Hiré',
                        'variete' => 'Hiré',
                        'conditionnement' => '18kg',
                        'quantite' => 10,
                        'image' => '/img/produits/gombo-hire.jpg'
                    ],
                    [
                        'id' => $produits->random()->id,
                        'nom' => 'Aubergine Djemba',
                        'variete' => 'Djemba',
                        'conditionnement' => '20kg',
                        'quantite' => 8,
                        'image' => '/img/produits/aubergine-djemba.jpg'
                    ],
                    [
                        'id' => $produits->random()->id,
                        'nom' => 'Poivron California',
                        'variete' => 'California',
                        'conditionnement' => '15kg',
                        'quantite' => 6,
                        'image' => '/img/produits/poivron-california.jpg'
                    ]
                ],
                'commentaires' => 'Commande pour restaurant. Qualité premium requise.',
                'date_livraison_souhaitee' => Carbon::now()->addDays(7),
                'notes_admin' => 'Demande de devis reçue depuis le site web'
            ],
            [
                'client_id' => $clients->random()->id,
                'produits' => [
                    [
                        'id' => $produits->random()->id,
                        'nom' => 'Pastèque Baby Doll',
                        'variete' => 'Baby Doll',
                        'conditionnement' => '25kg',
                        'quantite' => 15,
                        'image' => '/img/produits/pasteque-baby-doll.jpg'
                    ],
                    [
                        'id' => $produits->random()->id,
                        'nom' => 'Melon Galia',
                        'variete' => 'Galia',
                        'conditionnement' => '25kg',
                        'quantite' => 12,
                        'image' => '/img/produits/melon-galia.jpg'
                    ]
                ],
                'commentaires' => 'Commande pour supermarché. Livraison hebdomadaire souhaitée.',
                'date_livraison_souhaitee' => Carbon::now()->addDays(5),
                'notes_admin' => 'Demande de devis reçue depuis le site web'
            ],
            [
                'client_id' => $clients->random()->id,
                'produits' => [
                    [
                        'id' => $produits->random()->id,
                        'nom' => 'Carotte New Kuroda',
                        'variete' => 'New Kuroda',
                        'conditionnement' => '5kg',
                        'quantite' => 20,
                        'image' => '/img/produits/carotte-new-kuroda.jpg'
                    ],
                    [
                        'id' => $produits->random()->id,
                        'nom' => 'Concombre Tokyo',
                        'variete' => 'Tokyo',
                        'conditionnement' => '30kg',
                        'quantite' => 8,
                        'image' => '/img/produits/concombre-tokyo.jpg'
                    ],
                    [
                        'id' => $produits->random()->id,
                        'nom' => 'Haricot Cora',
                        'variete' => 'Cora',
                        'conditionnement' => '10kg',
                        'quantite' => 15,
                        'image' => '/img/produits/haricot-cora.jpg'
                    ]
                ],
                'commentaires' => 'Commande pour traiteur. Besoin de produits frais de qualité.',
                'date_livraison_souhaitee' => Carbon::now()->addDays(4),
                'notes_admin' => 'Demande de devis reçue depuis le site web'
            ],
            [
                'client_id' => $clients->random()->id,
                'produits' => [
                    [
                        'id' => $produits->random()->id,
                        'nom' => 'Choux KK Cross',
                        'variete' => 'KK Cross',
                        'conditionnement' => '25kg',
                        'quantite' => 25,
                        'image' => '/img/produits/choux-kk-cross.jpg'
                    ],
                    [
                        'id' => $produits->random()->id,
                        'nom' => 'Piment Big Sun',
                        'variete' => 'Big Sun',
                        'conditionnement' => '15kg',
                        'quantite' => 10,
                        'image' => '/img/produits/piment-big-sun.jpg'
                    ]
                ],
                'commentaires' => 'Commande pour marché local. Prix compétitif demandé.',
                'date_livraison_souhaitee' => Carbon::now()->addDays(6),
                'notes_admin' => 'Demande de devis reçue depuis le site web'
            ]
        ];

        foreach ($devisData as $devis) {
            // Calculer le total des articles
            $totalArticles = collect($devis['produits'])->sum('quantite');

            // Récupérer les informations du client pour l'adresse de livraison
            $client = Client::find($devis['client_id']);

            Commande::create([
                'numero_commande' => Commande::generateNumeroCommande(),
                'client_id' => $devis['client_id'],
                'adresse_livraison' => $client->adresse_livraison,
                'ville' => $client->ville,
                'code_postal' => $client->code_postal,
                'produits' => $devis['produits'],
                'total_articles' => $totalArticles,
                'montant_total' => null, // Demande de devis
                'date_livraison_souhaitee' => $devis['date_livraison_souhaitee'],
                'commentaires' => $devis['commentaires'],
                'statut' => 'en_attente',
                'notes_admin' => $devis['notes_admin'],
                'created_at' => Carbon::now()->subDays(rand(1, 10)),
                'updated_at' => Carbon::now()->subDays(rand(1, 10)),
            ]);
        }

        $this->command->info('Demandes de devis créées avec succès !');
    }
}
