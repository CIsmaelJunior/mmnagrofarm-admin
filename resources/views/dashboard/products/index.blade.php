@extends('dashboard.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Produits</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-seedling text-success" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">{{ $produits->count() }} produits</span> disponibles
                        </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="dropdown float-lg-end pe-4">
                            <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-secondary"></i>
                            </a>
                            <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                <li><a class="dropdown-item border-radius-md" href="{{ route('products.create') }}">Ajouter un produit</a></li>
                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Exporter</a></li>
                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Importer</a></li>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produit</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Variété</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Origine</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Conditionnement</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produits as $produit)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{ $produit->image }}" class="me-3" alt="{{ $produit->nom }}" style="width: 80px; height: 80px; object-fit: contain; border-radius: 8px;" onerror="this.src='../assets/img/small-logos/logo-spotify.svg'">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $produit->nom }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $produit->variete }}</h6>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold">{{ $produit->origine }}</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <div class="d-flex flex-wrap justify-content-center gap-1">
                                        @foreach($produit->conditionnement as $conditionnement)
                                            <span class="badge badge-sm bg-gradient-info">{{ $conditionnement }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('products.show', $produit->slug) }}" class="btn btn-outline-info btn-sm px-2 py-1" data-bs-toggle="tooltip" title="Voir les détails">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                        <a href="{{ route('products.edit', $produit->slug) }}" class="btn btn-outline-warning btn-sm px-2 py-1" data-bs-toggle="tooltip" title="Modifier">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm px-2 py-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $produit->id }}" title="Supprimer">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-seedling text-secondary mb-2" style="font-size: 2rem;"></i>
                                        <h6 class="text-secondary">Aucun produit trouvé</h6>
                                        <p class="text-xs text-secondary mb-0">Commencez par ajouter votre premier produit</p>
                                        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm mt-2">
                                            <i class="fas fa-plus me-1"></i>Ajouter un produit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistiques des produits -->
<div class="row mt-4">
    <div class="col-lg-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Produits</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $produits->count() }}
                                <span class="text-success text-sm font-weight-bolder">+{{ rand(5, 15) }}%</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="fas fa-seedling text-lg opacity-10" aria-hidden="true"></i>
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
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">En Stock</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $produits->where('saison', 'like', '%Toute l\'année%')->count() }}
                                <span class="text-info text-sm font-weight-bolder">Disponible</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                            <i class="fas fa-box text-lg opacity-10" aria-hidden="true"></i>
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
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Prix Moyen</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ number_format($produits->avg('prix'), 0, ',', ' ') }} FCFA
                                <span class="text-warning text-sm font-weight-bolder">Par kg</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                            <i class="fas fa-chart-line text-lg opacity-10" aria-hidden="true"></i>
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
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Variétés</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $produits->unique('nom')->count() }}
                                <span class="text-primary text-sm font-weight-bolder">Types</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                            <i class="fas fa-leaf text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals de confirmation de suppression -->
@foreach($produits as $produit)
<div class="modal fade" id="deleteModal{{ $produit->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $produit->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $produit->id }}">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                    Confirmer la suppression
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ $produit->image }}" class="me-3" alt="{{ $produit->nom }}" style="width: 60px; height: 60px; object-fit: contain; border-radius: 8px;" onerror="this.src='../assets/img/small-logos/logo-spotify.svg'">
                    <div>
                        <h6 class="mb-1">{{ $produit->nom }} - {{ $produit->variete }}</h6>
                        <p class="text-sm text-muted mb-0">{{ $produit->origine }}</p>
                    </div>
                </div>
                <p class="mb-0">Êtes-vous sûr de vouloir supprimer ce produit ? Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Annuler
                </button>
                <form action="{{ route('products.destroy', $produit->slug) }}" method="POST" class="d-inline">
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
@endsection
