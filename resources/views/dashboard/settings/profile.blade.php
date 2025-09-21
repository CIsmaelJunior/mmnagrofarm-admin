@extends('dashboard.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Profil Utilisateur</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-user text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">Gérer votre profil</span>
                        </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="{{ route('settings.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Retour
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

                <form action="{{ route('settings.profile.update') }}" method="POST" enctype="multipart/form-data" class="mx-3">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Photo de profil -->
                        <div class="col-lg-4 mb-4">
                            <div class="card h-100">
                                <div class="card-header pb-0">
                                    <h6 class="mb-0">
                                        <i class="fas fa-camera me-2"></i>Photo de Profil
                                    </h6>
                                </div>
                                <div class="card-body text-center">
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ asset('assets/img/team-2.jpg') }}" alt="Photo de profil"
                                             class="avatar avatar-xl rounded-circle shadow" id="avatar-preview">
                                        <label for="avatar" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle">
                                            <i class="fas fa-camera"></i>
                                        </label>
                                    </div>
                                    <input type="file" class="form-control d-none" id="avatar" name="avatar" accept="image/*">
                                    <p class="text-xs text-secondary mt-2 mb-0">
                                        Cliquez sur l'icône pour changer votre photo
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Informations personnelles -->
                        <div class="col-lg-8 mb-4">
                            <div class="card h-100">
                                <div class="card-header pb-0">
                                    <h6 class="mb-0">
                                        <i class="fas fa-user me-2"></i>Informations Personnelles
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="name" class="form-label text-sm font-weight-bold">Nom complet *</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   id="name" name="name" value="{{ old('name', 'Admin User') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="email" class="form-label text-sm font-weight-bold">Email *</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                   id="email" name="email" value="{{ old('email', 'admin@mmbagrofarm.com') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="phone" class="form-label text-sm font-weight-bold">Téléphone</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                   id="phone" name="phone" value="{{ old('phone', '+223 70 00 00 00') }}">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations de connexion -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h6 class="mb-0">
                                        <i class="fas fa-lock me-2"></i>Sécurité du Compte
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="current_password" class="form-label text-sm font-weight-bold">Mot de passe actuel</label>
                                            <input type="password" class="form-control" id="current_password" name="current_password">
                                            <p class="text-xs text-secondary mt-1 mb-0">
                                                Laissez vide si vous ne voulez pas changer le mot de passe
                                            </p>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="new_password" class="form-label text-sm font-weight-bold">Nouveau mot de passe</label>
                                            <input type="password" class="form-control" id="new_password" name="new_password">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="new_password_confirmation" class="form-label text-sm font-weight-bold">Confirmer le nouveau mot de passe</label>
                                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('settings.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i>Annuler
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Mettre à jour
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const avatarInput = document.getElementById('avatar');
    const avatarPreview = document.getElementById('avatar-preview');

    avatarInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                avatarPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection

