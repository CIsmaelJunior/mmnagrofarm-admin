@extends('dashboard.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Paramètres Système</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-cogs text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">Configuration générale</span>
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

                <form action="{{ route('settings.system.update') }}" method="POST" enctype="multipart/form-data" class="mx-3">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Informations générales -->
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header pb-0">
                                    <h6 class="mb-0">
                                        <i class="fas fa-info-circle me-2"></i>Informations Générales
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="site_name" class="form-label text-sm font-weight-bold">Nom du site *</label>
                                            <input type="text" class="form-control @error('site_name') is-invalid @enderror"
                                                   id="site_name" name="site_name" value="{{ old('site_name', 'MMB AgroFarm Admin') }}" required>
                                            @error('site_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="site_description" class="form-label text-sm font-weight-bold">Description du site</label>
                                            <textarea class="form-control @error('site_description') is-invalid @enderror"
                                                      id="site_description" name="site_description" rows="3">{{ old('site_description', 'Plateforme d\'administration pour MMB AgroFarm - Gestion des produits, commandes et clients') }}</textarea>
                                            @error('site_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Logo et image -->
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header pb-0">
                                    <h6 class="mb-0">
                                        <i class="fas fa-image me-2"></i>Logo et Image
                                    </h6>
                                </div>
                                <div class="card-body text-center">
                                    <div class="position-relative d-inline-block mb-3">
                                        <img src="{{ asset('assets/img/logo-ct.png') }}" alt="Logo"
                                             class="img-fluid" style="max-height: 100px;" id="logo-preview">
                                    </div>
                                    <div class="mb-3">
                                        <label for="logo" class="form-label text-sm font-weight-bold">Logo du site</label>
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                               id="logo" name="logo" accept="image/*">
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <p class="text-xs text-secondary mb-0">
                                        Formats acceptés : JPG, PNG, GIF (max 2MB)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations de contact -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h6 class="mb-0">
                                        <i class="fas fa-address-book me-2"></i>Informations de Contact
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="contact_email" class="form-label text-sm font-weight-bold">Email de contact *</label>
                                            <input type="email" class="form-control @error('contact_email') is-invalid @enderror"
                                                   id="contact_email" name="contact_email" value="{{ old('contact_email', 'contact@mmbagrofarm.com') }}" required>
                                            @error('contact_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="contact_phone" class="form-label text-sm font-weight-bold">Téléphone de contact</label>
                                            <input type="text" class="form-control @error('contact_phone') is-invalid @enderror"
                                                   id="contact_phone" name="contact_phone" value="{{ old('contact_phone', '+223 70 00 00 00') }}">
                                            @error('contact_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="address" class="form-label text-sm font-weight-bold">Adresse</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror"
                                                      id="address" name="address" rows="3">{{ old('address', 'Bamako, Mali') }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Paramètres avancés -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h6 class="mb-0">
                                        <i class="fas fa-sliders-h me-2"></i>Paramètres Avancés
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="maintenance_mode" name="maintenance_mode">
                                                <label class="form-check-label text-sm font-weight-bold" for="maintenance_mode">
                                                    Mode maintenance
                                                </label>
                                            </div>
                                            <p class="text-xs text-secondary mt-1 mb-0">
                                                Active le mode maintenance du site
                                            </p>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="debug_mode" name="debug_mode">
                                                <label class="form-check-label text-sm font-weight-bold" for="debug_mode">
                                                    Mode debug
                                                </label>
                                            </div>
                                            <p class="text-xs text-secondary mt-1 mb-0">
                                                Active les logs de débogage
                                            </p>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="auto_backup" name="auto_backup" checked>
                                                <label class="form-check-label text-sm font-weight-bold" for="auto_backup">
                                                    Sauvegarde automatique
                                                </label>
                                            </div>
                                            <p class="text-xs text-secondary mt-1 mb-0">
                                                Sauvegarde automatique quotidienne
                                            </p>
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
    const logoInput = document.getElementById('logo');
    const logoPreview = document.getElementById('logo-preview');

    logoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                logoPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection

