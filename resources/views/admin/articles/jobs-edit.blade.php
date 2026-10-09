@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Modifier une Offre d'Emploi</h4>
                    <p class="mb-0">Édition des informations de l'offre</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jobs.index') }}">Jobs</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Modifier</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modifier: {{ $job->title }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i>
                            <strong>Information:</strong> Cette offre a été créée le {{ $job->created_at->format('d/m/Y à H:i') }} et publiée le {{ $job->posted_at->format('d/m/Y') }}.
                        </div>

                        <form action="{{ route('admin.jobs.update', $job) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Titre du poste <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('title') is-invalid @enderror" 
                                               id="title" 
                                               name="title" 
                                               value="{{ old('title', $job->title) }}" 
                                               placeholder="Ex: Développeur Full Stack"
                                               required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company">Entreprise <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('company') is-invalid @enderror" 
                                               id="company" 
                                               name="company" 
                                               value="{{ old('company', $job->company) }}" 
                                               placeholder="Ex: Orange Côte d'Ivoire"
                                               required>
                                        @error('company')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Localisation <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('location') is-invalid @enderror" 
                                               id="location" 
                                               name="location" 
                                               value="{{ old('location', $job->location) }}" 
                                               placeholder="Ex: Abidjan, Plateau"
                                               required>
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="posted_at">Date de publication <span class="text-danger">*</span></label>
                                        <input type="date" 
                                               class="form-control @error('posted_at') is-invalid @enderror" 
                                               id="posted_at" 
                                               name="posted_at" 
                                               value="{{ old('posted_at', $job->posted_at->format('Y-m-d')) }}" 
                                               required>
                                        @error('posted_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="link">Lien vers l'offre complète <span class="text-danger">*</span></label>
                                <input type="url" 
                                       class="form-control @error('link') is-invalid @enderror" 
                                       id="link" 
                                       name="link" 
                                       value="{{ old('link', $job->link) }}" 
                                       placeholder="https://exemple.com/offre-emploi"
                                       required>
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Lien obligatoire vers l'offre complète ou la page de candidature</small>
                            </div>

                            <div class="form-group">
                                <label for="description">Description du poste</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="6" 
                                          placeholder="Description détaillée du poste, missions, profil recherché, etc. (optionnel)">{{ old('description', $job->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Description optionnelle du poste</small>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Mettre à jour
                                </button>
                                <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary ml-2">
                                    <i class="fa fa-times"></i> Annuler
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
