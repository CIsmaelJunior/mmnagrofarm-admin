@extends('dashboard.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Paramètres</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-cog text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">Configuration de l'application</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="row mx-3">
                    <!-- Profil utilisateur -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg mb-3">
                                    <i class="fas fa-user text-lg opacity-10"></i>
                                </div>
                                <h6 class="mb-3">Profil Utilisateur</h6>
                                <p class="text-sm text-secondary mb-4">
                                    Gérez vos informations personnelles, photo de profil et préférences de compte.
                                </p>
                                <a href="{{ route('settings.profile') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-edit me-1"></i>Modifier le profil
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Paramètres système -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <div class="icon icon-shape icon-lg bg-gradient-info shadow text-center border-radius-lg mb-3">
                                    <i class="fas fa-cogs text-lg opacity-10"></i>
                                </div>
                                <h6 class="mb-3">Paramètres Système</h6>
                                <p class="text-sm text-secondary mb-4">
                                    Configurez les paramètres généraux de l'application, logo, informations de contact.
                                </p>
                                <a href="{{ route('settings.system') }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-cog me-1"></i>Configuration
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <div class="icon icon-shape icon-lg bg-gradient-warning shadow text-center border-radius-lg mb-3">
                                    <i class="fas fa-bell text-lg opacity-10"></i>
                                </div>
                                <h6 class="mb-3">Notifications</h6>
                                <p class="text-sm text-secondary mb-4">
                                    Configurez vos préférences de notification par email et SMS.
                                </p>
                                <a href="{{ route('settings.notifications') }}" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-bell me-1"></i>Notifications
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations système -->
                <div class="row mx-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h6 class="mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Informations Système
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="icon icon-shape icon-sm bg-gradient-primary shadow text-center border-radius-md me-3">
                                                <i class="fas fa-server text-xs opacity-10"></i>
                                            </div>
                                            <div>
                                                <p class="text-xs font-weight-bold mb-0">Version PHP</p>
                                                <h6 class="text-sm mb-0">{{ PHP_VERSION }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="icon icon-shape icon-sm bg-gradient-success shadow text-center border-radius-md me-3">
                                                <i class="fas fa-database text-xs opacity-10"></i>
                                            </div>
                                            <div>
                                                <p class="text-xs font-weight-bold mb-0">Base de données</p>
                                                <h6 class="text-sm mb-0">MySQL</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="icon icon-shape icon-sm bg-gradient-info shadow text-center border-radius-md me-3">
                                                <i class="fas fa-code text-xs opacity-10"></i>
                                            </div>
                                            <div>
                                                <p class="text-xs font-weight-bold mb-0">Framework</p>
                                                <h6 class="text-sm mb-0">Laravel {{ app()->version() }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="icon icon-shape icon-sm bg-gradient-warning shadow text-center border-radius-md me-3">
                                                <i class="fas fa-clock text-xs opacity-10"></i>
                                            </div>
                                            <div>
                                                <p class="text-xs font-weight-bold mb-0">Dernière mise à jour</p>
                                                <h6 class="text-sm mb-0">{{ now()->format('d/m/Y') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistiques rapides -->
                <div class="row mx-3 mt-4">
                    <div class="col-lg-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Produits</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{ \App\Models\Produit::count() }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
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
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Clients</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{ \App\Models\Client::count() }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
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
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Commandes</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{ \App\Models\Commande::count() }}
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
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Utilisateurs</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{ \App\Models\User::count() }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                                            <i class="fas fa-user-shield text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

