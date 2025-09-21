@extends('dashboard.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Nouveau Client</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-user-plus text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">Ajouter un nouveau client</span>
                        </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="{{ route('clients.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Retour
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <form action="{{ route('clients.store') }}" method="POST" class="mx-3">
                    @csrf

                    <div class="row">
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
                                            <label for="nom" class="form-label text-sm font-weight-bold">Nom complet *</label>
                                            <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                                   id="nom" name="nom" value="{{ old('nom') }}" required>
                                            @error('nom')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="email" class="form-label text-sm font-weight-bold">Email *</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                   id="email" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="telephone" class="form-label text-sm font-weight-bold">Téléphone</label>
                                            <input type="text" class="form-control @error('telephone') is-invalid @enderror"
                                                   id="telephone" name="telephone" value="{{ old('telephone') }}">
                                            @error('telephone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="entreprise" class="form-label text-sm font-weight-bold">Entreprise</label>
                                            <input type="text" class="form-control @error('entreprise') is-invalid @enderror"
                                                   id="entreprise" name="entreprise" value="{{ old('entreprise') }}">
                                            @error('entreprise')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="actif" name="actif"
                                                       value="1" {{ old('actif', true) ? 'checked' : '' }}>
                                                <label class="form-check-label text-sm font-weight-bold" for="actif">
                                                    Client actif
                                                </label>
                                            </div>
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
                                            <label for="adresse_livraison" class="form-label text-sm font-weight-bold">Adresse</label>
                                            <textarea class="form-control @error('adresse_livraison') is-invalid @enderror"
                                                      id="adresse_livraison" name="adresse_livraison" rows="3">{{ old('adresse_livraison') }}</textarea>
                                            @error('adresse_livraison')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="ville" class="form-label text-sm font-weight-bold">Ville</label>
                                            <input type="text" class="form-control @error('ville') is-invalid @enderror"
                                                   id="ville" name="ville" value="{{ old('ville') }}">
                                            @error('ville')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="code_postal" class="form-label text-sm font-weight-bold">Code postal</label>
                                            <input type="text" class="form-control @error('code_postal') is-invalid @enderror"
                                                   id="code_postal" name="code_postal" value="{{ old('code_postal') }}">
                                            @error('code_postal')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="notes" class="form-label text-sm font-weight-bold">Notes</label>
                                            <textarea class="form-control @error('notes') is-invalid @enderror"
                                                      id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                                            @error('notes')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i>Annuler
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Créer le client
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
