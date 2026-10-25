@extends('layouts.admin')

@section('title', 'Devis')

@section('content')
    @php
        $statusMap = [
            'pending' => ['En attente', 'is-amber'],
            'draft' => ['Brouillon', 'is-gray'],
            'sent' => ['Envoyé', 'is-blue'],
            'accepted' => ['Accepté', 'is-green'],
            'rejected' => ['Refusé', 'is-red'],
        ];
    @endphp

    <div class="content-body">
        <div class="container-fluid">
            <x-admin.page-header title="Devis" subtitle="Demandes de devis des clients et devis générés depuis les commandes." />

            <div class="ad-card mb-3">
                <form method="GET" action="{{ route('admin.quotes.index') }}" class="ad-filters" data-auto-submit>
                    <div class="ad-filter-grow">
                        <label class="form-label">Recherche</label>
                        <div class="ad-input-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="N°, client, structure, WhatsApp…">
                        </div>
                    </div>
                    <div class="ad-filter">
                        <label class="form-label">Statut</label>
                        <select name="status" class="form-select">
                            <option value="">Tous les statuts</option>
                            @foreach ($statusMap as $value => $info)
                                <option value="{{ $value }}" @selected(request('status') === $value)>{{ $info[0] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary">Filtrer</button>
                        @if (request('q') || request('status'))
                            <a href="{{ route('admin.quotes.index') }}" class="btn btn-admin-ghost">Réinitialiser</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="ad-card overflow-hidden">
                <div class="table-responsive">
                    <table class="table ad-table align-middle">
                        <thead>
                            <tr>
                                <th>Devis</th>
                                <th>Client</th>
                                <th>Commande</th>
                                <th>Statut</th>
                                <th class="text-end">Total</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($quotes as $quote)
                                @php
                                    $statusInfo = $statusMap[$quote->status] ?? [$quote->status, 'is-gray'];
                                @endphp
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.quotes.show', $quote) }}" class="ad-strong">{{ $quote->number }}</a>
                                        <div class="ad-sub">{{ optional($quote->issued_at)->format('d/m/Y') ?: '—' }} · {{ $quote->items_count }} article(s)</div>
                                    </td>
                                    <td>
                                        <div class="ad-strong">{{ trim(($quote->lastname ?? '') . ' ' . ($quote->firstnames ?? '')) ?: '—' }}</div>
                                        <div class="ad-sub">{{ $quote->whatsapp ?: ($quote->phone ?: '—') }}</div>
                                    </td>
                                    <td>
                                        @if ($quote->order_id)
                                            <a href="{{ route('admin.orders.show', $quote->order_id) }}" class="ad-strong">#{{ $quote->order_id }}</a>
                                        @else
                                            <span class="ad-sub">—</span>
                                        @endif
                                    </td>
                                    <td><span class="ad-badge {{ $statusInfo[1] }}">{{ $statusInfo[0] }}</span></td>
                                    <td class="text-end ad-strong text-nowrap">{{ number_format((float) $quote->total, 0, ',', ' ') }} F</td>
                                    <td>
                                        <div class="ad-actions">
                                            <a href="{{ route('admin.quotes.show', $quote) }}" class="btn btn-sm btn-admin-ghost"><i class="fa-solid fa-eye me-1"></i> Voir</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"><div class="ad-empty"><i class="fa-solid fa-file-invoice"></i>Aucun devis.</div></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">{{ $quotes->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
@endsection
