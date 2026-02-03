@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Factures</h1>
                    <div class="small" style="color: var(--admin-muted);">Liste des factures générées depuis les commandes.</div>
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
                                <th>Facture</th>
                                <th>Commande</th>
                                <th>Client</th>
                                <th>Statut</th>
                                <th class="text-end">Total</th>
                                <th style="width: 140px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoices as $invoice)
                                <tr style="border-top: 1px solid var(--admin-border);">
                                    <td>
                                        <div class="fw-semibold">{{ $invoice->number }}</div>
                                        <div class="small" style="color: var(--admin-muted);">{{ optional($invoice->issued_at)->format('d/m/Y') ?: '—' }}</div>
                                    </td>
                                    <td>
                                        @if($invoice->order_id)
                                            <a href="{{ route('admin.orders.show', $invoice->order_id) }}" class="fw-semibold">#{{ $invoice->order_id }}</a>
                                        @else
                                            <span style="color: var(--admin-muted);">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ trim(($invoice->lastname ?? '') . ' ' . ($invoice->firstnames ?? '')) ?: '—' }}</div>
                                        <div class="small" style="color: var(--admin-muted);">{{ $invoice->whatsapp ?: ($invoice->phone ?: '—') }}</div>
                                    </td>
                                    <td>
                                        <span class="badge text-bg-secondary">{{ $invoice->status }}</span>
                                    </td>
                                    <td class="text-end fw-semibold">{{ number_format((float) $invoice->total, 0, ',', '.') }}F</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.invoices.show', $invoice) }}" class="btn btn-sm btn-admin-ghost">Voir</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5" style="color: var(--admin-muted);">Aucune facture.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                {{ $invoices->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
