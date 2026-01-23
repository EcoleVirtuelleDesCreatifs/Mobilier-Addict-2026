@extends('admin.layout')

@section('content')
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Sections Home</h1>
            <div class="small" style="color: var(--admin-muted);">Gère les sections comme “Trouvez Votre Bonheur” et “Équipez Votre Maison”.</div>
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
                        <th>Slug</th>
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
                            <td class="small">{{ $section->slug }}</td>
                            <td class="text-center">
                                <span class="badge {{ $section->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $section->is_active ? 'Oui' : 'Non' }}</span>
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
@endsection
