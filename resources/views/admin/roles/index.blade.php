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
                        <h1 class="text-black font-w600 mb-1">Gestion des Rôles</h1>
                        <p class="mb-0">Gérez les rôles et permissions du système</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Créer un rôle
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages de succès/erreur -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Liste des rôles -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Liste des rôles ({{ $roles->total() }})</h4>
                    </div>
                    <div class="card-body">
                        @if($roles->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th><strong>Ordre</strong></th>
                                        <th><strong>Nom</strong></th>
                                        <th><strong>Nom d'affichage</strong></th>
                                        <th><strong>Description</strong></th>
                                        <th><strong>Utilisateurs</strong></th>
                                        <th><strong>Statut</strong></th>
                                        <th><strong>Actions</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>
                                            <span class="badge badge-primary">{{ $role->order }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-user-tag text-primary me-2"></i>
                                                <strong>{{ $role->name }}</strong>
                                            </div>
                                        </td>
                                        <td>{{ $role->display_name }}</td>
                                        <td>
                                            @if($role->description)
                                                <span class="text-muted">{{ Str::limit($role->description, 50) }}</span>
                                            @else
                                                <span class="text-muted">Aucune description</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $role->users_count }} utilisateur(s)</span>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                       id="status_{{ $role->id }}"
                                                       {{ $role->is_active ? 'checked' : '' }}
                                                       onchange="toggleRoleStatus({{ $role->id }})"
                                                       {{ $role->name === 'admin' ? 'disabled' : '' }}>
                                                <label class="form-check-label" for="status_{{ $role->id }}">
                                                    <span class="badge badge-{{ $role->is_active ? 'success' : 'danger' }}">
                                                        {{ $role->is_active ? 'Actif' : 'Inactif' }}
                                                    </span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.roles.show', $role) }}"
                                                   class="btn btn-primary shadow btn-xs sharp me-1"
                                                   title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.roles.edit', $role) }}"
                                                   class="btn btn-primary shadow btn-xs sharp me-1"
                                                   title="Modifier">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                @if(!in_array($role->name, ['admin', 'editor', 'writer']) && $role->users_count == 0)
                                                <form action="{{ route('admin.roles.destroy', $role) }}"
                                                      method="POST"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-danger shadow btn-xs sharp"
                                                            title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                @else
                                                <button class="btn btn-secondary shadow btn-xs sharp"
                                                        title="Suppression non autorisée"
                                                        disabled>
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($roles->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $roles->links() }}
                        </div>
                        @endif
                        @else
                        <div class="text-center py-5">
                            <i class="fas fa-user-tag text-muted" style="font-size: 3rem;"></i>
                            <h4 class="mt-3 text-muted">Aucun rôle trouvé</h4>
                            <p class="text-muted">Commencez par créer votre premier rôle.</p>
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Créer un rôle
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
    const checkbox = document.getElementById(`status_${roleId}`);
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
