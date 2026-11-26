@extends('layouts.admin')

@push('styles')
<style>
    .al-thumb{width:84px;height:60px;border-radius:10px;object-fit:cover;border:1px solid var(--admin-border);background:var(--admin-bg-subtle)}
    .al-thumb-missing{display:grid;place-items:center;width:84px;height:60px;border-radius:10px;border:1px dashed var(--admin-border);font-size:11px;line-height:1.2;text-align:center;color:var(--admin-muted)}
    .al-title{font-weight:600;color:inherit;text-decoration:none}
    .al-title:hover{color:#F0286E}
    .al-pill{display:inline-flex;white-space:nowrap;align-items:center;gap:6px;padding:3px 10px;border-radius:999px;font-size:12px;font-weight:600}
    .al-pill.on{background:rgba(22,163,74,.12);color:#16a34a}
    .al-pill.off{background:rgba(100,116,139,.14);color:#64748b}
    .al-pill.on::before{content:'';width:7px;height:7px;border-radius:50%;background:currentColor}
    .al-kpis{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px}
    .al-kpi{padding:14px 16px;border-radius:14px;border:1px solid var(--admin-border);background:var(--admin-card-bg,#fff)}
    .al-kpi small{display:block;color:var(--admin-muted);font-size:12px}
    .al-kpi b{font-size:22px}
    .al-tabs{display:flex;flex-wrap:wrap;gap:6px}
    .al-tabs a{padding:6px 14px;border-radius:999px;border:1px solid var(--admin-border);font-size:13px;color:inherit;text-decoration:none}
    .al-tabs a.on{background:#0B1A3F;border-color:#0B1A3F;color:#fff}
    @media(max-width:767.98px){.al-kpis{grid-template-columns:1fr 1fr}}
</style>
@endpush

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h3 fw-bold mb-1">Articles du blog</h1>
                <div class="small" style="color: var(--admin-muted);">Conseils et actualités publiés sur le journal Mobilier Addict.</div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('blog.index') }}" target="_blank" rel="noopener" class="btn btn-admin-ghost">Voir le blog ↗</a>
                <a href="{{ route('admin.articles.create') }}" class="btn btn-admin-primary">+ Nouvel article</a>
            </div>
        </div>

        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

        <div class="al-kpis mb-3">
            <div class="al-kpi"><small>Articles</small><b>{{ $counts['all'] }}</b></div>
            <div class="al-kpi"><small>En ligne</small><b class="text-success">{{ $counts['published'] }}</b></div>
            <div class="al-kpi"><small>Brouillons</small><b>{{ $counts['draft'] }}</b></div>
            <div class="al-kpi"><small>Sans image</small><b class="{{ $counts['no_image'] ? 'text-warning' : '' }}">{{ $counts['no_image'] }}</b></div>
        </div>

        <div class="admin-card p-3 p-md-4">
            <form method="GET" class="d-flex flex-column flex-md-row gap-2 align-items-md-center justify-content-between mb-3">
                <nav class="al-tabs" aria-label="Filtrer par statut">
                    @foreach(['' => 'Tous', 'published' => 'En ligne', 'draft' => 'Brouillons'] as $value => $label)
                        <a href="{{ route('admin.articles.index', array_filter(['status' => $value, 'q' => request('q')])) }}" class="{{ (string) request('status', '') === $value ? 'on' : '' }}">{{ $label }}</a>
                    @endforeach
                </nav>
                <div class="d-flex gap-2">
                    @if(request('status'))<input type="hidden" name="status" value="{{ request('status') }}">@endif
                    <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Rechercher un titre…" style="min-width:240px">
                    <button class="btn btn-admin-ghost" type="submit">Rechercher</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead style="color: var(--admin-muted); font-size: 12px; text-transform: uppercase; letter-spacing: .04em;">
                        <tr><th>Article</th><th>Catégorie</th><th>Statut</th><th>Date</th><th class="text-end">Actions</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                            @php
                                $img = $article->image ? image_url($article->image) : null;
                                $hasImage = $img && ! str_contains($img, 'product-placeholder');
                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($hasImage)
                                            <img class="al-thumb" src="{{ $img }}" alt="" loading="lazy">
                                        @else
                                            <span class="al-thumb-missing" title="Ajoutez une image de couverture">Image<br>manquante</span>
                                        @endif
                                        <div style="min-width:0">
                                            <a class="al-title" href="{{ route('admin.articles.edit', $article) }}">{{ $article->title }}</a>
                                            <div class="small" style="color: var(--admin-muted);">
                                                {{ $article->user->name ?? 'Mobilier Addict' }} · {{ $article->reading_time ?: max(1, (int) ceil(str_word_count(strip_tags((string) $article->content)) / 200)) }} min de lecture
                                                @if($article->is_featured) · <span class="text-primary fw-semibold">À la une</span>@endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $article->category->name ?? '—' }}</td>
                                <td>
                                    @if($article->published_at && $article->is_active)
                                        <span class="al-pill on">En ligne</span>
                                    @else
                                        <span class="al-pill off">Brouillon</span>
                                    @endif
                                </td>
                                <td class="small text-nowrap">{{ ($article->published_at ?? $article->created_at)?->format('d/m/Y') }}</td>
                                <td class="text-end text-nowrap">
                                    @if($article->published_at && $article->is_active)
                                        <a href="{{ route('blog.show', $article->slug) }}" target="_blank" rel="noopener" class="btn btn-sm btn-admin-ghost" title="Voir sur le site"><i class="fas fa-eye"></i></a>
                                    @endif
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-admin-ghost" title="Modifier"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline" data-confirm="Supprimer définitivement « {{ $article->title }} » ?">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-5" style="color: var(--admin-muted);">
                                {{ request('q') || request('status') ? 'Aucun article ne correspond.' : 'Aucun article pour le moment.' }}
                                <a href="{{ route('admin.articles.create') }}" class="text-primary">Écrire un article</a>
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($articles->hasPages())<div class="mt-3">{{ $articles->links('pagination::bootstrap-5') }}</div>@endif
        </div>
    </div>
</div>
@endsection
