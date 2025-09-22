<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use Barryvdh\DomPDF\Facade\Pdf;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commandes = Commande::with('client')->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.orders.index', compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $commande = Commande::with('client')->findOrFail($id);
        return view('dashboard.orders.show', compact('commande'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $commande = Commande::with('client')->findOrFail($id);

        // Vérifier que c'est bien un devis à traiter
        if (!$commande->is_devis) {
            return redirect()->route('orders.show', $commande->id)
                ->with('warning', 'Cette commande a déjà été traitée.');
        }

        return view('dashboard.orders.edit', compact('commande'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'montant_total' => 'required|numeric|min:0',
            'statut' => 'required|in:en_attente,en_cours,livree,annulee',
            'notes_admin' => 'nullable|string|max:1000',
            'reduction' => 'nullable|numeric|min:0|max:100',
            'produits' => 'nullable|array',
        ]);

        $commande = Commande::findOrFail($id);

        // Mettre à jour les produits avec les prix si fournis
        $produits = $commande->produits;
        if ($request->has('produits')) {
            foreach ($request->produits as $index => $produitData) {
                if (isset($produits[$index]) && isset($produitData['prix_unitaire'])) {
                    $produits[$index]['prix_unitaire'] = floatval($produitData['prix_unitaire']);
                }
            }
        }

        $commande->update([
            'produits' => $produits,
            'montant_total' => $request->montant_total,
            'statut' => $request->statut,
            'notes_admin' => $request->notes_admin,
        ]);

        $message = $commande->is_devis
            ? 'Devis traité avec succès ! Vous pouvez maintenant télécharger la facture.'
            : 'Commande mise à jour avec succès !';

        return redirect()->route('orders.show', $commande->id)
            ->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Commande supprimée avec succès !');
    }

    /**
     * Generate PDF for the specified order/devis
     */
    public function generatePdf(string $id)
    {
        $commande = Commande::with('client')->findOrFail($id);

        // Déterminer le nom du fichier
        $filename = $commande->is_devis
            ? 'Devis_' . $commande->numero_commande . '.pdf'
            : 'Facture_' . $commande->numero_commande . '.pdf';

        // Générer le PDF
        $pdf = Pdf::loadView('dashboard.orders.pdf.facture', compact('commande'));

        // Configuration du PDF
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'Arial'
        ]);

        // Retourner le PDF en téléchargement
        return $pdf->download($filename);
    }

    /**
     * Display PDF in browser for the specified order/devis
     */
    public function viewPdf(string $id)
    {
        $commande = Commande::with('client')->findOrFail($id);

        // Générer le PDF
        $pdf = Pdf::loadView('dashboard.orders.pdf.facture', compact('commande'));

        // Configuration du PDF
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'Arial'
        ]);

        // Retourner le PDF pour affichage dans le navigateur
        return $pdf->stream();
    }

    /**
     * Store a new devis request from the cart form
     */
    public function storeDevis(Request $request)
    {
        $request->validate([
            'client.nom' => 'required|string|max:255',
            'client.email' => 'required|email|max:255',
            'client.telephone' => 'nullable|string|max:20',
            'client.entreprise' => 'nullable|string|max:255',
            'client.adresse' => 'required|string|max:500',
            'client.ville' => 'required|string|max:100',
            'client.code_postal' => 'nullable|string|max:20',
            'client.date_livraison' => 'nullable|date|after:today',
            'client.commentaires' => 'nullable|string|max:1000',
            'produits' => 'required|array|min:1',
            'produits.*.id' => 'required|string',
            'produits.*.nom' => 'required|string',
            'produits.*.variete' => 'required|string',
            'produits.*.conditionnement' => 'required|string',
            'produits.*.quantite' => 'required|integer|min:1',
            'produits.*.image' => 'required|string',
        ]);

        try {
            // Créer ou récupérer le client
            $client = \App\Models\Client::firstOrCreate(
                ['email' => $request->client['email']],
                [
                    'nom' => $request->client['nom'],
                    'telephone' => $request->client['telephone'],
                    'entreprise' => $request->client['entreprise'],
                    'adresse_livraison' => $request->client['adresse'],
                    'ville' => $request->client['ville'],
                    'code_postal' => $request->client['code_postal'],
                    'actif' => true,
                ]
            );

            // Mettre à jour les informations du client si nécessaire
            $client->update([
                'nom' => $request->client['nom'],
                'telephone' => $request->client['telephone'],
                'entreprise' => $request->client['entreprise'],
                'adresse_livraison' => $request->client['adresse'],
                'ville' => $request->client['ville'],
                'code_postal' => $request->client['code_postal'],
            ]);

            // Calculer le total des articles
            $totalArticles = collect($request->produits)->sum('quantite');

            // Créer la commande (devis)
            $commande = Commande::create([
                'client_id' => $client->id,
                'numero_commande' => Commande::generateNumeroCommande(),
                'adresse_livraison' => $request->client['adresse'],
                'ville' => $request->client['ville'],
                'code_postal' => $request->client['code_postal'],
                'produits' => $request->produits,
                'total_articles' => $totalArticles,
                'montant_total' => null, // À définir par l'admin
                'date_livraison_souhaitee' => $request->client['date_livraison'],
                'commentaires' => $request->client['commentaires'],
                'statut' => 'en_attente',
                'notes_admin' => 'Demande de devis reçue depuis le site web',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Demande de devis envoyée avec succès !',
                'commande_id' => $commande->id,
                'numero_commande' => $commande->numero_commande,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi de la demande de devis.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
