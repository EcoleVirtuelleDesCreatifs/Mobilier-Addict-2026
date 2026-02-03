@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Newsletter</h1>
                    <div class="small" style="color: var(--admin-muted);">
                        Total: <span class="fw-semibold">{{ number_format((int) ($counts['total'] ?? 0)) }}</span>
                        — Actifs: <span class="fw-semibold">{{ number_format((int) ($counts['active'] ?? 0)) }}</span>
                        — Inactifs: <span class="fw-semibold">{{ number_format((int) ($counts['inactive'] ?? 0)) }}</span>
                    </div>
                </div>
            </div>

            <div class="admin-card p-3 p-md-4 mb-3">
                <form method="GET" action="{{ route('admin.newsletter.index') }}" class="row g-2 align-items-end">
                    <div class="col-12 col-md-6">
                        <label class="form-label small" style="color: var(--admin-muted);">Recherche</label>
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Email">
                    </div>
                    <div class="col-12 col-md-auto">
                        <button type="submit" class="btn btn-admin-ghost">Filtrer</button>
                    </div>
                </form>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="admin-card p-0 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-dark table-borderless align-middle mb-0" style="--bs-table-bg: transparent;">
                        <thead style="color: var(--admin-muted);">
                            <tr>
                                <th>Email</th>
                                <th class="text-center">Statut</th>
                                <th>Inscrit le</th>
                                <th>Créé le</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscriptions as $subscription)
                                <tr style="border-top: 1px solid var(--admin-border);">
                                    <td class="fw-semibold">{{ $subscription->email }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $subscription->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">
                                            {{ $subscription->is_active ? 'Actif' : 'Inactif' }}
                                        </span>
                                    </td>
                                    <td class="small">{{ optional($subscription->subscribed_at)->format('d/m/Y H:i') ?: '—' }}</td>
                                    <td class="small">{{ optional($subscription->created_at)->format('d/m/Y H:i') ?: '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4" style="color: var(--admin-muted);">Aucun inscrit.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                @if($subscriptions->hasPages())
                    {{ $subscriptions->links('pagination::bootstrap-5') }}
                @endif
            </div>
        </div>
    </div>
@endsection
