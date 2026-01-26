@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Modifier une Flash News</h4>
                    <p class="mb-0">Édition du message flash</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.flash-news.index') }}">Flash News</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Modifier</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modifier: {{ Str::limit($flashNews->message, 50) }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i>
                            <strong>Information:</strong> Cette flash news est actuellement {{ $flashNews->is_active ? 'active' : 'inactive' }} et a été créée le {{ $flashNews->created_at->format('d/m/Y à H:i') }}.
                        </div>

                        <form action="{{ route('admin.flash-news.update', $flashNews) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="message">Message <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('message') is-invalid @enderror" 
                                               id="message" 
                                               name="message" 
                                               value="{{ old('message', $flashNews->message) }}" 
                                               placeholder="Ex: Nouvelle mise à jour du site disponible !"
                                               maxlength="255"
                                               required>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Maximum 255 caractères</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="order">Ordre d'affichage <span class="text-danger">*</span></label>
                                        <select class="form-control @error('order') is-invalid @enderror" 
                                                id="order" 
                                                name="order" 
                                                required>
                                            @for($i = 1; $i <= 8; $i++)
                                                <option value="{{ $i }}" {{ old('order', $flashNews->order) == $i ? 'selected' : '' }}>
                                                    Position {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Position d'affichage (1 à 8)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" 
                                           class="form-check-input" 
                                           id="is_active" 
                                           name="is_active" 
                                           value="1" 
                                           {{ old('is_active', $flashNews->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Activer cette flash news
                                    </label>
                                </div>
                                <small class="form-text text-muted">Si coché, la flash news sera visible sur le site</small>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Mettre à jour
                                </button>
                                <a href="{{ route('admin.flash-news.index') }}" class="btn btn-secondary ml-2">
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
