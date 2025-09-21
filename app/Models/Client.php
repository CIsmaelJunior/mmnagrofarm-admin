<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'entreprise',
        'adresse_livraison',
        'ville',
        'code_postal',
        'notes',
        'actif',
        'deleted_by'
    ];

    protected $casts = [
        'actif' => 'boolean'
    ];

    protected $dates = [
        'deleted_at'
    ];

    // Relation avec les commandes
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    // Accessor pour le nom complet
    public function getNomCompletAttribute()
    {
        return $this->nom . ($this->entreprise ? ' (' . $this->entreprise . ')' : '');
    }

    // Scope pour les clients actifs
    public function scopeActifs($query)
    {
        return $query->where('actif', true);
    }
}
