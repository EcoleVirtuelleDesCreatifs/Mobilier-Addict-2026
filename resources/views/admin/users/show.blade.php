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
                        <h1 class="text-black font-w600 mb-1">Profil Utilisateur</h1>
                        <p class="mb-0">Détails et statistiques de {{ $user->name }}</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary me-2">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations principales -->
        <div class="row mb-4">
            <div class="col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-body text-center">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                                 class="rounded-circle mb-3" width="120" height="120" alt="Photo de profil">
                        @else
                            <div class="bg-secondary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                                 style="width: 120px; height: 120px;">
                                <i class="fas fa-user text-white" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        
                        <h4 class="text-black font-w600">{{ $user->name }}</h4>
                        <p class="text-muted">{{ $user->email }}</p>
                        
                        <div class="row text-center mt-4">
                            <div class="col-4">
                                <span class="badge badge-{{ $user->role === 'admin' ? 'success' : ($user->role === 'editor' ? 'warning' : 'info') }} badge-lg">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                            <div class="col-4">
                                <span class="badge badge-{{ ($user->is_active ?? true) ? 'success' : 'danger' }} badge-lg">
                                    {{ ($user->is_active ?? true) ? 'Actif' : 'Inactif' }}
                                </span>
                            </div>
                            <div class="col-4">
                                <span class="badge badge-secondary badge-lg">
                                    {{ $user->articles->count() }} Articles
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informations détaillées</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Nom complet:</strong><br>
                                <span class="text-muted">{{ $user->name }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Adresse email:</strong><br>
                                <span class="text-muted">{{ $user->email }}</span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Fonction:</strong><br>
                                <span class="text-muted">{{ $user->fonction ?? 'Non définie' }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Rôle:</strong><br>
                                <span class="text-muted">{{ ucfirst($user->role) }}</span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Compte créé le:</strong><br>
                                <span class="text-muted">{{ $user->created_at?->format('d/m/Y à H:i') }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Dernière modification:</strong><br>
                                <span class="text-muted">{{ $user->updated_at?->format('d/m/Y à H:i') }}</span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Dernière connexion:</strong><br>
                                <span class="text-muted">
                                    @if($user->last_login_at)
                                        {{ $user->last_login_at?->format('d/m/Y à H:i') }}
                                    @else
                                        Jamais connecté
                                    @endif
                                </span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Statut du compte:</strong><br>
                                <span class="badge badge-{{ ($user->is_active ?? true) ? 'success' : 'danger' }}">
                                    {{ ($user->is_active ?? true) ? 'Actif' : 'Inactif' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques et articles -->
        <div class="row">
            <div class="col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Statistiques</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-12 mb-3">
                                <div class="bg-primary rounded p-3">
                                    <h3 class="text-white mb-0">{{ $user->articles->count() }}</h3>
                                    <small class="text-white">Articles publiés</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="bg-success rounded p-2">
                                    <h5 class="text-white mb-0">{{ $user->articles->where('status', 'published')->count() }}</h5>
                                    <small class="text-white">Publiés</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="bg-warning rounded p-2">
                                    <h5 class="text-white mb-0">{{ $user->articles->where('status', 'draft')->count() }}</h5>
                                    <small class="text-white">Brouillons</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row text-center">
                            <div class="col-12">
                                <div class="bg-info rounded p-2">
                                    <h5 class="text-white mb-0">{{ $user->articles->where('is_featured', true)->count() }}</h5>
                                    <small class="text-white">Articles en vedette</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Articles récents</h4>
                    </div>
                    <div class="card-body">
                        @if($user->articles->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>Titre</th>
                                            <th>Statut</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->articles->take(5) as $article)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($article->image)
                                                        <img src="{{ asset('storage/' . $article->image) }}" class="rounded me-2" width="30" height="30" alt="">
                                                    @else
                                                        <div class="bg-secondary rounded me-2 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                                            <i class="fas fa-newspaper text-white" style="font-size: 0.8rem;"></i>
                                                        </div>
                                                    @endif
                                                    <span>{{ Str::limit($article->title, 40) }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $article->status === 'published' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($article->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $article->created_at?->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-primary shadow btn-xs sharp">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            @if($user->articles->count() > 5)
                                <div class="text-center mt-3">
                                    <a href="{{ route('admin.articles.index', ['user' => $user->id]) }}" class="btn btn-outline-primary">
                                        Voir tous les articles ({{ $user->articles->count() }})
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-newspaper text-muted" style="font-size: 3rem;"></i>
                                <h5 class="text-muted mt-3">Aucun article</h5>
                                <p class="text-muted">Cet utilisateur n'a pas encore publié d'articles.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->

@endsection
