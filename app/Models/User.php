<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Obtenir les initiales de l'utilisateur
     */
    public function getInitialsAttribute(): string
    {
        $nameParts = explode(' ', $this->name);
        $initials = '';

        if (count($nameParts) >= 2) {
            $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
        } else {
            $initials = strtoupper(substr($this->name, 0, 2));
        }

        return $initials;
    }

    /**
     * Obtenir le prénom de l'utilisateur
     */
    public function getFirstNameAttribute(): string
    {
        $nameParts = explode(' ', $this->name);
        return $nameParts[0] ?? $this->name;
    }

    /**
     * Obtenir le nom de famille de l'utilisateur
     */
    public function getLastNameAttribute(): string
    {
        $nameParts = explode(' ', $this->name);
        return count($nameParts) > 1 ? end($nameParts) : '';
    }

    /**
     * Obtenir le rôle de l'utilisateur
     */
    public function getRoleAttribute(): string
    {
        // Pour l'instant, tous les utilisateurs sont administrateurs
        // Vous pouvez ajouter une logique plus complexe ici
        return 'Administrateur';
    }

    /**
     * Obtenir l'URL de l'avatar
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if ($this->avatar) {
            return asset('avatars/' . $this->avatar);
        }

        // Retourner null si pas d'avatar
        return null;
    }

    /**
     * Obtenir l'avatar par défaut avec initiales
     */
    public function getDefaultAvatarAttribute(): string
    {
        return "data:image/svg+xml;base64," . base64_encode(
            '<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                <rect width="100" height="100" fill="#667eea"/>
                <text x="50" y="50" font-family="Arial, sans-serif" font-size="40" font-weight="bold"
                      text-anchor="middle" dy=".3em" fill="white">' . $this->initials . '</text>
            </svg>'
        );
    }

    /**
     * Vérifier si l'utilisateur a un avatar
     */
    public function hasAvatar(): bool
    {
        return $this->avatar && file_exists(public_path('avatars/' . $this->avatar));
    }

    /**
     * Obtenir le chemin complet de l'avatar
     */
    public function getAvatarPathAttribute(): ?string
    {
        if ($this->avatar) {
            return public_path('avatars/' . $this->avatar);
        }
        return null;
    }
}
