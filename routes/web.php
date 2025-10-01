<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// ========================================
// ROUTES PUBLIQUES - SITE ASTRO
// ========================================

// Routes d'authentification admin (publiques)
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/admin/login', [AuthController::class, 'login']);
    Route::get('/admin/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/admin/register', [AuthController::class, 'register']);
    Route::get('/admin/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/admin/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
});

// Route de déconnexion admin
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Routes publiques du site Astro
Route::get('/', function () {
    // Servir le fichier index.html d'Astro
    return response()->file(base_path('dist/index.html'));
})->name('home');

// Routes catch-all pour Astro (SPA routing)
Route::get('/{path}', function ($path) {
    // Vérifier si c'est une route admin
    if (str_starts_with($path, 'admin/')) {
        return redirect()->route('login');
    }

    // Vérifier si le fichier Astro existe
    $astroPath = base_path("dist/{$path}");
    if (file_exists($astroPath) && is_file($astroPath)) {
        return response()->file($astroPath);
    }

    // Pour les routes SPA d'Astro, servir index.html
    $indexPath = base_path('dist/index.html');
    if (file_exists($indexPath)) {
        return response()->file($indexPath);
    }

    // Fallback
    return response()->file(base_path('dist/index.html'));
})->where('path', '.*');

// ========================================
// ROUTES ADMIN - PROTÉGÉES
// ========================================

// Routes protégées - nécessitent une authentification
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Route d'accueil admin - redirige vers le dashboard
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
    });
});

