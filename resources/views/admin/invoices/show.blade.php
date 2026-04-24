@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Facture {{ $invoice->number }}</h1>
                    <div class="small" style="color: var(--admin-muted);">Commande: {{ $invoice->order_id ? ('#' . $invoice->order_id) : '—' }} • Statut: {{ $invoice->status }}</div>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('admin.invoices.index') }}" class="btn btn-admin-ghost">Retour</a>
                    <a href="{{ route('admin.invoices.pdf', $invoice) }}" class="btn btn-admin-primary">Télécharger PDF</a>
                    @if($invoice->order_id)
                        <a href="{{ route('admin.orders.show', $invoice->order_id) }}" class="btn btn-admin-ghost">Voir commande</a>
                    @endif
                </div>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="row g-3">
                <div class="col-12 col-lg-5">
                    <div class="admin-card p-4">
                        <div class="fw-bold mb-3">Client</div>

                        <div class="mb-2"><span style="color: var(--admin-muted);">Nom:</span> <span class="fw-semibold">{{ trim(($invoice->lastname ?? '') . ' ' . ($invoice->firstnames ?? '')) ?: '—' }}</span></div>
                        <div class="mb-2"><span style="color: var(--admin-muted);">WhatsApp:</span> <span class="fw-semibold">{{ $invoice->whatsapp ?: '—' }}</span></div>
                        @if($invoice->phone)
                            <div class="mb-2"><span style="color: var(--admin-muted);">Téléphone:</span> <span class="fw-semibold">{{ $invoice->phone }}</span></div>
                        @endif
                        @if($invoice->delivery_place)
                            <div class="mb-2"><span style="color: var(--admin-muted);">Lieu:</span> <span class="fw-semibold">{{ $invoice->delivery_place }}</span></div>
                        @endif
                        @if($invoice->delivery_day)
                            <div class="mb-2"><span style="color: var(--admin-muted);">Jour:</span> <span class="fw-semibold">{{ optional($invoice->delivery_day)->format('d/m/Y') }}</span></div>
                        @endif
                        @if($invoice->details)
                            <div class="mb-2"><span style="color: var(--admin-muted);">Détails:</span> <div class="mt-1">{{ $invoice->details }}</div></div>
                        @endif

                        <hr style="border-color: var(--admin-border);">

                        <div class="fw-bold mb-3">Statut</div>
                        <form method="POST" action="{{ route('admin.invoices.status', $invoice) }}" class="d-flex gap-2 flex-wrap">
                            @csrf
                            <select name="status" class="form-select" style="max-width: 220px;">
                                <option value="draft" @selected($invoice->status === 'draft')>Brouillon</option>
                                <option value="sent" @selected($invoice->status === 'sent')>Envoyée</option>
                                <option value="paid" @selected($invoice->status === 'paid')>Payée</option>
                                <option value="canceled" @selected($invoice->status === 'canceled')>Annulée</option>
                            </select>
                            <button type="submit" class="btn btn-admin-primary">Mettre à jour</button>
                        </form>

                        @if($invoice->paid_at)
                            <div class="small mt-2" style="color: var(--admin-muted);">Payée le {{ optional($invoice->paid_at)->format('d/m/Y') }}</div>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-7">
                    <div class="admin-card p-0 overflow-hidden">
                        <div class="p-4" style="border-bottom: 1px solid var(--admin-border);">
                            <div class="fw-bold">Articles</div>
                            <div class="small" style="color: var(--admin-muted);">{{ $invoice->items->count() }} ligne(s)</div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-dark table-borderless align-middle mb-0" style="--bs-table-bg: transparent;">
                                <thead style="color: var(--admin-muted);">
                                    <tr>
                                        <th>Produit</th>
                                        <th class="text-end">PU</th>
                                        <th class="text-center">Qté</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($invoice->items as $item)
                                        <tr style="border-top: 1px solid var(--admin-border);">
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    @if($item->product && !empty($item->product->image))
                                                        <img src="{{ asset($item->product->image) }}" alt="{{ $item->product_name }}" width="72" height="72" style="border-radius: 14px; object-fit: cover; border: 1px solid var(--admin-border);">
                                                    @endif
                                                    <div>
                                                        <div class="fw-semibold">{{ $item->product_name }}</div>
                                                        @if($item->product)
                                                            <div class="small" style="color: var(--admin-muted);">#{{ $item->product->id }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">{{ number_format((float) $item->unit_price, 0, ',', '.') }}F</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-end fw-semibold">{{ number_format((float) $item->line_total, 0, ',', '.') }}F</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5" style="color: var(--admin-muted);">Aucun article.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="p-4" style="border-top: 1px solid var(--admin-border);">
                            <div class="d-flex justify-content-end">
                                <div style="min-width: 260px;">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span style="color: var(--admin-muted);">Sous-total</span>
                                        <span class="fw-semibold">{{ number_format((float) $invoice->subtotal, 0, ',', '.') }}F</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span style="color: var(--admin-muted);">Livraison</span>
                                        <span class="fw-semibold">{{ number_format((float) $invoice->shipping_amount, 0, ',', '.') }}F</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span style="color: var(--admin-muted);">Total</span>
                                        <span class="fw-bold">{{ number_format((float) $invoice->total, 0, ',', '.') }}F</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
