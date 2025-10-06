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
                                        <img src="{{ $user->avatar_url ?? $user->default_avatar }}" alt="Photo de profil"
                                             class="avatar avatar-xl rounded-circle shadow" id="avatar-preview">
                                        <label for="avatar" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle shadow-sm avatar-camera-btn"
                                               style="width: 32px; height: 32px; padding: 0; border: 2px solid white; display: flex; align-items: center; justify-content: center;">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 15.5A3.5 3.5 0 0 1 8.5 12A3.5 3.5 0 0 1 12 8.5a3.5 3.5 0 0 1 3.5 3.5a3.5 3.5 0 0 1-3.5 3.5M7.43 4.69L8.5 2H15.5L16.57 4.69L19 5.5V18.5L16.57 19.31L15.5 22H8.5L7.43 19.31L5 18.5V5.5L7.43 4.69M12 6.5A5.5 5.5 0 0 0 6.5 12A5.5 5.5 0 0 0 12 17.5A5.5 5.5 0 0 0 17.5 12A5.5 5.5 0 0 0 12 6.5Z"/>
                                            </svg>
                                        </label>
                                    </div>
                                    <input type="file" class="form-control d-none" id="avatar" name="avatar" accept="image/*">
                                    <p class="text-xs text-secondary mt-3 mb-2">
                                        Cliquez sur l'icône pour changer votre photo
                                    </p>
                                    <button type="button" class="btn btn-sm btn-outline-danger" id="delete-avatar-btn"
                                            onclick="removeAvatar()" style="{{ $user->hasAvatar() ? '' : 'display: none;' }}">
                                        <i class="fas fa-trash me-1"></i>Supprimer
                                    </button>
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
                                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="email" class="form-label text-sm font-weight-bold">Email *</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="phone" class="form-label text-sm font-weight-bold">Téléphone</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                   id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+223 70 00 00 00">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="form-label text-sm font-weight-bold">Rôle</label>
                                                    <div class="form-control-plaintext">
                                                        <span class="badge bg-gradient-primary">{{ $user->role }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label text-sm font-weight-bold">Membre depuis</label>
                                                    <div class="form-control-plaintext">
                                                        {{ $user->created_at->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                            </div>
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
    const originalAvatarSrc = avatarPreview.src;

    // Gestion de l'upload d'avatar
    avatarInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Vérifier la taille du fichier (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                alert('Le fichier est trop volumineux. Taille maximale : 2MB');
                this.value = '';
                return;
            }

            // Vérifier le type de fichier
            if (!file.type.match('image.*')) {
                alert('Veuillez sélectionner un fichier image valide');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                avatarPreview.src = e.target.result;

                // Afficher le bouton supprimer quand une nouvelle image est sélectionnée
                const deleteButton = document.getElementById('delete-avatar-btn');
                if (deleteButton) {
                    deleteButton.style.display = 'inline-block';
                }
            };
            reader.readAsDataURL(file);
        }
    });

    // Fonction pour supprimer l'avatar
    window.removeAvatar = function() {
        if (confirm('Êtes-vous sûr de vouloir supprimer votre photo de profil ?')) {
            // Remettre l'avatar par défaut
            avatarPreview.src = '{{ $user->default_avatar }}';
            avatarInput.value = '';

            // Ajouter un champ caché pour indiquer la suppression
            let removeAvatarInput = document.getElementById('remove_avatar');
            if (!removeAvatarInput) {
                removeAvatarInput = document.createElement('input');
                removeAvatarInput.type = 'hidden';
                removeAvatarInput.name = 'remove_avatar';
                removeAvatarInput.id = 'remove_avatar';
                removeAvatarInput.value = '1';
                document.querySelector('form').appendChild(removeAvatarInput);
            } else {
                removeAvatarInput.value = '1';
            }

            // Masquer le bouton supprimer
            const deleteButton = document.getElementById('delete-avatar-btn');
            if (deleteButton) {
                deleteButton.style.display = 'none';
            }

            // Afficher un message de confirmation
            alert('La photo sera supprimée lors de la sauvegarde du profil.');
        }
    };

    // Validation du formulaire
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('new_password_confirmation').value;
        const currentPassword = document.getElementById('current_password').value;

        // Vérifier si un nouveau mot de passe est fourni
        if (newPassword || confirmPassword) {
            if (!currentPassword) {
                e.preventDefault();
                alert('Veuillez saisir votre mot de passe actuel pour changer le mot de passe.');
                document.getElementById('current_password').focus();
                return;
            }

            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('Les mots de passe ne correspondent pas.');
                document.getElementById('new_password_confirmation').focus();
                return;
            }

            if (newPassword.length < 8) {
                e.preventDefault();
                alert('Le nouveau mot de passe doit contenir au moins 8 caractères.');
                document.getElementById('new_password').focus();
                return;
            }
        }
    });
});
</script>
@endsection

