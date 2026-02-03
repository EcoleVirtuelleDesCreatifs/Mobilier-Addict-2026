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
                        <h1 class="text-black font-w600 mb-1">Gestion des Utilisateurs</h1>
                        <p class="mb-0">Liste des utilisateurs du système</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Nouvel Utilisateur
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages de succès/erreur -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistiques rapides -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-primary card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ $users->total() }}</h2>
                                <span class="fs-14">Total Utilisateurs</span>
                            </div>
                            <i class="fas fa-users text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-success card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ $users->where('role', 'admin')->count() }}</h2>
                                <span class="fs-14">Administrateurs</span>
                            </div>
                            <i class="fas fa-user-shield text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-warning card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ $users->where('role', 'editor')->count() }}</h2>
                                <span class="fs-14">Éditeurs</span>
                            </div>
                            <i class="fas fa-user-edit text-warning" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-info card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ $users->where('role', 'writer')->count() }}</h2>
                                <span class="fs-14">Rédacteurs</span>
                            </div>
                            <i class="fas fa-user-pen text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des utilisateurs -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Liste des Utilisateurs</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th><strong>Utilisateur</strong></th>
                                        <th><strong>Email</strong></th>
                                        <th><strong>Fonction</strong></th>
                                        <th><strong>Rôle</strong></th>
                                        <th><strong>Statut</strong></th>
                                        <th><strong>Dernière connexion</strong></th>
                                        <th><strong>Actions</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($user->profile_picture)
                                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" class="rounded-circle me-2" width="40" height="40" alt="">
                                                @else
                                                    <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <span class="font-w600">{{ $user->name }}</span>
                                                    <small class="d-block text-muted">Créé le {{ $user->created_at?->format('d/m/Y') }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->fonction ?? 'Non définie' }}</td>
                                        <td>
                                            <select class="form-select form-select-sm role-selector" data-user-id="{{ $user->id }}" style="width: 120px;">
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="editor" {{ $user->role === 'editor' ? 'selected' : '' }}>Éditeur</option>
                                                <option value="writer" {{ $user->role === 'writer' ? 'selected' : '' }}>Rédacteur</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input status-toggle" type="checkbox"
                                                       data-user-id="{{ $user->id }}"
                                                       {{ ($user->is_active ?? true) ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    <span class="status-text">{{ ($user->is_active ?? true) ? 'Actif' : 'Inactif' }}</span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            @if($user->last_login_at)
                                                {{ $user->last_login_at?->format('d/m/Y H:i') }}
                                            @else
                                                <span class="text-muted">Jamais</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info shadow btn-xs sharp me-1" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary shadow btn-xs sharp me-1" title="Modifier">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                @if($user->id !== auth()->id())
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger shadow btn-xs sharp" title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Aucun utilisateur trouvé</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $users->links() }}
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
    const changeRoleUrlTemplate = @json(route('admin.users.role', ['user' => '__ID__']));
    const toggleStatusUrlTemplate = @json(route('admin.users.toggle-status', ['user' => '__ID__']));

    // Gestion du changement de rôle
    document.querySelectorAll('.role-selector').forEach(function(select) {
        select.addEventListener('change', function() {
            const userId = this.dataset.userId;
            const newRole = this.value;

            const url = changeRoleUrlTemplate.replace('__ID__', userId);

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ role: newRole })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Afficher un message de succès
                    showAlert('success', data.message);
                } else {
                    // Remettre l'ancienne valeur et afficher l'erreur
                    this.value = this.dataset.originalValue;
                    showAlert('error', data.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showAlert('error', 'Une erreur est survenue');
            });
        });

        // Sauvegarder la valeur originale
        select.dataset.originalValue = select.value;
    });

    // Gestion du toggle de statut
    document.querySelectorAll('.status-toggle').forEach(function(toggle) {
        toggle.addEventListener('change', function() {
            const userId = this.dataset.userId;
            const statusText = this.closest('td').querySelector('.status-text');

            const url = toggleStatusUrlTemplate.replace('__ID__', userId);

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    statusText.textContent = data.is_active ? 'Actif' : 'Inactif';
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
    });

    // Confirmation de suppression
    document.querySelectorAll('.delete-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                this.submit();
            }
        });
    });

    // Fonction pour afficher les alertes
    function showAlert(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertHtml = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;

        // Insérer l'alerte au début du content-body
        const contentBody = document.querySelector('.content-body .container-fluid');
        contentBody.insertAdjacentHTML('afterbegin', alertHtml);

        // Auto-supprimer après 5 secondes
        setTimeout(function() {
            const alert = contentBody.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }, 5000);
    }
});
</script>

@endsection
