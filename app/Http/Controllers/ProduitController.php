<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::all();
        return view('dashboard.products.index', compact('produits'));
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
    public function show(string $slug)
    {
        $produit = Produit::where('slug', $slug)->firstOrFail();
        return view('dashboard.products.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $produit = Produit::where('slug', $slug)->firstOrFail();
        return view('dashboard.products.edit', compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $produit = Produit::where('slug', $slug)->firstOrFail();

        $request->validate([
            'nom' => 'required|string|max:255',
            'variete' => 'required|string|max:255',
            'description' => 'required|string',
            'origine' => 'required|string|max:255',
            'gout' => 'required|string',
            'conservation' => 'required|string',
            'saison' => 'required|string|max:255',
            'usage' => 'required|string',
            'conditionnement' => 'required|array|min:1',
            'conditionnement.*' => 'required|string',
            'bienfaits' => 'required|array|min:1',
            'bienfaits.*' => 'required|string',
            'prix' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // Gérer l'upload de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/produits'), $imageName);
            $data['image'] = '/img/produits/' . $imageName;
        } else {
            // Garder l'image existante si aucune nouvelle image n'est uploadée
            unset($data['image']);
        }

        // Filtrer les conditionnements vides
        $data['conditionnement'] = array_filter($data['conditionnement']);

        // Filtrer les bienfaits vides
        $data['bienfaits'] = array_filter($data['bienfaits']);

        $produit->update($data);

        return redirect()->route('products.show', $produit->slug)
            ->with('success', 'Produit mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $produit = Produit::where('slug', $slug)->firstOrFail();

        // Supprimer l'image du serveur si elle existe
        if ($produit->image && file_exists(public_path($produit->image))) {
            unlink(public_path($produit->image));
        }

        $produit->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produit supprimé avec succès !');
    }
}
