@extends('dashboard.layouts.master')

@section('content')
<style>
/* Amélioration des boutons d'actions */
.actions-buttons {
    gap: 0.25rem;
}

.actions-buttons .btn {
    font-size: 0.75rem;
    min-width: 60px;
}

.actions-buttons .btn i {
    font-size: 0.7rem;
}

/* Responsive pour les boutons */
@media (max-width: 768px) {
    .actions-buttons .btn span {
        display: none !important;
    }

    .actions-buttons .btn {
        min-width: 35px;
        padding: 0.25rem 0.5rem;
    }
}

/* Amélioration du modal */
.modal-lg {
    max-width: 800px;
}

.product-item {
    transition: all 0.2s ease;
}

.product-item:hover {
    background-color: #f8f9fa !important;
    transform: translateY(-1px);
}
</style>
<!-- Statistiques des commandes -->
<div class="row mb-4">
    <div class="col-lg-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Commandes</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $commandes->total() }}
                                <span class="text-success text-sm font-weight-bolder">+{{ rand(5, 15) }}%</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="fas fa-shopping-cart text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">En Attente</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $commandes->where('statut', 'en_attente')->count() }}
                                <span class="text-warning text-sm font-weight-bolder">À traiter</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                            <i class="fas fa-clock text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">En Cours</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $commandes->where('statut', 'en_cours')->count() }}
                                <span class="text-info text-sm font-weight-bolder">En préparation</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                            <i class="fas fa-truck text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Livrées</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $commandes->where('statut', 'livree')->count() }}
                                <span class="text-success text-sm font-weight-bolder">Terminées</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                            <i class="fas fa-check-circle text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Commandes</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-shopping-cart text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">{{ $commandes->total() }} commandes</span> au total
                        </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="dropdown float-lg-end pe-4">
                            <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-secondary"></i>
                            </a>
                            <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Exporter</a></li>
                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Filtrer par statut</a></li>
                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Voir les statistiques</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Commande</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Client</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produits</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Montant</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Statut</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($commandes as $commande)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $commande->numero_commande }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $commande->ville }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $commande->client->nom }}</h6>
                                        <p class="text-xs text-secondary mb-0">{{ $commande->client->email }}</p>
                                        @if($commande->client->entreprise)
                                            <p class="text-xs text-info mb-0">{{ $commande->client->entreprise }}</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-{{ $commande->type_couleur }}">
                                        {{ $commande->type_commande }}
                                    </span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold">{{ $commande->total_articles }} articles</span>
                                    <br>
                                    <small class="text-secondary">{{ count($commande->produits) }} produits</small>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($commande->montant_total)
                                        <span class="text-xs font-weight-bold">{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</span>
                                    @else
                                        <span class="text-xs text-secondary">À définir</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-{{ $commande->statut_couleur }}">
                                        {{ $commande->statut_libelle }}
                                    </span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold">{{ $commande->created_at->format('d/m/Y') }}</span>
                                    <br>
                                    <small class="text-secondary">{{ $commande->created_at->format('H:i') }}</small>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center actions-buttons flex-wrap">
                                        <a href="{{ route('orders.show', $commande->id) }}" class="btn btn-outline-info btn-sm px-3 py-1" data-bs-toggle="tooltip" title="Voir les détails de la commande">
                                            <i class="fas fa-eye me-1"></i>
                                            <span class="d-none d-md-inline">Voir</span>
                                        </a>
                                        @if($commande->is_devis)
                                            <a href="{{ route('orders.edit', $commande->id) }}" class="btn btn-outline-success btn-sm px-3 py-1" data-bs-toggle="tooltip" title="Traiter le devis et fixer le prix">
                                                <i class="fas fa-calculator me-1"></i>
                                                <span class="d-none d-md-inline">Traiter</span>
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-outline-warning btn-sm px-3 py-1" data-bs-toggle="tooltip" title="Modifier le statut de la commande" data-bs-toggle="modal" data-bs-target="#statusModal{{ $commande->id }}">
                                                <i class="fas fa-edit me-1"></i>
                                                <span class="d-none d-md-inline">Modifier</span>
                                            </button>
                                        @endif
                                        <a href="{{ route('orders.pdf', $commande->id) }}" class="btn btn-outline-danger btn-sm px-3 py-1" target="_blank" data-bs-toggle="tooltip" title="Télécharger le PDF">
                                            <i class="fas fa-file-pdf me-1"></i>
                                            <span class="d-none d-md-inline">PDF</span>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm px-3 py-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $commande->id }}" title="Supprimer la commande">
                                            <i class="fas fa-trash me-1"></i>
                                            <span class="d-none d-md-inline">Supprimer</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-shopping-cart text-secondary mb-2" style="font-size: 2rem;"></i>
                                        <h6 class="text-secondary">Aucune commande trouvée</h6>
                                        <p class="text-xs text-secondary mb-0">Les nouvelles commandes apparaîtront ici</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($commandes->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $commandes->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


<!-- Modals de confirmation de suppression -->
@foreach($commandes as $commande)
<div class="modal fade" id="deleteModal{{ $commande->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $commande->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $commande->id }}">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                    Confirmer la suppression
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="me-3">
                        <i class="fas fa-shopping-cart text-4xl text-secondary"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">{{ $commande->numero_commande }}</h6>
                        <p class="text-sm text-muted mb-0">{{ $commande->client->nom }} - {{ $commande->client->email }}</p>
                    </div>
                </div>
                <p class="mb-0">Êtes-vous sûr de vouloir supprimer cette commande ? Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Annuler
                </button>
                <form action="{{ route('orders.destroy', $commande->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


<script>
// Initialiser les tooltips Bootstrap
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser tous les tooltips (Bootstrap 5)
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection
