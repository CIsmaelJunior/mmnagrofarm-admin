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
</style>
<!-- Statistiques des clients -->
<div class="row mb-4">
    <div class="col-lg-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Clients</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $clients->total() }}
                                <span class="text-success text-sm font-weight-bolder">+{{ rand(3, 12) }}%</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
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
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Clients Actifs</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $clients->where('actif', true)->count() }}
                                <span class="text-success text-sm font-weight-bolder">Actifs</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                            <i class="fas fa-user-check text-lg opacity-10" aria-hidden="true"></i>
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
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Nouveaux ce mois</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $clients->where('created_at', '>=', now()->startOfMonth())->count() }}
                                <span class="text-info text-sm font-weight-bolder">Ce mois</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                            <i class="fas fa-user-plus text-lg opacity-10" aria-hidden="true"></i>
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
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Avec Commandes</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $clients->where('commandes_count', '>', 0)->count() }}
                                <span class="text-warning text-sm font-weight-bolder">Acheteurs</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                            <i class="fas fa-shopping-cart text-lg opacity-10" aria-hidden="true"></i>
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
                        <h6>Clients</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-users text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">{{ $clients->total() }} clients</span> au total
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
                        <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i>Nouveau Client
                        </a>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Client</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Entreprise</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Commandes</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Statut</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $client)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $client->nom }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $client->ville ?? 'Non renseigné' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $client->email }}</h6>
                                        @if($client->telephone)
                                            <p class="text-xs text-secondary mb-0">{{ $client->telephone }}</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($client->entreprise)
                                        <span class="text-xs font-weight-bold">{{ $client->entreprise }}</span>
                                    @else
                                        <span class="text-xs text-secondary">Particulier</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold">{{ $client->commandes_count }} commande(s)</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($client->actif)
                                        <span class="badge badge-sm bg-gradient-success">Actif</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-secondary">Inactif</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold">{{ $client->created_at->format('d/m/Y') }}</span>
                                    <br>
                                    <small class="text-secondary">{{ $client->created_at->format('H:i') }}</small>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center actions-buttons flex-wrap">
                                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-outline-info btn-sm px-3 py-1" data-bs-toggle="tooltip" title="Voir les détails du client">
                                            <i class="fas fa-eye me-1"></i>
                                            <span class="d-none d-md-inline">Voir</span>
                                        </a>
                                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-outline-warning btn-sm px-3 py-1" data-bs-toggle="tooltip" title="Modifier les informations du client">
                                            <i class="fas fa-edit me-1"></i>
                                            <span class="d-none d-md-inline">Modifier</span>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm px-3 py-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $client->id }}" title="Supprimer le client">
                                            <i class="fas fa-trash me-1"></i>
                                            <span class="d-none d-md-inline">Supprimer</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-users text-secondary mb-2" style="font-size: 2rem;"></i>
                                        <h6 class="text-secondary">Aucun client trouvé</h6>
                                        <p class="text-xs text-secondary mb-0">Les nouveaux clients apparaîtront ici</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($clients->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $clients->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modals de confirmation de suppression -->
@foreach($clients as $client)
<div class="modal fade" id="deleteModal{{ $client->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $client->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $client->id }}">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                    Confirmer la suppression
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="me-3">
                        <i class="fas fa-user text-4xl text-secondary"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">{{ $client->nom }}</h6>
                        <p class="text-sm text-muted mb-0">{{ $client->email }}</p>
                        @if($client->entreprise)
                            <p class="text-sm text-info mb-0">{{ $client->entreprise }}</p>
                        @endif
                    </div>
                </div>
                <p class="mb-0">Êtes-vous sûr de vouloir supprimer ce client ? Cette action est irréversible.</p>
                @if($client->commandes_count > 0)
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Attention :</strong> Ce client a {{ $client->commandes_count }} commande(s). Les commandes ne seront pas supprimées.
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Annuler
                </button>
                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
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
