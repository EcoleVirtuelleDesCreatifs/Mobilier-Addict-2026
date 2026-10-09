@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Nos Gammes par Menu</h1>
                    <div class="small" style="color: var(--admin-muted);">Gestion des sections "Nos gammes" de chaque menu.</div>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-admin-primary">Ajouter une catégorie</a>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="admin-card p-3 p-md-4 mb-3">
                <form method="GET" action="{{ route('admin.categories.index') }}" class="row g-2 align-items-end">
                    <div class="col-12 col-md-6">
                        <label class="form-label small" style="color: var(--admin-muted);">Recherche</label>
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Nom, slug">
                    </div>
                    <div class="col-12 col-md-auto">
                        <button type="submit" class="btn btn-admin-ghost">Filtrer</button>
                    </div>
                </form>
            </div>

            @foreach($menus as $menu)
                <div class="admin-card p-0 overflow-hidden mb-4">
                    <div class="p-4" style="background: var(--admin-bg-subtle); border-bottom: 1px solid var(--admin-border);">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="mb-1">
                                    <a href="{{ route('menu.show', $menu->slug) }}" target="_blank" class="text-decoration-none text-dark hover-primary">
                                        {{ $menu->name }}
                                        <i class="fas fa-external-link-alt small ms-2" style="color: var(--admin-muted);"></i>
                                    </a>
                                </h4>
                                <div class="small" style="color: var(--admin-muted);">{{ $menu->slug }}</div>
                            </div>
                            <div class="badge bg-primary">{{ $categoriesByMenu[$menu->id]?->count() ?? 0 }} catégories</div>
                        </div>
                    </div>
                    <div class="p-4">
                        @forelse($categoriesByMenu[$menu->id] ?? collect() as $category)
                            @include('admin.categories.partials.category-card')
                        @empty
                            <div class="text-center py-4" style="color: var(--admin-muted);">
                                Aucune catégorie pour ce menu. <a href="{{ route('admin.categories.create') }}" class="text-primary">Ajouter une catégorie</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach

            @if($unassignedCategories->isNotEmpty())
                <div class="admin-card p-0 overflow-hidden mb-4">
                    <div class="p-4" style="background: var(--admin-bg-subtle); border-bottom: 1px solid var(--admin-border);">
                        <h4 class="mb-0">Catégories non assignées</h4>
                        <div class="small" style="color: var(--admin-muted);">Catégories sans menu</div>
                    </div>
                    <div class="p-4">
                        @foreach($unassignedCategories as $category)
                            @include('admin.categories.partials.category-card')
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
