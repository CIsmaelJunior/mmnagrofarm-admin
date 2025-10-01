<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ========================================
// API PUBLIQUES POUR LE SITE ASTRO
// ========================================

// API pour récupérer les produits (publique)
Route::get('/produits', function () {
    $produits = \App\Models\Produit::where('actif', true)
        ->select('id', 'nom', 'variete', 'conditionnement', 'image', 'description')
        ->get();

    return response()->json($produits);
})->name('api.produits.index');

// API pour récupérer un produit spécifique (publique)
Route::get('/produits/{id}', function ($id) {
    $produit = \App\Models\Produit::where('id', $id)
        ->where('actif', true)
        ->select('id', 'nom', 'variete', 'conditionnement', 'image', 'description')
        ->first();

    if (!$produit) {
        return response()->json(['error' => 'Produit non trouvé'], 404);
    }

    return response()->json($produit);
})->name('api.produits.show');

// Route API pour les demandes de devis depuis le site Astro
Route::post('/devis', [App\Http\Controllers\CommandeController::class, 'storeDevis'])->name('api.devis.store');
