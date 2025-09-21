<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Afficher le tableau de bord principal
     */
    public function index()
    {
        // Statistiques principales
        $stats = [
            'total_produits' => Produit::count(),
            'total_commandes' => Commande::count(),
            'total_clients' => Client::count(),
            'total_utilisateurs' => User::count(),
        ];

        // Statistiques des commandes par statut
        $commandes_stats = [
            'en_attente' => Commande::where('statut', 'en_attente')->count(),
            'en_cours' => Commande::where('statut', 'en_cours')->count(),
            'livree' => Commande::where('statut', 'livree')->count(),
        ];

        // Calcul du chiffre d'affaires (somme des montants des commandes livrées)
        $chiffre_affaires = Commande::where('statut', 'livree')
            ->whereNotNull('montant_total')
            ->sum('montant_total');

        // Commandes récentes (5 dernières)
        $commandes_recentes = Commande::with('client')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Clients récents (5 derniers)
        $clients_recents = Client::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Produits les plus commandés (basé sur les données JSON)
        $produits_populaires = Produit::orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Statistiques mensuelles
        $mois_actuel = Carbon::now()->month;
        $annee_actuelle = Carbon::now()->year;

        $commandes_mois = Commande::whereMonth('created_at', $mois_actuel)
            ->whereYear('created_at', $annee_actuelle)
            ->count();

        $clients_mois = Client::whereMonth('created_at', $mois_actuel)
            ->whereYear('created_at', $annee_actuelle)
            ->count();

        return view('dashboard.index', compact(
            'stats',
            'commandes_stats',
            'chiffre_affaires',
            'commandes_recentes',
            'clients_recents',
            'produits_populaires',
            'commandes_mois',
            'clients_mois'
        ));
    }
}
