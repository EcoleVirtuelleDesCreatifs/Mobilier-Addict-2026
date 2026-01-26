@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Détails de la Personne de la Semaine</h4>
                    <p class="mb-0">Informations complètes de la personnalité</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.person-week.index') }}">Person Week</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Détails</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $personWeek->name }}</h4>
                        <div class="card-action">
                            <a href="{{ route('admin.person-week.edit', $personWeek) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i> Modifier
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                @if($personWeek->image)
                                    <img src="{{ asset('storage/' . $personWeek->image) }}" 
                                         alt="{{ $personWeek->name }}" 
                                         class="img-fluid rounded-circle mb-3" 
                                         style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                         style="width: 200px; height: 200px;">
                                        <i class="fa fa-user fa-5x text-white"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h5 class="mb-3">Biographie</h5>
                                <p class="text-muted">{{ $personWeek->bio_excerpt }}</p>
                                
                                @if($personWeek->link_bio)
                                    <div class="mt-3">
                                        <a href="{{ $personWeek->link_bio }}" target="_blank" class="btn btn-outline-primary">
                                            <i class="fa fa-external-link"></i> Voir la biographie complète
                                        </a>
                                    </div>
                                @endif
                            </div>
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
                                        <h3 class="m-b-0">{{ number_format($personWeek->views) }}</h3>
                                        <span class="text-muted">Vues</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <div class="media align-items-center mb-3">
                                <span class="mr-3 align-items-center justify-content-center d-flex" style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 50%;">
                                    <i class="fa fa-calendar text-primary"></i>
                                </span>
                                <div class="media-body">
                                    <h6 class="mb-0">Semaine du</h6>
                                    <span class="text-muted">{{ $personWeek->week_date->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            
                            <div class="media align-items-center mb-3">
                                <span class="mr-3 align-items-center justify-content-center d-flex" style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 50%;">
                                    <i class="fa fa-clock-o text-success"></i>
                                </span>
                                <div class="media-body">
                                    <h6 class="mb-0">Créé le</h6>
                                    <span class="text-muted">{{ $personWeek->created_at->format('d/m/Y à H:i') }}</span>
                                </div>
                            </div>
                            
                            <div class="media align-items-center mb-3">
                                <span class="mr-3 align-items-center justify-content-center d-flex" style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 50%;">
                                    <i class="fa fa-refresh text-warning"></i>
                                </span>
                                <div class="media-body">
                                    <h6 class="mb-0">Modifié le</h6>
                                    <span class="text-muted">{{ $personWeek->updated_at->format('d/m/Y à H:i') }}</span>
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
                            <a href="{{ route('admin.person-week.edit', $personWeek) }}" class="btn btn-warning btn-block mb-2">
                                <i class="fa fa-edit"></i> Modifier
                            </a>
                            <form action="{{ route('admin.person-week.destroy', $personWeek) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette personne de la semaine ?')">
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
                    <a href="{{ route('admin.person-week.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
