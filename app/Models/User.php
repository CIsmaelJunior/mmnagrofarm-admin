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
}
