@extends('dashboard.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Modifier le produit</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-edit text-warning" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">{{ $produit->nom }} - {{ $produit->variete }}</span>
                        </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a href="{{ route('products.show', $produit->slug) }}" class="btn btn-outline-secondary btn-sm me-2">
                            <i class="fas fa-arrow-left me-1"></i>Retour
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-list me-1"></i>Liste
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Erreurs de validation :</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('products.update', $produit->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Informations de base -->
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="mb-0">Informations générales</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom du produit *</label>
                                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $produit->nom) }}" required>
                                        @error('nom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="variete" class="form-label">Variété *</label>
                                        <input type="text" class="form-control @error('variete') is-invalid @enderror" id="variete" name="variete" value="{{ old('variete', $produit->variete) }}" required>
                                        @error('variete')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="origine" class="form-label">Origine *</label>
                                        <input type="text" class="form-control @error('origine') is-invalid @enderror" id="origine" name="origine" value="{{ old('origine', $produit->origine) }}" required>
                                        @error('origine')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="saison" class="form-label">Saison *</label>
                                        <input type="text" class="form-control @error('saison') is-invalid @enderror" id="saison" name="saison" value="{{ old('saison', $produit->saison) }}" required>
                                        @error('saison')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="prix" class="form-label">Prix (FCFA)</label>
                                        <input type="number" step="0.01" class="form-control @error('prix') is-invalid @enderror" id="prix" name="prix" value="{{ old('prix', $produit->prix) }}">
                                        @error('prix')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Image et conditionnement -->
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="mb-0">Image et conditionnement</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image du produit</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if($produit->image)
                                            <div class="mt-2">
                                                <img src="{{ $produit->image }}" alt="{{ $produit->nom }}" class="img-thumbnail" style="max-width: 150px;">
                                                <p class="text-xs text-muted mt-1">Image actuelle</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="conditionnement" class="form-label">Conditionnement *</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" class="form-control @error('conditionnement.0') is-invalid @enderror" name="conditionnement[]" placeholder="Ex: 20kg" value="{{ old('conditionnement.0', $produit->conditionnement[0] ?? '') }}" required>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control @error('conditionnement.1') is-invalid @enderror" name="conditionnement[]" placeholder="Ex: 45kg" value="{{ old('conditionnement.1', $produit->conditionnement[1] ?? '') }}">
                                            </div>
                                        </div>
                                        @error('conditionnement')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="mb-0">Description</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description du produit *</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $produit->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Caractéristiques -->
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="mb-0">Caractéristiques</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="gout" class="form-label">Goût *</label>
                                        <textarea class="form-control @error('gout') is-invalid @enderror" id="gout" name="gout" rows="3" required>{{ old('gout', $produit->gout) }}</textarea>
                                        @error('gout')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="conservation" class="form-label">Conservation *</label>
                                        <textarea class="form-control @error('conservation') is-invalid @enderror" id="conservation" name="conservation" rows="3" required>{{ old('conservation', $produit->conservation) }}</textarea>
                                        @error('conservation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="usage" class="form-label">Usage *</label>
                                        <textarea class="form-control @error('usage') is-invalid @enderror" id="usage" name="usage" rows="3" required>{{ old('usage', $produit->usage) }}</textarea>
                                        @error('usage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bienfaits -->
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="mb-0">Bienfaits nutritionnels</h6>
                                </div>
                                <div class="card-body">
                                    <div id="bienfaits-container">
                                        @foreach($produit->bienfaits as $index => $bienfait)
                                            <div class="mb-3 bienfait-item">
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('bienfaits.' . $index) is-invalid @enderror" name="bienfaits[]" value="{{ old('bienfaits.' . $index, $bienfait) }}" placeholder="Bienfait nutritionnel">
                                                    <button type="button" class="btn btn-outline-danger" onclick="removeBienfait(this)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                                @error('bienfaits.' . $index)
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="addBienfait()">
                                        <i class="fas fa-plus me-1"></i>Ajouter un bienfait
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('products.show', $produit->slug) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i>Annuler
                                </a>
                                <button type="submit" class="btn btn-warning">
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
function addBienfait() {
    const container = document.getElementById('bienfaits-container');
    const div = document.createElement('div');
    div.className = 'mb-3 bienfait-item';
    div.innerHTML = `
        <div class="input-group">
            <input type="text" class="form-control" name="bienfaits[]" placeholder="Bienfait nutritionnel">
            <button type="button" class="btn btn-outline-danger" onclick="removeBienfait(this)">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(div);
}

function removeBienfait(button) {
    button.closest('.bienfait-item').remove();
}
</script>
@endsection
