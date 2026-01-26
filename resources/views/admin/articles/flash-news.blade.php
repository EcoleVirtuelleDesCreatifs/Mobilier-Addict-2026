@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Gestion des Flash News</h4>
                    <p class="mb-0">Messages courts affichés en haut du site</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Flash News</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Liste des Flash News</h4>
                        <a href="{{ route('admin.flash-news.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> Créer une Flash News
                        </a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if($flashNews->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="60">Ordre</th>
                                            <th>Message</th>
                                            <th width="100">Statut</th>
                                            <th width="120">Créé le</th>
                                            <th width="150">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($flashNews as $flash)
                                            <tr>
                                                <td class="text-center">
                                                    <span class="badge badge-rounded badge-outline-primary">
                                                        {{ $flash->order }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <strong>{{ Str::limit($flash->message, 80) }}</strong>
                                                </td>
                                                <td class="text-center">
                                                    @if($flash->is_active)
                                                        <span class="badge badge-rounded badge-success">
                                                            <i class="fa fa-check"></i> Actif
                                                        </span>
                                                    @else
                                                        <span class="badge badge-rounded badge-secondary">
                                                            <i class="fa fa-times"></i> Inactif
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge badge-rounded badge-outline-info">
                                                        {{ $flash->created_at->format('d/m/Y') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('admin.flash-news.show', $flash) }}"
                                                           class="btn btn-info btn-xs mr-1" title="Voir">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.flash-news.edit', $flash) }}"
                                                           class="btn btn-warning btn-xs mr-1" title="Modifier">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-{{ $flash->is_active ? 'secondary' : 'success' }} btn-xs mr-1 toggle-status"
                                                                data-id="{{ $flash->id }}"
                                                                title="{{ $flash->is_active ? 'Désactiver' : 'Activer' }}">
                                                            <i class="fa fa-{{ $flash->is_active ? 'pause' : 'play' }}"></i>
                                                        </button>
                                                        <form action="{{ route('admin.flash-news.destroy', $flash) }}"
                                                              method="POST" class="d-inline"
                                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette flash news ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-xs" title="Supprimer">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-3">
                                {{ $flashNews->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fa fa-flash fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Aucune flash news trouvée</h5>
                                <p class="text-muted">Commencez par créer votre première flash news.</p>
                                <a href="{{ route('admin.flash-news.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Créer une Flash News
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion du toggle de statut
    document.querySelectorAll('.toggle-status').forEach(button => {
        button.addEventListener('click', function() {
            const flashId = this.dataset.id;
            const btn = this;

            fetch(`/in/admin/flash-news/${flashId}/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mettre à jour le bouton
                    if (data.is_active) {
                        btn.className = 'btn btn-secondary btn-xs mr-1 toggle-status';
                        btn.innerHTML = '<i class="fa fa-pause"></i>';
                        btn.title = 'Désactiver';
                        // Mettre à jour le badge de statut
                        btn.closest('tr').querySelector('td:nth-child(3)').innerHTML =
                            '<span class="badge badge-rounded badge-success"><i class="fa fa-check"></i> Actif</span>';
                    } else {
                        btn.className = 'btn btn-success btn-xs mr-1 toggle-status';
                        btn.innerHTML = '<i class="fa fa-play"></i>';
                        btn.title = 'Activer';
                        // Mettre à jour le badge de statut
                        btn.closest('tr').querySelector('td:nth-child(3)').innerHTML =
                            '<span class="badge badge-rounded badge-secondary"><i class="fa fa-times"></i> Inactif</span>';
                    }

                    // Afficher un message de succès
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue');
            });
        });
    });
});
</script>
@endsection
