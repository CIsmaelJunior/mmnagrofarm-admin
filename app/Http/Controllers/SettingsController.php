<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Afficher la page principale des paramètres
     */
    public function index()
    {
        return view('dashboard.settings.index');
    }

    /**
     * Afficher les paramètres du profil
     */
    public function profile()
    {
        return view('dashboard.settings.profile');
    }

    /**
     * Mettre à jour le profil
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Ici vous pouvez ajouter la logique pour mettre à jour le profil
        // Par exemple, mettre à jour l'utilisateur connecté

        return redirect()->route('settings.profile')
            ->with('success', 'Profil mis à jour avec succès !');
    }

    /**
     * Afficher les paramètres système
     */
    public function system()
    {
        return view('dashboard.settings.system');
    }

    /**
     * Mettre à jour les paramètres système
     */
    public function updateSystem(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Ici vous pouvez ajouter la logique pour sauvegarder les paramètres système
        // Par exemple, dans un fichier de configuration ou une table dédiée

        return redirect()->route('settings.system')
            ->with('success', 'Paramètres système mis à jour avec succès !');
    }

    /**
     * Afficher les paramètres de notification
     */
    public function notifications()
    {
        return view('dashboard.settings.notifications');
    }

    /**
     * Mettre à jour les paramètres de notification
     */
    public function updateNotifications(Request $request)
    {
        $request->validate([
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
            'order_notifications' => 'boolean',
            'product_notifications' => 'boolean',
            'client_notifications' => 'boolean'
        ]);

        // Ici vous pouvez ajouter la logique pour sauvegarder les préférences de notification

        return redirect()->route('settings.notifications')
            ->with('success', 'Paramètres de notification mis à jour avec succès !');
    }
}
