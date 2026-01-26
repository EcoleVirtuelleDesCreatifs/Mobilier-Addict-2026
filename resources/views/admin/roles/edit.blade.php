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
                        <h1 class="text-black font-w600 mb-1">Modifier le Rôle</h1>
                        <p class="mb-0">Modifiez les informations et permissions du rôle "{{ $role->display_name }}"</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-info me-2">
                            <i class="fas fa-eye me-2"></i>Voir
                        </a>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire de modification -->
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informations du rôle</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nom du rôle <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $role->name) }}"
                                           placeholder="ex: moderator"
                                           {{ in_array($role->name, ['admin', 'editor', 'writer']) ? 'readonly' : '' }}
                                           required>
                                    <small class="form-text text-muted">
                                        @if(in_array($role->name, ['admin', 'editor', 'writer']))
                                            Nom système non modifiable
                                        @else
                                            Nom technique (lettres, chiffres, tirets et underscores uniquement)
                                        @endif
                                    </small>
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
                                           value="{{ old('display_name', $role->display_name) }}"
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
                                              placeholder="Description du rôle et de ses responsabilités">{{ old('description', $role->description) }}</textarea>
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
                                           value="{{ old('order', $role->order) }}"
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
                                               {{ old('is_active', $role->is_active) ? 'checked' : '' }}
                                               {{ $role->name === 'admin' ? 'disabled' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Rôle actif
                                        </label>
                                        <small class="form-text text-muted d-block">
                                            @if($role->name === 'admin')
                                                Le rôle administrateur ne peut pas être désactivé
                                            @else
                                                Les rôles inactifs ne peuvent pas être attribués aux utilisateurs
                                            @endif
                                        </small>
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
                                                               {{ in_array($permission, old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
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
                                        <i class="fas fa-save me-2"></i>Mettre à jour
                                    </button>
                                    <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-info me-2">
                                        <i class="fas fa-eye me-2"></i>Voir le rôle
                                    </a>
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
                        <h4 class="card-title">Informations</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Créé le :</strong><br>
                            <span class="text-muted">{{ $role->created_at->format('d/m/Y à H:i') }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <strong>Dernière modification :</strong><br>
                            <span class="text-muted">{{ $role->updated_at->format('d/m/Y à H:i') }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <strong>Utilisateurs avec ce rôle :</strong><br>
                            <span class="badge badge-info">{{ $role->users()->count() }} utilisateur(s)</span>
                        </div>
                        
                        @if(in_array($role->name, ['admin', 'editor', 'writer']))
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>Rôle système</h6>
                            <p class="mb-0">Ce rôle fait partie du système de base. Certaines modifications peuvent être limitées.</p>
                        </div>
                        @endif
                        
                        <div class="alert alert-warning">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Attention</h6>
                            <p class="mb-0">Les modifications de permissions affecteront immédiatement tous les utilisateurs ayant ce rôle.</p>
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

@endsection
