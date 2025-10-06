<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        $user = Auth::user();
        return view('dashboard.settings.profile', compact('user'));
    }

    /**
     * Mettre à jour le profil
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        // Vérifier le mot de passe actuel si un nouveau mot de passe est fourni
        if ($request->filled('new_password')) {
            if (!$request->filled('current_password') || !Hash::check($request->current_password, $user->password)) {
                return redirect()->back()
                    ->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.'])
                    ->withInput();
            }
        }

        // Mettre à jour les informations de base
        $user->name = $request->name;
        $user->email = $request->email;

        // Ajouter le téléphone si le champ existe dans la base de données
        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }

        // Mettre à jour le mot de passe si fourni
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        // Gérer l'upload de l'avatar
        if ($request->hasFile('avatar')) {
            // Supprimer l'ancien avatar s'il existe
            if ($user->avatar && file_exists(public_path('avatars/' . $user->avatar))) {
                unlink(public_path('avatars/' . $user->avatar));
            }

            // Créer le dossier avatars s'il n'existe pas
            if (!file_exists(public_path('avatars'))) {
                mkdir(public_path('avatars'), 0755, true);
            }

            // Générer un nom de fichier unique
            $file = $request->file('avatar');
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Déplacer le fichier vers public/avatars/
            $file->move(public_path('avatars'), $filename);
            $user->avatar = $filename;
        }

        // Gérer la suppression de l'avatar
        if ($request->has('remove_avatar') && $user->avatar) {
            if (file_exists(public_path('avatars/' . $user->avatar))) {
                unlink(public_path('avatars/' . $user->avatar));
            }
            $user->avatar = null;
        }

        $user->save();

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
