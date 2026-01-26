@extends('layouts.admin')

@section('content')
<style>
/* Point clignotant pour statut En ligne */
.blinking-green-dot {
    height: 10px;
    width: 10px;
    background-color: #28a745; /* vert bootstrap */
    border-radius: 50%;
    display: inline-block;
    margin-right: 5px;
    animation: blink 1.2s infinite;
    vertical-align: middle;
}

@keyframes blink {
    0%, 50%, 100% { opacity: 1; }
    25%, 75% { opacity: 0; }
}
</style>
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
                        <h1 class="text-black font-w600 mb-1">Espace Éditeur</h1>
                        <p class="mb-0">Bonjour {{ $user->name }}, gérez et supervisez le contenu éditorial</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary me-2">
                            <i class="fas fa-plus me-2"></i>Nouvel Article
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-folder me-2"></i>Catégories
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques générales -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-primary card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ number_format($totalArticles) }}</h2>
                                <span class="fs-14">Total Articles</span>
                            </div>
                            <i class="fas fa-newspaper text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-success card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ number_format($publishedArticles) }}</h2>
                                <span class="fs-14">Articles Publiés</span>
                            </div>
                            <i class="fas fa-check-circle text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-warning card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ number_format($draftArticles) }}</h2>
                                <span class="fs-14">Brouillons</span>
                            </div>
                            <i class="fas fa-edit text-warning" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-info card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ number_format($totalCategories) }}</h2>
                                <span class="fs-14">Catégories</span>
                            </div>
                            <i class="fas fa-folder text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Mes Articles Récents</h4>
                    </div>
                    <div class="card-body">
                        @if($recentArticles->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th><strong>Titre</strong></th>
                                        <th><strong>Catégorie</strong></th>
                                        <th><strong>Statut</strong></th>
                                        <th><strong>Vues</strong></th>
                                        <th><strong>Date</strong></th>
                                        <th><strong>Actions</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentArticles as $article)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($article->image)
                                                    <img src="{{ asset('storage/' . $article->image) }}" class="rounded me-3" width="40" height="40" alt="">
                                                @else
                                                    <div class="bg-secondary rounded me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                        <i class="fas fa-newspaper text-white"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ Str::limit($article->title, 50) }}</h6>
                                                    <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($article->category)
                                                <span class="badge badge-primary">{{ $article->category->title }}</span>
                                            @else
                                                <span class="text-muted">Aucune</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = match ($article->status) {
                                                    'published' => 'badge badge-rounded badge-outline-primary',
                                                    'draft' => 'badge badge-rounded badge-outline-danger',
                                                    default => 'badge badge-rounded badge-outline-secondary',
                                                };

                                                $statusLabel = match ($article->status) {
                                                    'published' => 'En ligne',
                                                    'draft' => 'Brouillon',
                                                    default => ucfirst($article->status),
                                                };
                                            @endphp

                                            <span class="{{ $statusClass }}">
                                                @if ($article->status === 'published')
                                                    <span class="blinking-green-dot"></span>
                                                @endif
                                                {{ $statusLabel }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-primary">{{ number_format($article->views ?? 0) }}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $article->created_at?->format('d/m/Y') }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.articles.show', $article) }}" 
                                                   class="btn btn-primary shadow btn-xs sharp me-1" 
                                                   title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.articles.edit', $article) }}" 
                                                   class="btn btn-primary shadow btn-xs sharp" 
                                                   title="Modifier">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-4">
                            <i class="fas fa-newspaper text-muted" style="font-size: 3rem;"></i>
                            <h4 class="mt-3 text-muted">Aucun article</h4>
                            <p class="text-muted">Vous n'avez pas encore créé d'articles.</p>
                            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Créer un article
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-12">
                <!-- Articles en attente -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Articles en Attente</h4>
                        <small class="text-muted">Articles à valider</small>
                    </div>
                    <div class="card-body">
                        @if($pendingArticles->count() > 0)
                        @foreach($pendingArticles as $article)
                        <div class="d-flex align-items-center mb-3 p-2 border rounded">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" class="rounded me-3" width="40" height="40" alt="">
                            @else
                                <div class="bg-warning rounded me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{ Str::limit($article->title, 25) }}</h6>
                                <small class="text-muted">Par {{ $article->user->name ?? 'Inconnu' }}</small>
                                <div class="mt-1">
                                    <span class="badge badge-warning badge-sm">Brouillon</span>
                                    <small class="text-muted ms-2">{{ $article->created_at?->format('d/m') }}</small>
                                </div>
                            </div>
                            <div class="ms-2">
                                <a href="{{ route('admin.articles.show', $article) }}" 
                                   class="btn btn-sm btn-outline-primary" 
                                   title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                        <div class="text-center mt-3">
                            <a href="{{ route('admin.articles.index') }}?status=draft" class="btn btn-sm btn-outline-warning">
                                Voir tous les brouillons
                            </a>
                        </div>
                        @else
                        <div class="text-center py-3">
                            <i class="fas fa-check-circle text-success" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2">Aucun article en attente</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="card-title">Actions Rapides</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Nouvel Article
                            </a>
                            <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-list me-2"></i>Tous les Articles
                            </a>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-info">
                                <i class="fas fa-folder me-2"></i>Gérer Catégories
                            </a>
                            <a href="{{ route('admin.profile') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-user me-2"></i>Mon Profil
                            </a>
                        </div>
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
