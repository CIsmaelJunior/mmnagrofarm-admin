@extends('dashboard.layouts.master')

@section('content')
<style>
/* Optimisations pour écrans 13" */
@media (max-width: 1400px) {
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
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #f8f9fa;
}

.price-input {
    font-weight: 600;
    text-align: center;
}

.total-display {
    font-size: 1.1rem;
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

/* Styles pour les calculs */
.calculation-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 12px;
    padding: 1.5rem;
    margin: 1rem 0;
}

.calculation-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #dee2e6;
}

.calculation-row:last-child {
    border-bottom: none;
    font-weight: bold;
    font-size: 1.1rem;
    color: #28a745;
}
</style>

<div class="row">
    <div class="col-12">
        <!-- En-tête de la page -->
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">
                            <i class="fas fa-calculator text-success me-2"></i>
                            Traiter le devis - {{ $commande->numero_commande }}
                        </h6>
                        <p class="text-sm mb-0 text-muted">
                            Fixez les prix pour chaque produit et traitez cette demande de devis
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('orders.show', $commande->id) }}" class="btn btn-secondary btn-sm me-2">
                            <i class="fas fa-arrow-left me-1"></i> Retour aux détails
                        </a>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-list me-1"></i> Liste des commandes
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('orders.update', $commande->id) }}" method="POST" id="devisForm">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Informations client -->
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-user text-primary me-2"></i>
                                Informations client
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Nom:</strong><br>
                                <span class="text-dark">{{ $commande->client->nom }}</span>
                            </div>
                            <div class="mb-3">
                                <strong>Email:</strong><br>
                                <span class="text-dark">{{ $commande->client->email }}</span>
                            </div>
                            @if($commande->client->telephone)
                            <div class="mb-3">
                                <strong>Téléphone:</strong><br>
                                <span class="text-dark">{{ $commande->client->telephone }}</span>
                            </div>
                            @endif
                            @if($commande->client->entreprise)
                            <div class="mb-3">
                                <strong>Entreprise:</strong><br>
                                <span class="text-dark">{{ $commande->client->entreprise }}</span>
                            </div>
                            @endif
                            <div class="mb-3">
                                <strong>Adresse de livraison:</strong><br>
                                <span class="text-dark">
                                    {{ $commande->adresse_livraison }}<br>
                                    {{ $commande->ville }} @if($commande->code_postal) ({{ $commande->code_postal }}) @endif
                                </span>
                            </div>
                            @if($commande->date_livraison_souhaitee)
                            <div class="mb-3">
                                <strong>Date de livraison souhaitée:</strong><br>
                                <span class="text-dark">{{ $commande->date_livraison_souhaitee->format('d/m/Y') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Produits et prix -->
                <div class="col-lg-8 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-shopping-cart text-primary me-2"></i>
                                Produits demandés - Fixer les prix
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
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
                                                           placeholder="0.00"
                                                           required>
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
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section calculs et paramètres -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-calculator text-success me-2"></i>
                                Calculs et paramètres
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="calculation-section">
                                <div class="calculation-row">
                                    <span>Sous-total:</span>
                                    <span id="sousTotal">0 FCFA</span>
                                </div>
                                <div class="calculation-row">
                                    <span>Réduction:</span>
                                    <div class="d-flex align-items-center">
                                        <input type="number"
                                               class="form-control form-control-sm me-2"
                                               id="reduction"
                                               name="reduction"
                                               step="0.01"
                                               min="0"
                                               max="100"
                                               value="0"
                                               placeholder="0"
                                               style="width: 80px;">
                                        <span>%</span>
                                    </div>
                                </div>
                                <div class="calculation-row">
                                    <span>Montant de la réduction:</span>
                                    <span id="montantReduction">0 FCFA</span>
                                </div>
                                <div class="calculation-row">
                                    <span><strong>Total final:</strong></span>
                                    <span id="totalFinal"><strong>0 FCFA</strong></span>
                                </div>
                            </div>

                            <input type="hidden" id="montant_total" name="montant_total" value="0">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-cog text-warning me-2"></i>
                                Paramètres de traitement
                            </h6>
                        </div>
                        <div class="card-body">
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

                            <div class="mb-3">
                                <label for="notes_admin" class="form-label">
                                    <i class="fas fa-sticky-note text-info me-1"></i>
                                    Notes administratives
                                </label>
                                <textarea class="form-control" id="notes_admin" name="notes_admin" rows="4"
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
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Prêt à traiter ce devis ?</h6>
                                    <p class="text-sm text-muted mb-0">Vérifiez tous les prix avant de valider</p>
                                </div>
                                <div>
                                    <a href="{{ route('orders.show', $commande->id) }}" class="btn btn-secondary me-2">
                                        <i class="fas fa-times me-1"></i>Annuler
                                    </a>
                                    <a href="{{ route('orders.pdf', $commande->id) }}" class="btn btn-outline-danger me-2" target="_blank">
                                        <i class="fas fa-file-pdf me-1"></i>Télécharger le devis
                                    </a>
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-check me-1"></i>Traiter le devis
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

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
            const row = input.closest('.col-12');
            const totalLigneSpan = row.querySelector('.total-ligne');
            if (totalLigneSpan) {
                totalLigneSpan.textContent = new Intl.NumberFormat('fr-FR').format(totalLigne) + ' FCFA';
            }

            sousTotal += totalLigne;
        });

        // Calculer la réduction
        const reductionInput = document.getElementById('reduction');
        const reduction = parseFloat(reductionInput.value) || 0;
        const montantReduction = (sousTotal * reduction) / 100;
        const totalFinal = sousTotal - montantReduction;

        // Mettre à jour l'affichage
        document.getElementById('sousTotal').textContent = new Intl.NumberFormat('fr-FR').format(sousTotal) + ' FCFA';
        document.getElementById('montantReduction').textContent = new Intl.NumberFormat('fr-FR').format(montantReduction) + ' FCFA';
        document.getElementById('totalFinal').innerHTML = '<strong>' + new Intl.NumberFormat('fr-FR').format(totalFinal) + ' FCFA</strong>';

        // Mettre à jour le champ caché
        document.getElementById('montant_total').value = totalFinal;
    }

    // Écouter les changements sur tous les prix unitaires
    document.querySelectorAll('.prix-unitaire').forEach(function(input) {
        input.addEventListener('input', calculerTotaux);
    });

    // Écouter les changements sur la réduction
    document.getElementById('reduction').addEventListener('input', calculerTotaux);

    // Validation du formulaire
    document.getElementById('devisForm').addEventListener('submit', function(e) {
        const prixInputs = document.querySelectorAll('.prix-unitaire');
        let hasValidPrices = false;

        prixInputs.forEach(function(input) {
            if (parseFloat(input.value) > 0) {
                hasValidPrices = true;
            }
        });

        if (!hasValidPrices) {
            e.preventDefault();
            alert('Veuillez saisir au moins un prix unitaire supérieur à 0.');
            return false;
        }

        const totalFinal = parseFloat(document.getElementById('montant_total').value);
        if (totalFinal <= 0) {
            e.preventDefault();
            alert('Le montant total doit être supérieur à 0.');
            return false;
        }
    });

    // Calcul initial
    calculerTotaux();
});
</script>
@endsection
