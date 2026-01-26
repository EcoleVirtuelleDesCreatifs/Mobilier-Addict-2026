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
                        <h1 class="text-black font-w600 mb-1">Créer un Rôle</h1>
                        <p class="mb-0">Ajoutez un nouveau rôle avec ses permissions</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
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
                        <h4 class="card-title">Informations du rôle</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.roles.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nom du rôle <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}"
                                           placeholder="ex: moderator"
                                           required>
                                    <small class="form-text text-muted">Nom technique (lettres, chiffres, tirets et underscores uniquement)</small>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="display_name" class="form-label">Nom d'affichage <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('display_name') is-invalid @enderror" 
                                           id="display_name" 
                                           name="display_name" 
                                           value="{{ old('display_name') }}"
                                           placeholder="ex: Modérateur"
                                           required>
                                    <small class="form-text text-muted">Nom affiché dans l'interface</small>
                                    @error('display_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="3"
                                              placeholder="Description du rôle et de ses responsabilités">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="order" class="form-label">Ordre d'affichage <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control @error('order') is-invalid @enderror" 
                                           id="order" 
                                           name="order" 
                                           value="{{ old('order', $nextOrder) }}"
                                           min="0"
                                           required>
                                    <small class="form-text text-muted">Position dans la liste</small>
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1"
                                               {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Rôle actif
                                        </label>
                                        <small class="form-text text-muted d-block">Les rôles inactifs ne peuvent pas être attribués aux utilisateurs</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5 class="mb-3">Permissions</h5>
                                    <div class="row">
                                        @foreach($availablePermissions as $category => $permissions)
                                        <div class="col-md-6 mb-4">
                                            <div class="card border">
                                                <div class="card-header bg-light">
                                                    <h6 class="mb-0 text-capitalize">
                                                        <i class="fas fa-{{ $category === 'articles' ? 'newspaper' : ($category === 'categories' ? 'folder' : ($category === 'users' ? 'users' : 'cog')) }} me-2"></i>
                                                        {{ ucfirst($category) }}
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    @foreach($permissions as $permission => $label)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" 
                                                               type="checkbox" 
                                                               id="permission_{{ $permission }}" 
                                                               name="permissions[]" 
                                                               value="{{ $permission }}"
                                                               {{ in_array($permission, old('permissions', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="permission_{{ $permission }}">
                                                            {{ $label }}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fas fa-save me-2"></i>Créer le rôle
                                    </button>
                                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Annuler
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Aide</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>Conseils</h6>
                            <ul class="mb-0">
                                <li>Le nom du rôle doit être unique et ne contenir que des lettres, chiffres, tirets et underscores</li>
                                <li>Le nom d'affichage est ce que verront les utilisateurs</li>
                                <li>L'ordre détermine la position dans les listes</li>
                                <li>Sélectionnez uniquement les permissions nécessaires</li>
                            </ul>
                        </div>
                        
                        <div class="alert alert-warning">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Attention</h6>
                            <p class="mb-0">Les permissions accordées à un rôle déterminent ce que les utilisateurs ayant ce rôle peuvent faire dans le système.</p>
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
    // Générer automatiquement le nom technique à partir du nom d'affichage
    const displayNameInput = document.getElementById('display_name');
    const nameInput = document.getElementById('name');
    
    displayNameInput.addEventListener('input', function() {
        if (!nameInput.dataset.manuallyChanged) {
            const displayName = this.value;
            const technicalName = displayName
                .toLowerCase()
                .replace(/[^a-z0-9\s]/g, '') // Supprimer les caractères spéciaux
                .replace(/\s+/g, '_') // Remplacer les espaces par des underscores
                .replace(/_+/g, '_') // Supprimer les underscores multiples
                .replace(/^_|_$/g, ''); // Supprimer les underscores en début/fin
            
            nameInput.value = technicalName;
        }
    });
    
    // Marquer le champ nom comme modifié manuellement si l'utilisateur le change
    nameInput.addEventListener('input', function() {
        nameInput.dataset.manuallyChanged = 'true';
    });
});
</script>

@endsection
