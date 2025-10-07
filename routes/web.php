<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route pour servir le site frontend à la racine
Route::get('/', function () {
    $frontendPath = public_path('frontend/index.html');

    if (file_exists($frontendPath)) {
        return response()->file($frontendPath);
    }

    // Fallback vers la page de bienvenue Laravel si le frontend n'existe pas
    return view('welcome');
})->name('frontend');

// Route pour servir les assets statiques du frontend (CSS, JS, images, etc.)
Route::get('/assets/{path}', function ($path) {
    $assetPath = public_path('frontend/assets/' . $path);

    if (file_exists($assetPath)) {
        return response()->file($assetPath);
    }

    return response('Asset not found', 404);
})->where('path', '.*')->name('frontend.assets');

// Routes d'authentification (publiques) - préfixées par admin/
Route::prefix('admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
        Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
        Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    });

    // Route de déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Routes protégées - nécessitent une authentification
    Route::middleware(['auth'])->group(function () {
        // Route d'accueil - redirige vers le dashboard
        Route::get('/', function () {
            return redirect()->route('dashboard');
        });

        // Route du tableau de bord
        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Routes pour les produits
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [App\Http\Controllers\ProduitController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\ProduitController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\ProduitController::class, 'store'])->name('store');
        Route::get('/{slug}', [App\Http\Controllers\ProduitController::class, 'show'])->name('show');
        Route::get('/{slug}/edit', [App\Http\Controllers\ProduitController::class, 'edit'])->name('edit');
        Route::put('/{slug}', [App\Http\Controllers\ProduitController::class, 'update'])->name('update');
        Route::delete('/{slug}', [App\Http\Controllers\ProduitController::class, 'destroy'])->name('destroy');
    });

    // Routes pour les commandes
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [App\Http\Controllers\CommandeController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\CommandeController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [App\Http\Controllers\CommandeController::class, 'edit'])->name('edit');
        Route::get('/{id}/pdf', [App\Http\Controllers\CommandeController::class, 'generatePdf'])->name('pdf');
        Route::put('/{id}', [App\Http\Controllers\CommandeController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\CommandeController::class, 'destroy'])->name('destroy');
    });

    // Routes pour les clients
    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [App\Http\Controllers\ClientController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\ClientController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\ClientController::class, 'store'])->name('store');
        Route::get('/{id}', [App\Http\Controllers\ClientController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [App\Http\Controllers\ClientController::class, 'edit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('destroy');
    });

    // Routes pour les paramètres
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [App\Http\Controllers\SettingsController::class, 'index'])->name('index');

        Route::get('/profile', [App\Http\Controllers\SettingsController::class, 'profile'])->name('profile');
        Route::put('/profile', [App\Http\Controllers\SettingsController::class, 'updateProfile'])->name('profile.update');

        Route::get('/system', [App\Http\Controllers\SettingsController::class, 'system'])->name('system');
        Route::put('/system', [App\Http\Controllers\SettingsController::class, 'updateSystem'])->name('system.update');

        Route::get('/notifications', [App\Http\Controllers\SettingsController::class, 'notifications'])->name('notifications');
        Route::put('/notifications', [App\Http\Controllers\SettingsController::class, 'updateNotifications'])->name('notifications.update');

        // Route pour le profil utilisateur
        Route::get('/profile', [App\Http\Controllers\SettingsController::class, 'profile'])->name('profile');
        Route::put('/profile', [App\Http\Controllers\SettingsController::class, 'updateProfile'])->name('profile.update');
    });
    });
});

