<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commande extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'numero_commande',
        'client_id',
        'adresse_livraison',
        'ville',
        'code_postal',
        'produits',
        'total_articles',
        'montant_total',
        'date_livraison_souhaitee',
        'commentaires',
        'statut',
        'notes_admin',
        'deleted_by'
    ];

    protected $casts = [
        'produits' => 'array',
        'montant_total' => 'decimal:2',
        'date_livraison_souhaitee' => 'date',
        'total_articles' => 'integer'
    ];

    protected $dates = [
        'deleted_at',
        'date_livraison_souhaitee'
    ];

    // Relation avec le client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Générer un numéro de commande unique
    public static function generateNumeroCommande()
    {
        do {
            $numero = 'CMD-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (self::where('numero_commande', $numero)->exists());

        return $numero;
    }

    // Accessor pour le statut en français
    public function getStatutLibelleAttribute()
    {
        $statuts = [
            'en_attente' => 'En attente',
            'en_cours' => 'En cours',
            'livree' => 'Livrée',
            'annulee' => 'Annulée'
        ];

        return $statuts[$this->statut] ?? $this->statut;
    }

    // Accessor pour la couleur du statut
    public function getStatutCouleurAttribute()
    {
        $couleurs = [
            'en_attente' => 'warning',
            'en_cours' => 'info',
            'livree' => 'success',
            'annulee' => 'danger'
        ];

        return $couleurs[$this->statut] ?? 'secondary';
    }
}
