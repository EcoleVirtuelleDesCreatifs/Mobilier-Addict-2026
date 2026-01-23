@extends('admin.layout')

@section('content')
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Catégories</h1>
            <div class="small" style="color: var(--admin-muted);">Structure utilisée sur la home et la navigation.</div>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-admin-primary">Ajouter</a>
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

    <div class="admin-card p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-dark table-borderless align-middle mb-0" style="--bs-table-bg: transparent;">
                <thead style="color: var(--admin-muted);">
                    <tr>
                        <th style="width:72px;">Image</th>
                        <th>Catégorie</th>
                        <th>Parent</th>
                        <th class="text-center">Actif</th>
                        <th style="width:160px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr style="border-top: 1px solid var(--admin-border);">
                            <td>
                                <div class="rounded-3 overflow-hidden" style="width:56px;height:56px;border:1px solid var(--admin-border);">
                                    <img src="{{ asset($category->image) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $category->name }}</div>
                                <div class="small" style="color: var(--admin-muted);">{{ $category->slug }}</div>
                            </td>
                            <td class="small">{{ $category->parent?->name ?: '—' }}</td>
                            <td class="text-center">
                                <span class="badge {{ $category->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $category->is_active ? 'Oui' : 'Non' }}</span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-admin-ghost">Modifier</a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Supprimer cette catégorie ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5" style="color: var(--admin-muted);">Aucune catégorie.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
@endsection
