@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Sections Home</h1>
            <div class="small" style="color: var(--admin-muted);">Gère les sections comme “Trouvez Votre Bonheur” et “Équipez Votre Maison”.</div>
        </div>
        <div>
            <a href="{{ route('admin.home_sections.create') }}" class="btn btn-admin-primary">Créer une section</a>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="admin-card p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-dark table-borderless align-middle mb-0" style="--bs-table-bg: transparent;">
                <thead style="color: var(--admin-muted);">
                    <tr>
                        <th>Section</th>
                        <th>Catégories associées</th>
                        <th class="text-center">Active</th>
                        <th class="text-end" style="width: 140px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sections as $section)
                        <tr style="border-top: 1px solid var(--admin-border);">
                            <td>
                                <div class="fw-semibold">{{ $section->title }}</div>
                                <div class="small" style="color: var(--admin-muted);">{{ $section->badge }}</div>
                            </td>
                            <td>
                                @if(($section->categories_count ?? 0) > 0)
                                    <div class="small fw-semibold">{{ (int) $section->categories_count }} catégorie(s)</div>
                                    <div class="small" style="color: var(--admin-muted);">
                                        {{ $section->categories->take(3)->pluck('name')->join(', ') }}@if(($section->categories_count ?? 0) > 3)…@endif
                                    </div>
                                @else
                                    <div class="small" style="color: var(--admin-muted);">—</div>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="online-pill {{ $section->is_active ? 'is-online' : 'is-offline' }}">
                                    <span class="online-dot" aria-hidden="true"></span>
                                    {{ $section->is_active ? 'En ligne' : 'Hors ligne' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.home_sections.edit', $section) }}" class="btn btn-sm btn-admin-ghost">Gérer</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5" style="color: var(--admin-muted);">Aucune section.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
        </div>
    </div>
@endsection
