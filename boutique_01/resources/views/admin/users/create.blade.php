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
                        <h1 class="text-black font-w600 mb-1">Créer un Utilisateur</h1>
                        <p class="mb-0">Ajouter un nouvel utilisateur au système</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire de création -->
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informations de l'utilisateur</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nom complet <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="password" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control"
                                           id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fonction" class="form-label">Fonction</label>
                                    <input type="text" class="form-control @error('fonction') is-invalid @enderror"
                                           id="fonction" name="fonction" value="{{ old('fonction') }}"
                                           placeholder="Ex: Journaliste, Rédacteur en chef...">
                                    @error('fonction')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="role" class="form-label">Rôle <span class="text-danger">*</span></label>
                                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                        <option value="">Sélectionner un rôle</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}" {{ old('role') === $role ? 'selected' : '' }}>
                                                {{ ucfirst($role) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Photo de profil</label>
                                <input type="file" class="form-control @error('profile_picture') is-invalid @enderror"
                                       id="profile_picture" name="profile_picture" accept="image/*">
                                @error('profile_picture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Formats acceptés: JPEG, PNG, JPG, GIF. Taille max: 2MB</div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-secondary me-2">Réinitialiser</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Créer l'utilisateur
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informations sur les rôles</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="text-primary"><i class="fas fa-user-shield me-2"></i>Administrateur</h6>
                            <p class="small text-muted">Accès complet au système, peut gérer tous les utilisateurs et contenus.</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-warning"><i class="fas fa-user-edit me-2"></i>Éditeur</h6>
                            <p class="small text-muted">Peut créer, modifier et publier des articles. Accès aux fonctionnalités de gestion de contenu.</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-info"><i class="fas fa-user-pen me-2"></i>Rédacteur</h6>
                            <p class="small text-muted">Peut créer et modifier ses propres articles. Accès limité aux fonctionnalités de base.</p>
                        </div>
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
document.addEventListener('DOMContentLoaded', function() {
    // Aperçu de l'image de profil
    const profilePictureInput = document.getElementById('profile_picture');

    profilePictureInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Créer un aperçu si il n'existe pas
                let preview = document.getElementById('profile-preview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.id = 'profile-preview';
                    preview.className = 'mt-2';
                    profilePictureInput.parentNode.appendChild(preview);
                }

                preview.innerHTML = `
                    <img src="${e.target.result}" class="rounded" width="100" height="100" alt="Aperçu">
                    <p class="small text-muted mt-1">Aperçu de la photo de profil</p>
                `;
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>

@endsection
