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
                        <h1 class="text-black font-w600 mb-1">Détails de l'Article</h1>
                        <p class="mb-0">Visualisation complète de l'article</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-primary me-2">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                        @if(auth()->user()->role === 'admin' || $article->user_id === auth()->id())
                            <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>Modifier
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Image de l'article -->
                        @if($article->image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $article->image) }}"
                                 class="img-fluid rounded"
                                 alt="{{ $article->title }}"
                                 style="max-height: 400px; width: 100%; object-fit: cover;">
                        </div>
                        @endif

                        <!-- Titre -->
                        <h2 class="text-black font-w600 mb-3">{{ $article->title }}</h2>

                        <!-- Extrait -->
                        @if($article->excerpt)
                        <div class="alert alert-info mb-4">
                            <h5 class="mb-2"><i class="fas fa-quote-left me-2"></i>Extrait</h5>
                            <p class="mb-0">{{ $article->excerpt }}</p>
                        </div>
                        @endif

                        <!-- Contenu -->
                        <div class="article-content">
                            <h5 class="mb-3"><i class="fas fa-file-alt me-2"></i>Contenu</h5>
                            <div class="content-text" style="color: #fff;">
                                {!! nl2br(e($article->content)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-12">
                <!-- Informations de l'article -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informations</h4>
                    </div>
                    <div class="card-body">
                        <!-- Statut -->
                        <div class="mb-3">
                            <label class="form-label font-w600">Statut</label>
                            <div>
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

                                <span class="{{ $statusClass }} badge-lg">
                                    @if ($article->status === 'published')
                                        <span class="blinking-green-dot"></span>
                                    @endif
                                    {{ $statusLabel }}
                                </span>
                            </div>
                        </div>

                        <!-- Auteur -->
                        <div class="mb-3">
                            <label class="form-label font-w600">Auteur</label>
                            <div class="d-flex align-items-center">
                                @if($article->user && $article->user->profile_picture)
                                    <img src="{{ asset('storage/' . $article->user->profile_picture) }}"
                                         class="rounded-circle me-2"
                                         width="30" height="30"
                                         alt="{{ $article->user->name }}">
                                @else
                                    <div class="bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center"
                                         style="width: 30px; height: 30px;">
                                        <i class="fas fa-user text-white" style="font-size: 12px;"></i>
                                    </div>
                                @endif
                                <span>{{ $article->user->name ?? 'Auteur inconnu' }}</span>
                            </div>
                        </div>

                        <!-- Catégorie -->
                        <div class="mb-3">
                            <label class="form-label font-w600">Catégorie</label>
                            <div>
                                @if($article->category)
                                    <span class="badge badge-primary">
                                        <i class="fas fa-folder me-1"></i>{{ $article->category->title }}
                                    </span>
                                @else
                                    <span class="text-muted">Aucune catégorie</span>
                                @endif
                            </div>
                        </div>

                        <!-- Article vedette -->
                        <div class="mb-3">
                            <label class="form-label font-w600">Article vedette</label>
                            <div>
                                @if($article->is_featured)
                                    <span class="badge badge-warning">
                                        <i class="fas fa-star me-1"></i>Oui
                                    </span>
                                @else
                                    <span class="text-muted">Non</span>
                                @endif
                            </div>
                        </div>

                        <!-- Statistiques -->
                        <div class="mb-3">
                            <label class="form-label font-w600">Vues</label>
                            <div>
                                <span class="badge badge-info">
                                    <i class="fas fa-eye me-1"></i>{{ number_format($article->views ?? 0) }} vues
                                </span>
                            </div>
                        </div>

                        <!-- Dates -->
                        <div class="mb-3">
                            <label class="form-label font-w600">Créé le</label>
                            <div>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $article->created_at->format('d/m/Y à H:i') }}
                                </small>
                            </div>
                        </div>

                        @if($article->updated_at && $article->updated_at != $article->created_at)
                        <div class="mb-3">
                            <label class="form-label font-w600">Modifié le</label>
                            <div>
                                <small class="text-muted">
                                    <i class="fas fa-edit me-1"></i>
                                    {{ $article->updated_at->format('d/m/Y à H:i') }}
                                </small>
                            </div>
                        </div>
                        @endif

                        @if($article->published_at)
                        <div class="mb-3">
                            <label class="form-label font-w600">Publié le</label>
                            <div>
                                <small class="text-muted">
                                    <i class="fas fa-globe me-1"></i>
                                    {{ $article->published_at->format('d/m/Y à H:i') }}
                                </small>
                            </div>
                        </div>
                        @endif

                        <!-- Slug -->
                        <div class="mb-3">
                            <label class="form-label font-w600">Slug (URL)</label>
                            <div>
                                <code class="text-primary">{{ $article->slug }}</code>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="card-title">Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            @if(auth()->user()->role === 'admin' || $article->user_id === auth()->id())
                                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-2"></i>Modifier l'article
                                </a>
                            @endif

                            <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-list me-2"></i>Tous les articles
                            </a>

                            @if($article->status === 'published')
                                <a href="#" class="btn btn-outline-info" onclick="alert('Lien vers l\'article public : {{ url('/article/' . $article->slug) }}')">
                                    <i class="fas fa-external-link-alt me-2"></i>Voir sur le site
                                </a>
                            @endif
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

<style>
.article-content .content-text {
    line-height: 1.8;
    font-size: 16px;
    color: #333;
}

.badge-lg {
    font-size: 14px;
    padding: 8px 12px;
}

code {
    background-color: #f8f9fa;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
}

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

@endsection
