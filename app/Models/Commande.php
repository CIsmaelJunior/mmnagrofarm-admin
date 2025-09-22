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

    // Accessor pour vérifier si c'est une demande de devis
    public function getIsDevisAttribute()
    {
        return is_null($this->montant_total) && $this->statut === 'en_attente';
    }

    // Accessor pour le type de commande
    public function getTypeCommandeAttribute()
    {
        if ($this->is_devis) {
            return 'Demande de devis';
        }
        return 'Commande confirmée';
    }

    // Accessor pour la couleur du type
    public function getTypeCouleurAttribute()
    {
        return $this->is_devis ? 'info' : 'success';
    }

    // Méthode pour calculer le montant total des produits
    public function calculerMontantTotal()
    {
        if (!$this->produits || !is_array($this->produits)) {
            return 0;
        }

        $total = 0;
        foreach ($this->produits as $produit) {
            // Ici vous pouvez ajouter la logique de calcul du prix
            // Pour l'instant, on retourne 0 car les prix ne sont pas définis
            $total += 0; // $produit['prix'] * $produit['quantite']
        }

        return $total;
    }

    // Scope pour les demandes de devis
    public function scopeDevis($query)
    {
        return $query->whereNull('montant_total')->where('statut', 'en_attente');
    }

    // Scope pour les commandes confirmées
    public function scopeCommandes($query)
    {
        return $query->whereNotNull('montant_total');
    }
}
