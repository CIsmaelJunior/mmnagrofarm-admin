@extends('dashboard.layouts.master')

@section('content')
<!-- Statistiques principales -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Chiffre d'affaire</p>
                    <h5 class="font-weight-bolder mb-0">
                                {{ number_format($chiffre_affaires, 0, ',', ' ') }} FCFA
                                @if($commandes_stats['livree'] > 0)
                                    <span class="text-success text-sm font-weight-bolder">+{{ $commandes_stats['livree'] }} livraisons</span>
                                @endif
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                            <i class="fas fa-chart-line text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Commandes totales</p>
                    <h5 class="font-weight-bolder mb-0">
                                {{ $stats['total_commandes'] }}
                                @if($commandes_mois > 0)
                                    <span class="text-info text-sm font-weight-bolder">+{{ $commandes_mois }} ce mois</span>
                                @endif
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                            <i class="fas fa-shopping-cart text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Clients actifs</p>
                    <h5 class="font-weight-bolder mb-0">
                                {{ $stats['total_clients'] }}
                                @if($clients_mois > 0)
                                    <span class="text-warning text-sm font-weight-bolder">+{{ $clients_mois }} nouveaux</span>
                                @endif
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                            <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Produits</p>
                    <h5 class="font-weight-bolder mb-0">
                                {{ $stats['total_produits'] }}
                                <span class="text-primary text-sm font-weight-bolder">en catalogue</span>
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
        </div>
<!-- Statistiques des commandes par statut -->
    <div class="row mt-4">
    <div class="col-lg-8 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
            <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Statut des Commandes</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-shopping-cart text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">Répartition par statut</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-sm bg-gradient-warning shadow text-center border-radius-md me-3">
                                <i class="fas fa-clock text-xs opacity-10"></i>
                            </div>
                            <div>
                                <p class="text-xs font-weight-bold mb-0">En Attente</p>
                                <h6 class="text-sm mb-0">{{ $commandes_stats['en_attente'] }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-sm bg-gradient-info shadow text-center border-radius-md me-3">
                                <i class="fas fa-truck text-xs opacity-10"></i>
                            </div>
                            <div>
                                <p class="text-xs font-weight-bold mb-0">En Cours</p>
                                <h6 class="text-sm mb-0">{{ $commandes_stats['en_cours'] }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-sm bg-gradient-success shadow text-center border-radius-md me-3">
                                <i class="fas fa-check-circle text-xs opacity-10"></i>
                            </div>
                            <div>
                                <p class="text-xs font-weight-bold mb-0">Livrées</p>
                                <h6 class="text-sm mb-0">{{ $commandes_stats['livree'] }}</h6>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header pb-0">
                <h6>Actions Rapides</h6>
            </div>
            <div class="card-body p-3">
                <div class="d-grid gap-2">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-seedling me-2"></i>Gérer les Produits
                    </a>
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-shopping-cart me-2"></i>Voir les Commandes
                    </a>
                    <a href="{{ route('clients.index') }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-users me-2"></i>Gérer les Clients
                    </a>
                    <a href="{{ route('settings.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-cog me-2"></i>Paramètres
                    </a>
            </div>
        </div>
        </div>
    </div>
    </div>
<!-- Commandes récentes et clients récents -->
    <div class="row mt-4">
    <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Commandes Récentes</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-shopping-cart text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">5 dernières commandes</span>
                        </p>
            </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary btn-sm">
                            Voir tout
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                @if($commandes_recentes->count() > 0)
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Commande</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Client</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Statut</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commandes_recentes as $commande)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $commande->numero_commande }}</h6>
                </div>
                </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $commande->client->nom }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $commande->client->email }}</p>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-{{ $commande->statut_couleur }}">
                                            {{ $commande->statut_libelle }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">{{ $commande->created_at->format('d/m/Y') }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-shopping-cart text-secondary mb-2" style="font-size: 2rem;"></i>
                        <h6 class="text-secondary">Aucune commande récente</h6>
                    </div>
                @endif
                </div>
                </div>
                </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Clients Récents</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-users text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">5 derniers clients</span>
                        </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="{{ route('clients.index') }}" class="btn btn-outline-primary btn-sm">
                            Voir tout
                        </a>
                </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                @if($clients_recents->count() > 0)
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Client</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Statut</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients_recents as $client)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $client->nom }}</h6>
                                                @if($client->entreprise)
                                                    <p class="text-xs text-info mb-0">{{ $client->entreprise }}</p>
                                                @endif
            </div>
        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="text-xs text-secondary mb-0">{{ $client->email }}</p>
                                            @if($client->telephone)
                                                <p class="text-xs text-secondary mb-0">{{ $client->telephone }}</p>
                                            @endif
        </div>
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
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-users text-secondary mb-2" style="font-size: 2rem;"></i>
                        <h6 class="text-secondary">Aucun client récent</h6>
        </div>
                @endif
        </div>
        </div>
    </div>
    </div>
<!-- Produits populaires -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Produits Populaires</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-seedling text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">Nos produits phares</span>
                        </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">
                            Voir tout
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                @if($produits_populaires->count() > 0)
                    <div class="row mx-3">
                        @foreach($produits_populaires as $produit)
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center p-2">
                                    <div class="position-relative mb-2">
                                        <img src="{{ asset($produit->image) }}" alt="{{ $produit->nom }}"
                                             class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;">
                                    </div>
                                    <h6 class="text-sm font-weight-bold mb-1">{{ $produit->nom }}</h6>
                                    <p class="text-xs text-secondary mb-1">{{ $produit->variete }}</p>
                                    <p class="text-xs text-info mb-0">{{ $produit->origine }}</p>
                                    <div class="mt-2">
                                        <a href="{{ route('products.show', $produit->slug) }}" class="btn btn-outline-primary btn-xs">
                                            Voir
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-seedling text-secondary mb-2" style="font-size: 2rem;"></i>
                        <h6 class="text-secondary">Aucun produit disponible</h6>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
