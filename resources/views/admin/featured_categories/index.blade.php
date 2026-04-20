@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Catégories Phares</h1>
                    <div class="small" style="color: var(--admin-muted);">Catégories affichées sur la home page.</div>
                </div>
                <a href="{{ route('admin.featured_categories.create') }}" class="btn btn-admin-primary">Ajouter</a>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="admin-card p-0 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-dark table-borderless align-middle mb-0" style="--bs-table-bg: transparent;">
                        <thead style="color: var(--admin-muted);">
                            <tr>
                                <th style="width:72px;">Image</th>
                                <th>Titre</th>
                                <th>Menu</th>
                                <th>Ordre</th>
                                <th class="text-center">Actif</th>
                                <th style="width:160px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($featuredCategories as $category)
                                <tr style="border-top: 1px solid var(--admin-border);">
                                    <td>
                                        <div class="rounded-3 overflow-hidden" style="width:56px;height:56px;border:1px solid var(--admin-border);">
                                            @if($category->image)
                                                <img src="@image_url($category->image)" alt="" style="width:100%;height:100%;object-fit:cover;">
                                            @else
                                                <div style="width:100%;height:100%;background:var(--admin-muted);display:flex;align-items:center;justify-content:center;">
                                                    <span style="color:var(--admin-text-muted);font-size:12px;">N/A</span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $category->title }}</div>
                                        <div class="small" style="color: var(--admin-muted);">{{ $category->cta ?? 'Découvrir' }}</div>
                                    </td>
                                    <td class="small">
                                        @if($category->menu)
                                            {{ $category->menu->name }} <span class="text-muted">({{ $category->menu->slug }})</span>
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="small">{{ $category->order }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $category->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $category->is_active ? 'Oui' : 'Non' }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.featured_categories.edit', $category) }}" class="btn btn-sm btn-admin-ghost">Modifier</a>
                                            <form method="POST" action="{{ route('admin.featured_categories.destroy', $category) }}" onsubmit="return confirm('Supprimer cette catégorie phare ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4" style="color: var(--admin-muted);">Aucune catégorie phare.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
