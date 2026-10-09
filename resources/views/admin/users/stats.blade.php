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
                        <h1 class="text-black font-w600 mb-1">Statistiques des Utilisateurs</h1>
                        <p class="mb-0">Analyse et répartition des utilisateurs du système</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques principales -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-primary card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ number_format($totalUsers) }}</h2>
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
                                <h2 class="num-text text-black font-w700">{{ number_format($adminCount) }}</h2>
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
                                <h2 class="num-text text-black font-w700">{{ number_format($editorCount) }}</h2>
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
                                <h2 class="num-text text-black font-w700">{{ number_format($writerCount) }}</h2>
                                <span class="fs-14">Rédacteurs</span>
                            </div>
                            <i class="fas fa-user-pen text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphiques et analyses -->
        <div class="row mb-4">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Répartition des rôles</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <canvas id="rolesChart" width="400" height="200"></canvas>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>Rôle</th>
                                                <th>Nombre</th>
                                                <th>Pourcentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span class="badge badge-success">Administrateurs</span>
                                                </td>
                                                <td>{{ $adminCount }}</td>
                                                <td>{{ $totalUsers > 0 ? round(($adminCount / $totalUsers) * 100, 1) : 0 }}%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="badge badge-warning">Éditeurs</span>
                                                </td>
                                                <td>{{ $editorCount }}</td>
                                                <td>{{ $totalUsers > 0 ? round(($editorCount / $totalUsers) * 100, 1) : 0 }}%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="badge badge-info">Rédacteurs</span>
                                                </td>
                                                <td>{{ $writerCount }}</td>
                                                <td>{{ $totalUsers > 0 ? round(($writerCount / $totalUsers) * 100, 1) : 0 }}%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Utilisateurs récents</h4>
                    </div>
                    <div class="card-body">
                        @forelse($recentUsers as $user)
                        <div class="d-flex align-items-center mb-3">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" class="rounded-circle me-3" width="40" height="40" alt="">
                            @else
                                <div class="bg-secondary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{ $user->name }}</h6>
                                <small class="text-muted">{{ $user->email }}</small>
                                <div class="mt-1">
                                    <span class="badge badge-{{ $user->role === 'admin' ? 'success' : ($user->role === 'editor' ? 'warning' : 'info') }} badge-sm">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                    <small class="text-muted ms-2">{{ $user->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-3">
                            <i class="fas fa-users text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2">Aucun utilisateur récent</p>
                        </div>
                        @endforelse

                        @if($recentUsers->count() > 0)
                        <div class="text-center mt-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary btn-sm">
                                Voir tous les utilisateurs
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Actions rapides</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-user-plus me-2"></i>Créer un utilisateur
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-info btn-block">
                                    <i class="fas fa-list me-2"></i>Liste des utilisateurs
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button class="btn btn-warning btn-block" onclick="exportUsers()">
                                    <i class="fas fa-download me-2"></i>Exporter les données
                                </button>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button class="btn btn-secondary btn-block" onclick="refreshStats()">
                                    <i class="fas fa-sync me-2"></i>Actualiser
                                </button>
                            </div>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique en secteurs pour la répartition des rôles
    const ctx = document.getElementById('rolesChart').getContext('2d');
    const rolesChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Administrateurs', 'Éditeurs', 'Rédacteurs'],
            datasets: [{
                data: [{{ $adminCount }}, {{ $editorCount }}, {{ $writerCount }}],
                backgroundColor: [
                    '#28a745', // Vert pour admin
                    '#ffc107', // Jaune pour editor
                    '#17a2b8'  // Bleu pour writer
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });
});

function exportUsers() {
    // Fonction pour exporter les données des utilisateurs
    window.location.href = '/in/admin/users/export';
}

function refreshStats() {
    // Actualiser la page
    window.location.reload();
}
</script>

@endsection
