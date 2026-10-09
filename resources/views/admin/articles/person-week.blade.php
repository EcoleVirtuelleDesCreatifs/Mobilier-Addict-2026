@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Gestion des Personnes de la Semaine</h4>
                    <p class="mb-0">Liste et gestion des personnalités mises en avant</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Person Week</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Liste des Personnes de la Semaine</h4>
                        <a href="{{ route('admin.person-week.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> Créer une Personne
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

                        @if($personWeeks->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="80">Image</th>
                                            <th>Nom</th>
                                            <th>Bio (Extrait)</th>
                                            <th width="120">Semaine</th>
                                            <th width="80">Vues</th>
                                            <th width="80">Lien Bio</th>
                                            <th width="150">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($personWeeks as $person)
                                            <tr>
                                                <td class="text-center">
                                                    @if($person->image)
                                                        <img src="{{ asset('storage/' . $person->image) }}"
                                                             alt="{{ $person->name }}"
                                                             class="rounded-circle"
                                                             style="width: 50px; height: 50px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                                             style="width: 50px; height: 50px;">
                                                            <i class="fa fa-user text-white"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $person->name }}</strong>
                                                </td>
                                                <td>
                                                    <span class="text-muted">
                                                        {{ Str::limit($person->bio_excerpt, 80) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-rounded badge-outline-info">
                                                        {{ $person->week_date->format('d/m/Y') }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-rounded badge-outline-success">
                                                        {{ number_format($person->views) }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    @if($person->link_bio)
                                                        <a href="{{ $person->link_bio }}" target="_blank"
                                                           class="btn btn-outline-primary btn-xs" title="Voir la bio complète">
                                                            <i class="fa fa-external-link"></i>
                                                        </a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('admin.person-week.show', $person) }}"
                                                           class="btn btn-info btn-xs mr-1" title="Voir">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.person-week.edit', $person) }}"
                                                           class="btn btn-warning btn-xs mr-1" title="Modifier">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.person-week.destroy', $person) }}"
                                                              method="POST" class="d-inline"
                                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette personne de la semaine ?')">
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
                                {{ $personWeeks->links('pagination::bootstrap-5') }}
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fa fa-users fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Aucune personne de la semaine trouvée</h5>
                                <p class="text-muted">Commencez par créer votre première personnalité de la semaine.</p>
                                <a href="{{ route('admin.person-week.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Créer une Personne
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
