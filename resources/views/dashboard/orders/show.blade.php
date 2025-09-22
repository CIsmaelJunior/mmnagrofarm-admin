@extends('dashboard.layouts.master')

@section('content')
<style>
/* Optimisations pour écrans 13" */
@media (max-width: 1400px) {
    .modal-xl {
        max-width: 95%;
    }

    .card-body {
        padding: 1rem;
    }

    .form-control {
        font-size: 0.875rem;
    }

    .badge {
        font-size: 0.75rem;
    }
}

/* Optimisations spécifiques pour les produits */
.product-card {
    transition: all 0.2s ease;
    border-left: 3px solid transparent;
}

.product-card:hover {
    border-left-color: #007bff;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.product-image {
    width: 45px;
    height: 45px;
    object-fit: cover;
    border-radius: 6px;
    border: 2px solid #f8f9fa;
}

.price-input {
    font-weight: 600;
    text-align: center;
}

.total-display {
    font-size: 1rem;
    font-weight: 700;
}

/* Responsive pour très petits écrans */
@media (max-width: 768px) {
    .col-md-4, .col-md-3, .col-md-2 {
        margin-bottom: 0.5rem;
    }

    .product-card .row {
        text-align: center;
    }

    .product-card .d-flex {
        justify-content: center;
    }
}
</style>
<div class="row">
    <div class="col-12">
        <!-- En-tête de la commande -->
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>
                            <i class="fas fa-shopping-cart text-primary me-2"></i>
                            Commande {{ $commande->numero_commande }}
                        </h6>
                        <p class="text-sm mb-0">
                            <span class="badge badge-sm bg-gradient-{{ $commande->type_couleur }}">
                                {{ $commande->type_commande }}
                            </span>
                            <span class="badge badge-sm bg-gradient-{{ $commande->statut_couleur }} ms-2">
                                {{ $commande->statut_libelle }}
                            </span>
                        </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                        </a>
                        @if($commande->is_devis)
                            <a href="{{ route('orders.edit', $commande->id) }}" class="btn btn-outline-success btn-sm ms-2">
                                <i class="fas fa-calculator me-1"></i>Traiter le devis
                            </a>
                        @endif
                        <a href="{{ route('orders.pdf', $commande->id) }}" class="btn btn-outline-danger btn-sm ms-2" target="_blank">
                            <i class="fas fa-file-pdf me-1"></i>
                            @if($commande->is_devis)
                                Télécharger le devis
                            @else
                                Télécharger la facture
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Informations client -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h6>
                            <i class="fas fa-user text-primary me-2"></i>
                            Informations client
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Nom :</strong><br>
                            <span class="text-dark">{{ $commande->client->nom }}</span>
                        </div>
                        <div class="mb-3">
                            <strong>Email :</strong><br>
                            <a href="mailto:{{ $commande->client->email }}" class="text-primary">
                                {{ $commande->client->email }}
                            </a>
                        </div>
                        @if($commande->client->telephone)
                        <div class="mb-3">
                            <strong>Téléphone :</strong><br>
                            <a href="tel:{{ $commande->client->telephone }}" class="text-primary">
                                {{ $commande->client->telephone }}
                            </a>
                        </div>
                        @endif
                        @if($commande->client->entreprise)
                        <div class="mb-3">
                            <strong>Entreprise :</strong><br>
                            <span class="text-dark">{{ $commande->client->entreprise }}</span>
                        </div>
                        @endif
                        <div class="mb-3">
                            <strong>Adresse de livraison :</strong><br>
                            <span class="text-dark">{{ $commande->adresse_livraison }}</span><br>
                            <span class="text-dark">{{ $commande->ville }}</span>
                            @if($commande->code_postal)
                                <span class="text-dark">, {{ $commande->code_postal }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Détails de la commande -->
            <div class="col-lg-8 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h6>
                            <i class="fas fa-list text-primary me-2"></i>
                            Détails de la commande
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Date de commande :</strong><br>
                                    <span class="text-dark">{{ $commande->created_at->format('d/m/Y à H:i') }}</span>
                                </div>
                                <div class="mb-3">
                                    <strong>Total des articles :</strong><br>
                                    <span class="text-dark">{{ $commande->total_articles }} articles</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if($commande->date_livraison_souhaitee)
                                <div class="mb-3">
                                    <strong>Date de livraison souhaitée :</strong><br>
                                    <span class="text-dark">{{ $commande->date_livraison_souhaitee->format('d/m/Y') }}</span>
                                </div>
                                @endif
                                <div class="mb-3">
                                    <strong>Montant total :</strong><br>
                                    @if($commande->montant_total)
                                        <span class="text-success font-weight-bold">
                                            {{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA
                                        </span>
                                    @else
                                        <span class="text-warning">À définir</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Produits commandés -->
                        <h6 class="mb-3">
                            <i class="fas fa-shopping-basket text-primary me-2"></i>
                            Produits commandés
                        </h6>

                        <!-- Version optimisée pour écrans 13" -->
                        <div class="row">
                            @foreach($commande->produits as $index => $produit)
                            <div class="col-12 mb-3">
                                <div class="card border-0 bg-light product-card">
                                    <div class="card-body p-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-4">
                                                <div class="d-flex align-items-center">
                                                    @if(isset($produit['image']))
                                                    <img src="{{ asset($produit['image']) }}" alt="{{ $produit['nom'] }}"
                                                         class="me-3 product-image">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-1 font-weight-bold">{{ $produit['nom'] }}</h6>
                                                        <small class="text-muted">{{ $produit['variete'] }} - {{ $produit['conditionnement'] }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <span class="badge bg-primary fs-6 px-3 py-2">{{ $produit['quantite'] }}</span>
                                            </div>
                                            @if($commande->montant_total)
                                            <div class="col-md-3 text-center">
                                                <small class="text-muted d-block">Prix unitaire</small>
                                                @if(isset($produit['prix_unitaire']))
                                                    <strong class="text-success">{{ number_format($produit['prix_unitaire'], 0, ',', ' ') }} FCFA</strong>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <small class="text-muted d-block">Total ligne</small>
                                                @if(isset($produit['prix_unitaire']))
                                                    <strong class="text-primary">{{ number_format($produit['prix_unitaire'] * $produit['quantite'], 0, ',', ' ') }} FCFA</strong>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </div>
                                            @else
                                            <div class="col-md-6 text-center">
                                                <small class="text-warning">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Prix à définir
                                                </small>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @if($commande->commentaires)
                        <div class="mt-4">
                            <h6 class="mb-3">
                                <i class="fas fa-comment text-primary me-2"></i>
                                Commentaires du client
                            </h6>
                            <div class="alert alert-info">
                                <p class="mb-0">{{ $commande->commentaires }}</p>
                            </div>
                        </div>
                        @endif

                        @if($commande->notes_admin)
                        <div class="mt-4">
                            <h6 class="mb-3">
                                <i class="fas fa-sticky-note text-primary me-2"></i>
                                Notes administratives
                            </h6>
                            <div class="alert alert-light">
                                <p class="mb-0">{{ $commande->notes_admin }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour traiter le devis -->
@if($commande->is_devis)
<div class="modal fade" id="processDevisModal" tabindex="-1" aria-labelledby="processDevisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="processDevisModalLabel">
                    <i class="fas fa-calculator text-success me-2"></i>
                    Traiter le devis - {{ $commande->numero_commande }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('orders.update', $commande->id) }}" method="POST" id="devisForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">
                                <i class="fas fa-user me-2"></i>Informations client
                            </h6>
                            <div class="mb-2">
                                <strong>Nom:</strong> {{ $commande->client->nom }}
                            </div>
                            <div class="mb-2">
                                <strong>Email:</strong> {{ $commande->client->email }}
                            </div>
                            @if($commande->client->telephone)
                            <div class="mb-2">
                                <strong>Téléphone:</strong> {{ $commande->client->telephone }}
                            </div>
                            @endif
                            @if($commande->client->entreprise)
                            <div class="mb-2">
                                <strong>Entreprise:</strong> {{ $commande->client->entreprise }}
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>Adresse de livraison
                            </h6>
                            <div class="mb-2">
                                <strong>Adresse:</strong> {{ $commande->adresse_livraison }}
                            </div>
                            <div class="mb-2">
                                <strong>Ville:</strong> {{ $commande->ville }}
                            </div>
                            @if($commande->code_postal)
                            <div class="mb-2">
                                <strong>Code postal:</strong> {{ $commande->code_postal }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Prix par produit - Version optimisée -->
                    <h6 class="text-primary mb-3">
                        <i class="fas fa-shopping-cart me-2"></i>Fixer les prix par produit
                    </h6>

                    <div class="row" id="produitsTable">
                        @foreach($commande->produits as $index => $produit)
                        <div class="col-12 mb-3" data-index="{{ $index }}">
                            <div class="card border-0 bg-light product-card">
                                <div class="card-body p-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                @if(isset($produit['image']))
                                                <img src="{{ asset($produit['image']) }}" alt="{{ $produit['nom'] }}"
                                                     class="me-3 product-image">
                                                @endif
                                                <div>
                                                    <h6 class="mb-1 font-weight-bold">{{ $produit['nom'] }}</h6>
                                                    <small class="text-muted">{{ $produit['variete'] }} - {{ $produit['conditionnement'] }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <small class="text-muted d-block mb-1">Quantité</small>
                                            <span class="badge bg-primary fs-6 px-3 py-2">{{ $produit['quantite'] }}</span>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label text-muted mb-1">Prix unitaire (FCFA)</label>
                                            <input type="number"
                                                   class="form-control prix-unitaire price-input"
                                                   name="produits[{{ $index }}][prix_unitaire]"
                                                   data-quantite="{{ $produit['quantite'] }}"
                                                   step="0.01"
                                                   min="0"
                                                   placeholder="0.00">
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <small class="text-muted d-block mb-1">Total ligne</small>
                                            <span class="total-ligne font-weight-bold text-primary fs-6 total-display">0 FCFA</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <hr class="my-4">

                    <!-- Calculs totaux -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="statut" class="form-label">
                                    <i class="fas fa-flag text-warning me-1"></i>
                                    Nouveau statut
                                </label>
                                <select class="form-select" id="statut" name="statut" required>
                                    <option value="en_attente" {{ $commande->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="en_cours">En cours</option>
                                    <option value="livree">Livrée</option>
                                    <option value="annulee">Annulée</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="reduction" class="form-label">
                                    <i class="fas fa-percentage text-info me-1"></i>
                                    Réduction (%)
                                </label>
                                <input type="number" class="form-control" id="reduction" name="reduction"
                                       step="0.01" min="0" max="100" value="0" placeholder="0">
                            </div>
                        </div>
                    </div>

                    <!-- Résumé des totaux -->
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Sous-total:</span>
                                        <span id="sousTotal">0 FCFA</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Réduction:</span>
                                        <span id="montantReduction">0 FCFA</span>
                                    </div>
                                    <hr class="my-2">
                                    <div class="d-flex justify-content-between">
                                        <strong>Total:</strong>
                                        <strong id="totalFinal">0 FCFA</strong>
                                    </div>
                                    <input type="hidden" id="montant_total" name="montant_total" value="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="notes_admin" class="form-label">
                            <i class="fas fa-sticky-note text-info me-1"></i>
                            Notes administratives
                        </label>
                        <textarea class="form-control" id="notes_admin" name="notes_admin" rows="3"
                                  placeholder="Ajoutez des notes sur le traitement de ce devis...">{{ $commande->notes_admin }}</textarea>
                    </div>

                    @if($commande->commentaires)
                    <div class="alert alert-info">
                        <h6 class="alert-heading">
                            <i class="fas fa-comment me-2"></i>Commentaires du client
                        </h6>
                        <p class="mb-0">{{ $commande->commentaires }}</p>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-1"></i>Traiter le devis
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Calcul automatique des totaux
    function calculerTotaux() {
        let sousTotal = 0;

        // Calculer le sous-total
        document.querySelectorAll('.prix-unitaire').forEach(function(input) {
            const prix = parseFloat(input.value) || 0;
            const quantite = parseInt(input.dataset.quantite) || 0;
            const totalLigne = prix * quantite;

            // Mettre à jour l'affichage du total de la ligne
            const row = input.closest('tr');
            const totalLigneSpan = row.querySelector('.total-ligne');
            totalLigneSpan.textContent = new Intl.NumberFormat('fr-FR').format(totalLigne) + ' FCFA';

            sousTotal += totalLigne;
        });

        // Calculer la réduction
        const reduction = parseFloat(document.getElementById('reduction').value) || 0;
        const montantReduction = (sousTotal * reduction) / 100;
        const totalFinal = sousTotal - montantReduction;

        // Mettre à jour l'affichage
        document.getElementById('sousTotal').textContent = new Intl.NumberFormat('fr-FR').format(sousTotal) + ' FCFA';
        document.getElementById('montantReduction').textContent = new Intl.NumberFormat('fr-FR').format(montantReduction) + ' FCFA';
        document.getElementById('totalFinal').textContent = new Intl.NumberFormat('fr-FR').format(totalFinal) + ' FCFA';

        // Mettre à jour le champ caché
        document.getElementById('montant_total').value = totalFinal;
    }

    // Écouter les changements sur les prix unitaires
    document.querySelectorAll('.prix-unitaire').forEach(function(input) {
        input.addEventListener('input', calculerTotaux);
    });

    // Écouter les changements sur la réduction
    document.getElementById('reduction').addEventListener('input', calculerTotaux);

    // Initialiser les totaux
    calculerTotaux();
});
</script>
@endsection
