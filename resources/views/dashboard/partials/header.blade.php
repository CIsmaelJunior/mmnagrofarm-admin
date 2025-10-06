
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Accueil</a></li>
    @if(request()->routeIs('dashboard'))
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tableau de bord</li>
    @elseif(request()->routeIs('products*'))
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Produits</li>
    @elseif(request()->routeIs('orders*'))
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Commandes</li>
    @elseif(request()->routeIs('clients*'))
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Clients</li>
    @elseif(request()->routeIs('settings*'))
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Paramètres</li>
    @endif
    </ol>
    <h6 class="font-weight-bolder mb-0 d-flex align-items-center">
        <img src="{{ asset('adm/img/logos/logo.png') }}" alt="MMB Agro Farm" class="me-2" style="height: 24px;">
        @if(request()->routeIs('dashboard'))
            Tableau de bord
        @elseif(request()->routeIs('products*'))
            Gestion des Produits
        @elseif(request()->routeIs('orders*'))
            Gestion des Commandes
        @elseif(request()->routeIs('clients*'))
            Gestion des Clients
        @elseif(request()->routeIs('settings*'))
            Paramètres
        @else
            MMB AgroFarm Admin
        @endif
    </h6>
</nav>
<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
    <div class="input-group">
        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
        <input type="text" class="form-control" placeholder="Rechercher...">
    </div>
    </div>
    <ul class="navbar-nav  justify-content-end">
    <li class="nav-item dropdown pe-2 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="d-flex align-items-center">
                @if(Auth::user()->hasAvatar())
                    <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="avatar avatar-sm me-2" style="object-fit: cover;">
                @else
                    <div class="avatar avatar-sm bg-gradient-primary me-2">
                        <span class="text-white font-weight-bold">
                            {{ Auth::user()->initials }}
                        </span>
                    </div>
                @endif
                <div class="d-none d-sm-block">
                    <span class="text-body font-weight-bold">{{ Auth::user()->name }}</span>
                    <small class="text-muted d-block">{{ Auth::user()->role }}</small>
                </div>
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuUser">
            <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="{{ route('settings.profile') }}">
                    <div class="d-flex py-1">
                        <div class="my-auto">
                            <i class="fas fa-user text-primary me-3"></i>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-sm font-weight-normal mb-1">
                                Mon Profil
                            </h6>
                            <p class="text-xs text-secondary mb-0">
                                Gérer mes informations
                            </p>
                        </div>
                    </div>
                </a>
            </li>
            <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="{{ route('settings.index') }}">
                    <div class="d-flex py-1">
                        <div class="my-auto">
                            <i class="fas fa-cog text-warning me-3"></i>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-sm font-weight-normal mb-1">
                                Paramètres
                            </h6>
                            <p class="text-xs text-secondary mb-0">
                                Configuration du système
                            </p>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item border-radius-md text-danger">
                        <div class="d-flex py-1">
                            <div class="my-auto">
                                <i class="fas fa-sign-out-alt me-3"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                    Se déconnecter
                                </h6>
                                <p class="text-xs text-secondary mb-0">
                                    Quitter l'administration
                                </p>
                            </div>
                        </div>
                    </button>
                </form>
            </li>
        </ul>
    </li>
    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
        <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
        </div>
        </a>
    </li>
    <li class="nav-item dropdown pe-2 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-bell cursor-pointer"></i>
        </a>
        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
        <li class="mb-2">
            <a class="dropdown-item border-radius-md" href="{{ route('orders.index') }}">
            <div class="d-flex py-1">
                <div class="my-auto">
                <i class="fas fa-shopping-cart text-success me-3"></i>
                </div>
                <div class="d-flex flex-column justify-content-center">
                <h6 class="text-sm font-weight-normal mb-1">
                    <span class="font-weight-bold">Nouvelle commande</span> reçue
                </h6>
                <p class="text-xs text-secondary mb-0">
                    <i class="fa fa-clock me-1"></i>
                    13 minutes ago
                </p>
                </div>
            </div>
            </a>
        </li>
        <li class="mb-2">
            <a class="dropdown-item border-radius-md" href="{{ route('products.index') }}">
            <div class="d-flex py-1">
                <div class="my-auto">
                <i class="fas fa-box text-warning me-3"></i>
                </div>
                <div class="d-flex flex-column justify-content-center">
                <h6 class="text-sm font-weight-normal mb-1">
                    <span class="font-weight-bold">Stock faible</span> sur un produit
                </h6>
                <p class="text-xs text-secondary mb-0">
                    <i class="fa fa-clock me-1"></i>
                    1 jour
                </p>
                </div>
            </div>
            </a>
        </li>
        <li>
            <a class="dropdown-item border-radius-md" href="{{ route('clients.index') }}">
            <div class="d-flex py-1">
                <div class="avatar avatar-sm bg-gradient-success me-3 my-auto">
                <i class="fas fa-user-plus text-white"></i>
                </div>
                <div class="d-flex flex-column justify-content-center">
                <h6 class="text-sm font-weight-normal mb-1">
                    Nouveau client enregistré
                </h6>
                <p class="text-xs text-secondary mb-0">
                    <i class="fa fa-clock me-1"></i>
                    2 jours
                </p>
                </div>
            </div>
            </a>
        </li>
        </ul>
    </li>
    </ul>
</div>
