@extends('admin.layout')

@section('title', 'Catégories Phares - Admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Catégories Phares</h1>
            <div class="small" style="color: var(--admin-muted);">Gérer les catégories affichées sur la home page.</div>
        </div>
        <div>
            <a href="{{ route('admin.featured_categories.create') }}" class="btn btn-admin-primary">Créer une catégorie</a>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Menu Slug</th>
                        <th>Ordre</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($featuredCategories as $category)
                        <tr>
                            <td>
                                @if($category->image)
                                    <img src="{{ image_url($category->image) }}" alt="{{ $category->title }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <div style="width: 60px; height: 60px; background: var(--admin-muted); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <span style="color: var(--admin-text-muted);">N/A</span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $category->title }}</strong>
                            </td>
                            <td>
                                <code>{{ $category->menu_slug ?? '-' }}</code>
                            </td>
                            <td>{{ $category->order }}</td>
                            <td>
                                <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $category->is_active ? 'En ligne' : 'Hors ligne' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.featured_categories.edit', $category) }}" class="btn btn-sm btn-admin-ghost">Modifier</a>
                                <form action="{{ route('admin.featured_categories.destroy', $category) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-admin-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5" style="color: var(--admin-muted);">Aucune catégorie phare.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
