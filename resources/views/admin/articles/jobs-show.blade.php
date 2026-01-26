@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Détails de l'Offre d'Emploi</h4>
                    <p class="mb-0">Informations complètes de l'offre</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jobs.index') }}">Jobs</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Détails</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $job->title }}</h4>
                        <div class="card-action">
                            <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i> Modifier
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="media align-items-center mb-3">
                                    <span class="mr-3 align-items-center justify-content-center d-flex" style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 50%;">
                                        <i class="fa fa-building text-primary"></i>
                                    </span>
                                    <div class="media-body">
                                        <h6 class="mb-0">Entreprise</h6>
                                        <span class="text-muted">{{ $job->company }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="media align-items-center mb-3">
                                    <span class="mr-3 align-items-center justify-content-center d-flex" style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 50%;">
                                        <i class="fa fa-map-marker text-success"></i>
                                    </span>
                                    <div class="media-body">
                                        <h6 class="mb-0">Localisation</h6>
                                        <span class="text-muted">{{ $job->location }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Description du poste</h5>
                            <div class="text-muted" style="white-space: pre-line;">{{ $job->description }}</div>
                        </div>

                        @if($job->link)
                            <div class="mt-4">
                                <a href="{{ $job->link }}" target="_blank" class="btn btn-outline-primary">
                                    <i class="fa fa-external-link"></i> Voir l'offre complète
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informations</h4>
                    </div>
                    <div class="card-body">
                        <div class="mt-4">
                            <div class="media align-items-center mb-3">
                                <span class="mr-3 align-items-center justify-content-center d-flex" style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 50%;">
                                    <i class="fa fa-calendar text-primary"></i>
                                </span>
                                <div class="media-body">
                                    <h6 class="mb-0">Date de publication</h6>
                                    <span class="text-muted">{{ $job->posted_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            
                            <div class="media align-items-center mb-3">
                                <span class="mr-3 align-items-center justify-content-center d-flex" style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 50%;">
                                    <i class="fa fa-clock-o text-success"></i>
                                </span>
                                <div class="media-body">
                                    <h6 class="mb-0">Créé le</h6>
                                    <span class="text-muted">{{ $job->created_at->format('d/m/Y à H:i') }}</span>
                                </div>
                            </div>
                            
                            <div class="media align-items-center mb-3">
                                <span class="mr-3 align-items-center justify-content-center d-flex" style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 50%;">
                                    <i class="fa fa-refresh text-warning"></i>
                                </span>
                                <div class="media-body">
                                    <h6 class="mb-0">Modifié le</h6>
                                    <span class="text-muted">{{ $job->updated_at->format('d/m/Y à H:i') }}</span>
                                </div>
                            </div>

                            @if($job->link)
                                <div class="media align-items-center mb-3">
                                    <span class="mr-3 align-items-center justify-content-center d-flex" style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 50%;">
                                        <i class="fa fa-link text-info"></i>
                                    </span>
                                    <div class="media-body">
                                        <h6 class="mb-0">Lien externe</h6>
                                        <a href="{{ $job->link }}" target="_blank" class="text-primary">
                                            <small>{{ Str::limit($job->link, 30) }}</small>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-warning btn-block mb-2">
                                <i class="fa fa-edit"></i> Modifier
                            </a>
                            <form action="{{ route('admin.jobs.destroy', $job) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette offre d\'emploi ?')">
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
                    <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
