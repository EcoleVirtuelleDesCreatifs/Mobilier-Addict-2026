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
                                <h4 class="mb-1">{{ $menu->name }}</h4>
                                <div class="small" style="color: var(--admin-muted);">{{ $menu->slug }}</div>
                            </div>
                            <div class="badge bg-primary">{{ $categoriesByMenu[$menu->id]?->count() ?? 0 }} catégories</div>
                        </div>
                    </div>
                    <div class="p-4">
                        @forelse($categoriesByMenu[$menu->id] ?? collect() as $category)
                            <div class="mb-3" style="border: 1px solid var(--admin-border); border-radius: 12px; padding: 16px;">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-2">
                                        <div class="rounded-3 overflow-hidden" style="width:80px;height:80px;border:1px solid var(--admin-border);">
                                            <img src="@image_url($category->image)" alt="" style="width:100%;height:100%;object-fit:cover;">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="fw-semibold">{{ $category->name }}</div>
                                        <div class="small" style="color: var(--admin-muted);">{{ $category->slug }}</div>
                                        @if($category->description)
                                        <div class="small text-muted mt-1">{{ Str::limit($category->description, 50) }}</div>
                                        @endif
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <div class="small" style="color: var(--admin-muted);">Couleur</div>
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:24px;height:24px;border-radius:50%;background:{{ $category->color ?? '#64748b' }};"></div>
                                            <span class="small">{{ $category->color ?? '#64748b' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <div class="small" style="color: var(--admin-muted);">Produits</div>
                                        <div class="fw-semibold">{{ $category->productsMany()->count() }}</div>
                                    </div>
                                    <div class="col-12 col-md-1">
                                        <span class="badge {{ $category->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">
                                            {{ $category->is_active ? 'Actif' : 'Inactif' }}
                                        </span>
                                    </div>
                                    <div class="col-12 col-md-2 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-admin-ghost">Modifier</a>
                                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Supprimer cette catégorie ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            <div class="mb-3" style="border: 1px solid var(--admin-border); border-radius: 12px; padding: 16px;">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-2">
                                        <div class="rounded-3 overflow-hidden" style="width:80px;height:80px;border:1px solid var(--admin-border);">
                                            <img src="@image_url($category->image)" alt="" style="width:100%;height:100%;object-fit:cover;">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="fw-semibold">{{ $category->name }}</div>
                                        <div class="small" style="color: var(--admin-muted);">{{ $category->slug }}</div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <div class="small" style="color: var(--admin-muted);">Couleur</div>
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:24px;height:24px;border-radius:50%;background:{{ $category->color ?? '#64748b' }};"></div>
                                            <span class="small">{{ $category->color ?? '#64748b' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <div class="small" style="color: var(--admin-muted);">Produits</div>
                                        <div class="fw-semibold">{{ $category->productsMany()->count() }}</div>
                                    </div>
                                    <div class="col-12 col-md-1">
                                        <span class="badge {{ $category->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">
                                            {{ $category->is_active ? 'Actif' : 'Inactif' }}
                                        </span>
                                    </div>
                                    <div class="col-12 col-md-2 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-admin-ghost">Modifier</a>
                                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Supprimer cette catégorie ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
