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
                        <h1 class="text-black font-w600 mb-1">Modifier l'utilisateur</h1>
                        <p class="mb-0">{{ $user->name }} - {{ $user->email }}</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire d'édition -->
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informations de l'utilisateur</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nom complet <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Nouveau mot de passe</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="password" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Laissez vide pour conserver le mot de passe actuel</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                                    <input type="password" class="form-control"
                                           id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fonction" class="form-label">Fonction</label>
                                    <input type="text" class="form-control @error('fonction') is-invalid @enderror"
                                           id="fonction" name="fonction" value="{{ old('fonction', $user->fonction) }}"
                                           placeholder="Ex: Journaliste, Rédacteur en chef...">
                                    @error('fonction')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="role" class="form-label">Rôle <span class="text-danger">*</span></label>
                                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}" {{ old('role', $user->role) === $role ? 'selected' : '' }}>
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

                                @if($user->profile_picture)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                             class="rounded" width="100" height="100" alt="Photo actuelle">
                                        <p class="small text-muted mt-1">Photo actuelle</p>
                                    </div>
                                @endif

                                <input type="file" class="form-control @error('profile_picture') is-invalid @enderror"
                                       id="profile_picture" name="profile_picture" accept="image/*">
                                @error('profile_picture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Formats acceptés: JPEG, PNG, JPG, GIF. Taille max: 2MB. Laissez vide pour conserver la photo actuelle.</div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info me-2">
                                    <i class="fas fa-eye me-2"></i>Voir le profil
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Mettre à jour
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informations du compte</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Créé le:</strong><br>
                            <span class="text-muted">{{ $user->created_at?->format('d/m/Y à H:i') }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Dernière modification:</strong><br>
                            <span class="text-muted">{{ $user->updated_at?->format('d/m/Y à H:i') }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Dernière connexion:</strong><br>
                            <span class="text-muted">
                                @if($user->last_login_at)
                                    {{ $user->last_login_at?->format('d/m/Y à H:i') }}
                                @else
                                    Jamais connecté
                                @endif
                            </span>
                        </div>

                        <div class="mb-3">
                            <strong>Nombre d'articles:</strong><br>
                            <span class="text-muted">{{ $user->articles()->count() }} articles</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Actions rapides</h4>
                    </div>
                    <div class="card-body">
                        @if($user->id !== auth()->id())
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="statusToggle"
                                           {{ ($user->is_active ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="statusToggle">
                                        Compte actif
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                                    <i class="fas fa-trash me-2"></i>Supprimer l'utilisateur
                                </button>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Vous ne pouvez pas supprimer votre propre compte.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer l'utilisateur <strong>{{ $user->name }}</strong> ?</p>
                <p class="text-danger">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Aperçu de la nouvelle image de profil
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
                    <img src="${e.target.result}" class="rounded" width="100" height="100" alt="Nouvelle photo">
                    <p class="small text-muted mt-1">Nouvelle photo de profil</p>
                `;
            };
            reader.readAsDataURL(file);
        }
    });

    // Gestion du toggle de statut
    const statusToggle = document.getElementById('statusToggle');
    if (statusToggle) {
        statusToggle.addEventListener('change', function() {
            fetch(`/in/admin/users/{{ $user->id }}/toggle-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                } else {
                    // Remettre l'état précédent
                    this.checked = !this.checked;
                    showAlert('error', data.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                this.checked = !this.checked;
                showAlert('error', 'Une erreur est survenue');
            });
        });
    }
});

function confirmDelete() {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

function showAlert(type, message) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;

    const contentBody = document.querySelector('.content-body .container-fluid');
    contentBody.insertAdjacentHTML('afterbegin', alertHtml);

    setTimeout(function() {
        const alert = contentBody.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 5000);
}
</script>

@endsection
