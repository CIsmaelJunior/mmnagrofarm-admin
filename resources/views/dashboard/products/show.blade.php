@extends('dashboard.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Détails du produit</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-seedling text-success" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">{{ $produit->nom }} - {{ $produit->variete }}</span>
                        </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                            <i class="fas fa-arrow-left me-1"></i>Retour
                        </a>
                        <a href="{{ route('products.edit', $produit->slug) }}" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-edit me-1"></i>Modifier
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <!-- Image du produit -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <img src="{{ $produit->image }}" class="img-fluid rounded" alt="{{ $produit->nom }}" style="max-height: 300px; width: 100%; object-fit: cover;" onerror="this.src='../assets/img/small-logos/logo-spotify.svg'">
                            </div>
                        </div>
                    </div>

                    <!-- Informations principales -->
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <!-- Informations de base -->
                            <div class="col-12 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Informations générales</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="text-sm mb-1"><strong>Nom :</strong> {{ $produit->nom }}</p>
                                                <p class="text-sm mb-1"><strong>Variété :</strong> {{ $produit->variete }}</p>
                                                <p class="text-sm mb-1"><strong>Origine :</strong> {{ $produit->origine }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-sm mb-1"><strong>Saison :</strong> {{ $produit->saison }}</p>
                                                @if($produit->prix)
                                                <p class="text-sm mb-1"><strong>Prix :</strong> {{ number_format($produit->prix, 0, ',', ' ') }} FCFA</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-12 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Description</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-sm">{{ $produit->description }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Conditionnement -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Conditionnement</h6>
                                    </div>
                                    <div class="card-body">
                                        @foreach($produit->conditionnement as $conditionnement)
                                            <span class="badge bg-gradient-info me-2 mb-2">{{ $conditionnement }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Usage -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Usage</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-sm">{{ $produit->usage }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Goût -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Goût</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-sm">{{ $produit->gout }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Conservation -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Conservation</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-sm">{{ $produit->conservation }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Bienfaits -->
                            <div class="col-12 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Bienfaits nutritionnels</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled">
                                            @foreach($produit->bienfaits as $bienfait)
                                                <li class="mb-2">
                                                    <i class="fas fa-check text-success me-2"></i>
                                                    <span class="text-sm">{{ $bienfait }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
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
