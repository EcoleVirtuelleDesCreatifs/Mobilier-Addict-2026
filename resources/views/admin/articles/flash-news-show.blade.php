@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Détails de la Flash News</h4>
                    <p class="mb-0">Informations complètes du message flash</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.flash-news.index') }}">Flash News</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Détails</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Message Flash</h4>
                        <div class="card-action">
                            <a href="{{ route('admin.flash-news.edit', $flashNews) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i> Modifier
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-{{ $flashNews->is_active ? 'success' : 'secondary' }}">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-{{ $flashNews->is_active ? 'check-circle' : 'pause-circle' }} fa-2x mr-3"></i>
                                <div>
                                    <h5 class="mb-1">{{ $flashNews->message }}</h5>
                                    <small>
                                        Statut: {{ $flashNews->is_active ? 'Actif' : 'Inactif' }} |
                                        Position: {{ $flashNews->order }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h6>Aperçu d'affichage</h6>
                            <div class="border p-3 bg-light">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-flash text-warning mr-2"></i>
                                    <span class="text-dark">{{ $flashNews->message }}</span>
                                </div>
                            </div>
                            <small class="text-muted">Aperçu de l'affichage sur le site web</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informations</h4>
                    </div>
                    <div class="card-body">
                        <div class="profile-statistics">
                            <div class="text-center border-bottom-1 pb-3">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="m-b-0">{{ $flashNews->order }}</h3>
                                        <span class="text-muted">Position</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="media align-items-center mb-3">
                                <span class="mr-3 align-items-center justify-content-center d-flex" style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 50%;">
                                    <i class="fa fa-{{ $flashNews->is_active ? 'check' : 'times' }} text-{{ $flashNews->is_active ? 'success' : 'secondary' }}"></i>
                                </span>
                                <div class="media-body">
                                    <h6 class="mb-0">Statut</h6>
                                    <span class="text-muted">{{ $flashNews->is_active ? 'Actif' : 'Inactif' }}</span>
                                </div>
                            </div>

                            <div class="media align-items-center mb-3">
                                <span class="mr-3 align-items-center justify-content-center d-flex" style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 50%;">
                                    <i class="fa fa-sort-numeric-asc text-primary"></i>
                                </span>
                                <div class="media-body">
                                    <h6 class="mb-0">Ordre d'affichage</h6>
                                    <span class="text-muted">Position {{ $flashNews->order }}</span>
                                </div>
                            </div>

                            <div class="media align-items-center mb-3">
                                <span class="mr-3 align-items-center justify-content-center d-flex" style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 50%;">
                                    <i class="fa fa-clock-o text-success"></i>
                                </span>
                                <div class="media-body">
                                    <h6 class="mb-0">Créé le</h6>
                                    <span class="text-muted">{{ $flashNews->created_at->format('d/m/Y à H:i') }}</span>
                                </div>
                            </div>

                            <div class="media align-items-center mb-3">
                                <span class="mr-3 align-items-center justify-content-center d-flex" style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 50%;">
                                    <i class="fa fa-refresh text-warning"></i>
                                </span>
                                <div class="media-body">
                                    <h6 class="mb-0">Modifié le</h6>
                                    <span class="text-muted">{{ $flashNews->updated_at->format('d/m/Y à H:i') }}</span>
                                </div>
                            </div>

                            <div class="media align-items-center mb-3">
                                <span class="mr-3 align-items-center justify-content-center d-flex" style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 50%;">
                                    <i class="fa fa-font text-info"></i>
                                </span>
                                <div class="media-body">
                                    <h6 class="mb-0">Longueur</h6>
                                    <span class="text-muted">{{ strlen($flashNews->message) }} caractères</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.flash-news.edit', $flashNews) }}" class="btn btn-warning btn-block mb-2">
                                <i class="fa fa-edit"></i> Modifier
                            </a>
                            <button type="button"
                                    class="btn btn-{{ $flashNews->is_active ? 'secondary' : 'success' }} btn-block mb-2 toggle-status"
                                    data-id="{{ $flashNews->id }}">
                                <i class="fa fa-{{ $flashNews->is_active ? 'pause' : 'play' }}"></i>
                                {{ $flashNews->is_active ? 'Désactiver' : 'Activer' }}
                            </button>
                            <form action="{{ route('admin.flash-news.destroy', $flashNews) }}"
                                  method="POST"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette flash news ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block">
                                    <i class="fa fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <a href="{{ route('admin.flash-news.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion du toggle de statut
    document.querySelector('.toggle-status')?.addEventListener('click', function() {
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
                // Recharger la page pour mettre à jour l'affichage
                location.reload();
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        });
    });
});
</script>
@endsection
