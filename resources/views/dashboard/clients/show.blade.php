@extends('dashboard.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Détails du Client</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-user text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">{{ $client->nom }}</span>
                        </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="{{ route('clients.index') }}" class="btn btn-secondary btn-sm me-2">
                            <i class="fas fa-arrow-left me-1"></i>Retour
                        </a>
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-1"></i>Modifier
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

                <div class="row mx-3">
                    <!-- Informations personnelles -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                                <h6 class="mb-0">
                                    <i class="fas fa-user me-2"></i>Informations Personnelles
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label text-sm font-weight-bold">Nom complet</label>
                                        <p class="text-sm">{{ $client->nom }}</p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label text-sm font-weight-bold">Email</label>
                                        <p class="text-sm">
                                            <a href="mailto:{{ $client->email }}" class="text-info">{{ $client->email }}</a>
                                        </p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label text-sm font-weight-bold">Téléphone</label>
                                        <p class="text-sm">
                                            @if($client->telephone)
                                                <a href="tel:{{ $client->telephone }}" class="text-info">{{ $client->telephone }}</a>
                                            @else
                                                <span class="text-secondary">Non renseigné</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label text-sm font-weight-bold">Entreprise</label>
                                        <p class="text-sm">
                                            @if($client->entreprise)
                                                {{ $client->entreprise }}
                                            @else
                                                <span class="text-secondary">Particulier</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-sm font-weight-bold">Statut</label>
                                        <p class="text-sm">
                                            @if($client->actif)
                                                <span class="badge badge-sm bg-gradient-success">Actif</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">Inactif</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations de livraison -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                                <h6 class="mb-0">
                                    <i class="fas fa-map-marker-alt me-2"></i>Adresse de Livraison
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label text-sm font-weight-bold">Adresse</label>
                                        <p class="text-sm">
                                            @if($client->adresse_livraison)
                                                {{ $client->adresse_livraison }}
                                            @else
                                                <span class="text-secondary">Non renseignée</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label text-sm font-weight-bold">Ville</label>
                                        <p class="text-sm">
                                            @if($client->ville)
                                                {{ $client->ville }}
                                            @else
                                                <span class="text-secondary">Non renseignée</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label text-sm font-weight-bold">Code postal</label>
                                        <p class="text-sm">
                                            @if($client->code_postal)
                                                {{ $client->code_postal }}
                                            @else
                                                <span class="text-secondary">Non renseigné</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-sm font-weight-bold">Notes</label>
                                        <p class="text-sm">
                                            @if($client->notes)
                                                {{ $client->notes }}
                                            @else
                                                <span class="text-secondary">Aucune note</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Historique des commandes -->
                <div class="row mx-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h6 class="mb-0">
                                    <i class="fas fa-shopping-cart me-2"></i>Historique des Commandes
                                    <span class="badge badge-sm bg-gradient-info ms-2">{{ $client->commandes->count() }} commande(s)</span>
                                </h6>
                            </div>
                            <div class="card-body px-0 pb-2">
                                @if($client->commandes->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Commande</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produits</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Montant</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Statut</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($client->commandes as $commande)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $commande->numero_commande }}</h6>
                                                                <p class="text-xs text-secondary mb-0">{{ $commande->ville }}</p>
                                                            </div>
                                                        </div>
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
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('orders.show', $commande->id) }}" class="btn btn-outline-info btn-sm px-2 py-1" data-bs-toggle="tooltip" title="Voir les détails">
                                                                <i class="fas fa-eye text-xs"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-shopping-cart text-secondary mb-2" style="font-size: 2rem;"></i>
                                            <h6 class="text-secondary">Aucune commande</h6>
                                            <p class="text-xs text-secondary mb-0">Ce client n'a pas encore passé de commande</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
