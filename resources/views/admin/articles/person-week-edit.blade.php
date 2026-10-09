@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Modifier une Personne de la Semaine</h4>
                    <p class="mb-0">Édition des informations de la personnalité</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.person-week.index') }}">Person Week</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Modifier</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modifier: {{ $personWeek->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i>
                            <strong>Information:</strong> Cette personne a été vue {{ number_format($personWeek->views) }} fois depuis sa création.
                        </div>

                        <form action="{{ route('admin.person-week.update', $personWeek) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nom complet <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', $personWeek->name) }}" 
                                               placeholder="Ex: Dr. Alassane Ouattara"
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="week_date">Date de la semaine <span class="text-danger">*</span></label>
                                        <input type="date" 
                                               class="form-control @error('week_date') is-invalid @enderror" 
                                               id="week_date" 
                                               name="week_date" 
                                               value="{{ old('week_date', $personWeek->week_date->format('Y-m-d')) }}" 
                                               required>
                                        @error('week_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="bio_excerpt">Biographie (Extrait) <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('bio_excerpt') is-invalid @enderror" 
                                          id="bio_excerpt" 
                                          name="bio_excerpt" 
                                          rows="4" 
                                          placeholder="Résumé de la biographie de la personnalité (max 500 caractères)"
                                          maxlength="500"
                                          required>{{ old('bio_excerpt', $personWeek->bio_excerpt) }}</textarea>
                                @error('bio_excerpt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Maximum 500 caractères</small>
                            </div>

                            <div class="form-group">
                                <label for="link_bio">Lien vers biographie complète</label>
                                <input type="url" 
                                       class="form-control @error('link_bio') is-invalid @enderror" 
                                       id="link_bio" 
                                       name="link_bio" 
                                       value="{{ old('link_bio', $personWeek->link_bio) }}" 
                                       placeholder="https://exemple.com/biographie-complete">
                                @error('link_bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Lien optionnel vers une biographie détaillée</small>
                            </div>

                            <div class="form-group">
                                <label for="image">Photo de profil</label>
                                @if($personWeek->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $personWeek->image) }}" 
                                             alt="{{ $personWeek->name }}" 
                                             class="img-thumbnail" 
                                             style="max-width: 150px; max-height: 150px;">
                                        <p class="text-muted mt-1">Image actuelle</p>
                                    </div>
                                @endif
                                <input type="file" 
                                       class="form-control-file @error('image') is-invalid @enderror" 
                                       id="image" 
                                       name="image" 
                                       accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Formats acceptés: JPEG, PNG, JPG, GIF. Taille max: 2MB.
                                    @if($personWeek->image) Laissez vide pour conserver l'image actuelle. @endif
                                </small>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Mettre à jour
                                </button>
                                <a href="{{ route('admin.person-week.index') }}" class="btn btn-secondary ml-2">
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
