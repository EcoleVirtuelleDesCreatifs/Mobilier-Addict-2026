@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Gestion des Offres d'Emploi</h4>
                    <p class="mb-0">Liste et gestion des offres d'emploi publiées</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Jobs</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Liste des Offres d'Emploi</h4>
                        <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> Créer une Offre
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

                        @if($jobs->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Titre du Poste</th>
                                            <th>Entreprise</th>
                                            <th>Localisation</th>
                                            <th width="120">Date Publication</th>
                                            <th width="80">Lien</th>
                                            <th width="150">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jobs as $job)
                                            <tr>
                                                <td>
                                                    <strong>{{ $job->title }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge badge-rounded badge-outline-primary">
                                                        {{ $job->company }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <i class="fa fa-map-marker text-muted mr-1"></i>
                                                    {{ $job->location }}
                                                </td>
                                                <td>
                                                    <span class="badge badge-rounded badge-outline-info">
                                                        {{ $job->posted_at->format('d/m/Y') }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    @if($job->link)
                                                        <a href="{{ $job->link }}" target="_blank"
                                                           class="btn btn-outline-success btn-xs" title="Voir l'offre">
                                                            <i class="fa fa-external-link"></i>
                                                        </a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('admin.jobs.show', $job) }}"
                                                           class="btn btn-info btn-xs mr-1" title="Voir">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.jobs.edit', $job) }}"
                                                           class="btn btn-warning btn-xs mr-1" title="Modifier">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.jobs.destroy', $job) }}"
                                                              method="POST" class="d-inline"
                                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette offre d\'emploi ?')">
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
                                {{ $jobs->links('pagination::bootstrap-5') }}
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fa fa-briefcase fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Aucune offre d'emploi trouvée</h5>
                                <p class="text-muted">Commencez par créer votre première offre d'emploi.</p>
                                <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Créer une Offre
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
