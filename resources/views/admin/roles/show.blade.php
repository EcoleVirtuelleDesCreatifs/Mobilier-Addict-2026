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
                        <h1 class="text-black font-w600 mb-1">{{ $role->display_name }}</h1>
                        <p class="mb-0">Détails du rôle et utilisateurs associés</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary me-2">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </a>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations générales -->
        <div class="row mb-4">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informations du rôle</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Nom technique :</strong><br>
                                <code class="bg-light p-1 rounded">{{ $role->name }}</code>
                                @if(in_array($role->name, ['admin', 'editor', 'writer']))
                                    <span class="badge badge-info ms-2">Système</span>
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Nom d'affichage :</strong><br>
                                <span class="text-primary">{{ $role->display_name }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Ordre d'affichage :</strong><br>
                                <span class="badge badge-primary">{{ $role->order }}</span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Statut :</strong><br>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                           id="status_toggle"
                                           {{ $role->is_active ? 'checked' : '' }}
                                           onchange="toggleRoleStatus({{ $role->id }})"
                                           {{ $role->name === 'admin' ? 'disabled' : '' }}>
                                    <label class="form-check-label" for="status_toggle">
                                        <span class="badge badge-{{ $role->is_active ? 'success' : 'danger' }}">
                                            {{ $role->is_active ? 'Actif' : 'Inactif' }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        @if($role->description)
                        <div class="row">
                            <div class="col-12 mb-3">
                                <strong>Description :</strong><br>
                                <p class="text-muted mb-0">{{ $role->description }}</p>
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Créé le :</strong><br>
                                <span class="text-muted">{{ $role->created_at->format('d/m/Y à H:i') }}</span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Dernière modification :</strong><br>
                                <span class="text-muted">{{ $role->updated_at->format('d/m/Y à H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Statistiques</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <h2 class="text-primary">{{ $role->users_count }}</h2>
                            <p class="mb-0">Utilisateur(s) avec ce rôle</p>
                        </div>

                        @if($role->users_count > 0)
                        <a href="#users-section" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-users me-2"></i>Voir les utilisateurs
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Permissions -->
        @if($role->permissions && count($role->permissions) > 0)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Permissions accordées ({{ count($role->permissions) }})</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @php
                                $groupedPermissions = [];
                                foreach($role->permissions as $permission) {
                                    $parts = explode('.', $permission);
                                    $category = $parts[0] ?? 'other';
                                    $groupedPermissions[$category][] = $permission;
                                }
                            @endphp

                            @foreach($groupedPermissions as $category => $permissions)
                            <div class="col-md-6 mb-3">
                                <div class="card border">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0 text-capitalize">
                                            <i class="fas fa-{{ $category === 'articles' ? 'newspaper' : ($category === 'categories' ? 'folder' : ($category === 'users' ? 'users' : 'cog')) }} me-2"></i>
                                            {{ ucfirst($category) }}
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        @foreach($permissions as $permission)
                                        <span class="badge badge-success me-1 mb-1">{{ $permission }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Permissions</h4>
                    </div>
                    <div class="card-body text-center py-4">
                        <i class="fas fa-lock text-muted" style="font-size: 2rem;"></i>
                        <h5 class="mt-3 text-muted">Aucune permission accordée</h5>
                        <p class="text-muted">Ce rôle n'a aucune permission spécifique.</p>
                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Modifier les permissions
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Utilisateurs avec ce rôle -->
        <div class="row" id="users-section">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Utilisateurs avec ce rôle ({{ $role->users_count }})</h4>
                    </div>
                    <div class="card-body">
                        @if($recentUsers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th><strong>Utilisateur</strong></th>
                                        <th><strong>Email</strong></th>
                                        <th><strong>Fonction</strong></th>
                                        <th><strong>Statut</strong></th>
                                        <th><strong>Dernière connexion</strong></th>
                                        <th><strong>Actions</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentUsers as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($user->profile_picture)
                                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" class="rounded-circle me-3" width="35" height="35" alt="">
                                                @else
                                                    <div class="bg-secondary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $user->name }}</h6>
                                                    <small class="text-muted">Créé {{ $user->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->fonction)
                                                <span class="text-muted">{{ $user->fonction }}</span>
                                            @else
                                                <span class="text-muted">Non spécifiée</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $user->is_active ? 'success' : 'danger' }}">
                                                {{ $user->is_active ? 'Actif' : 'Inactif' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($user->last_login_at)
                                                <span class="text-muted">{{ $user->last_login_at->diffForHumans() }}</span>
                                            @else
                                                <span class="text-muted">Jamais connecté</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.users.show', $user) }}"
                                                   class="btn btn-primary shadow btn-xs sharp me-1"
                                                   title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user) }}"
                                                   class="btn btn-primary shadow btn-xs sharp"
                                                   title="Modifier">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($role->users_count > 5)
                        <div class="text-center mt-3">
                            <a href="{{ route('admin.users.index', ['role' => $role->name]) }}" class="btn btn-outline-primary">
                                <i class="fas fa-users me-2"></i>Voir tous les utilisateurs ({{ $role->users_count }})
                            </a>
                        </div>
                        @endif
                        @else
                        <div class="text-center py-4">
                            <i class="fas fa-users text-muted" style="font-size: 2rem;"></i>
                            <h5 class="mt-3 text-muted">Aucun utilisateur</h5>
                            <p class="text-muted">Aucun utilisateur n'a encore ce rôle.</p>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                <i class="fas fa-user-plus me-2"></i>Créer un utilisateur
                            </a>
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

<script>
// Fonction pour changer le statut d'un rôle
function toggleRoleStatus(roleId) {
    const checkbox = document.getElementById('status_toggle');
    const originalState = checkbox.checked;

    // Désactiver temporairement le checkbox
    checkbox.disabled = true;

    fetch(`/in/admin/roles/${roleId}/toggle`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mettre à jour le badge
            const badge = checkbox.nextElementSibling.querySelector('.badge');
            badge.className = `badge badge-${data.is_active ? 'success' : 'danger'}`;
            badge.textContent = data.is_active ? 'Actif' : 'Inactif';

            // Afficher un message de succès
            showAlert('success', data.message);
        } else {
            // Restaurer l'état original en cas d'erreur
            checkbox.checked = !originalState;
            showAlert('error', data.message);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        // Restaurer l'état original en cas d'erreur
        checkbox.checked = !originalState;
        showAlert('error', 'Une erreur est survenue lors de la mise à jour du statut.');
    })
    .finally(() => {
        // Réactiver le checkbox
        checkbox.disabled = false;
    });
}

// Fonction pour afficher les alertes
function showAlert(type, message) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const iconClass = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';

    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show">
            <i class="${iconClass} me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;

    // Insérer l'alerte au début du container
    const container = document.querySelector('.container-fluid');
    const firstRow = container.querySelector('.row');
    firstRow.insertAdjacentHTML('beforebegin', alertHtml);

    // Supprimer l'alerte après 5 secondes
    setTimeout(() => {
        const alert = container.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 5000);
}
</script>

@endsection
