@extends('layouts.admin')

@section('content')
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <!-- En-tête -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="text-black font-w600 mb-1">Modifier mon Profil</h1>
                        <p class="mb-0">Mettez à jour vos informations personnelles</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.profile') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Retour au profil
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages de succès/erreur -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Erreurs de validation :</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Formulaire d'édition -->
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informations Personnelles</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Nom -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom complet <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse email <span class="text-danger">*</span></label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Bio -->
                            <div class="mb-3">
                                <label for="bio" class="form-label">Biographie</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror" 
                                          id="bio" 
                                          name="bio" 
                                          rows="4" 
                                          maxlength="500"
                                          placeholder="Parlez-nous de vous... (max 500 caractères)">{{ old('bio', $user->bio) }}</textarea>
                                <div class="form-text">
                                    <span id="bio-count">{{ strlen($user->bio ?? '') }}</span>/500 caractères
                                </div>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Photo de profil -->
                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Photo de profil</label>
                                <input type="file" 
                                       class="form-control @error('profile_picture') is-invalid @enderror" 
                                       id="profile_picture" 
                                       name="profile_picture" 
                                       accept="image/*">
                                <div class="form-text">
                                    Formats acceptés : JPEG, PNG, JPG, GIF. Taille maximale : 2MB
                                </div>
                                @error('profile_picture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Aperçu de l'image actuelle -->
                            @if($user->profile_picture)
                            <div class="mb-3">
                                <label class="form-label">Photo actuelle</label>
                                <div>
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                                         class="rounded-circle" 
                                         width="80" 
                                         height="80" 
                                         alt="Photo de profil actuelle">
                                </div>
                            </div>
                            @endif

                            <!-- Séparateur -->
                            <hr class="my-4">

                            <!-- Section mot de passe -->
                            <h5 class="mb-3">
                                <i class="fas fa-lock me-2"></i>Changer le mot de passe
                                <small class="text-muted">(optionnel)</small>
                            </h5>

                            <!-- Nouveau mot de passe -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Nouveau mot de passe</label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       minlength="8">
                                <div class="form-text">
                                    Laissez vide si vous ne souhaitez pas changer votre mot de passe. Minimum 8 caractères.
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirmation mot de passe -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       minlength="8">
                            </div>

                            <!-- Boutons d'action -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.profile') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Enregistrer les modifications
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar avec informations -->
            <div class="col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informations du compte</h4>
                    </div>
                    <div class="card-body">
                        <!-- Rôle -->
                        <div class="mb-3">
                            <label class="form-label font-w600">Rôle</label>
                            <div>
                                <span class="badge badge-primary badge-lg">
                                    <i class="fas fa-user-tag me-1"></i>
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        </div>

                        <!-- Date de création -->
                        <div class="mb-3">
                            <label class="form-label font-w600">Membre depuis</label>
                            <div>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $user->created_at?->format('d/m/Y') }}
                                </small>
                            </div>
                        </div>

                        <!-- Dernière modification -->
                        @if($user->updated_at && $user->updated_at != $user->created_at)
                        <div class="mb-3">
                            <label class="form-label font-w600">Dernière modification</label>
                            <div>
                                <small class="text-muted">
                                    <i class="fas fa-edit me-1"></i>
                                    {{ $user->updated_at?->format('d/m/Y à H:i') }}
                                </small>
                            </div>
                        </div>
                        @endif

                        <!-- Statistiques -->
                        <div class="mb-3">
                            <label class="form-label font-w600">Articles écrits</label>
                            <div>
                                <span class="badge badge-info">
                                    <i class="fas fa-newspaper me-1"></i>
                                    {{ $user->articles_count ?? $user->articles()->count() }} articles
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Conseils -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fas fa-lightbulb me-2"></i>Conseils
                        </h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Utilisez une photo de profil professionnelle
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Rédigez une biographie engageante
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Utilisez un mot de passe fort
                            </li>
                            <li class="mb-0">
                                <i class="fas fa-check text-success me-2"></i>
                                Gardez vos informations à jour
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->

<script>
// Compteur de caractères pour la bio
document.getElementById('bio').addEventListener('input', function() {
    const bioCount = document.getElementById('bio-count');
    const currentLength = this.value.length;
    bioCount.textContent = currentLength;
    
    // Changer la couleur selon la limite
    if (currentLength > 450) {
        bioCount.className = 'text-warning';
    } else if (currentLength > 480) {
        bioCount.className = 'text-danger';
    } else {
        bioCount.className = '';
    }
});

// Prévisualisation de l'image
document.getElementById('profile_picture').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Créer ou mettre à jour l'aperçu
            let preview = document.getElementById('image-preview');
            if (!preview) {
                preview = document.createElement('div');
                preview.id = 'image-preview';
                preview.className = 'mt-2';
                e.target.parentNode.appendChild(preview);
            }
            preview.innerHTML = `
                <label class="form-label">Aperçu</label><br>
                <img src="${e.target.result}" class="rounded-circle" width="80" height="80" alt="Aperçu">
            `;
        };
        reader.readAsDataURL(file);
    }
});
</script>

@endsection
