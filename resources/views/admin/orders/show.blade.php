@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @php
                $orderNumber = 'CMD-' . str_pad((string) $order->id, 6, '0', STR_PAD_LEFT);
                $status = (string) $order->status;
                $badgeClass = match ($status) {
                    'pending' => 'status-pill status-pending',
                    'confirmed' => 'status-pill status-confirmed',
                    'shipping' => 'status-pill status-shipping',
                    'delivered' => 'status-pill status-delivered',
                    'canceled' => 'status-pill status-canceled',
                    default => 'status-pill',
                };
                $statusLabel = match ($status) {
                    'pending' => 'En attente',
                    'confirmed' => 'Confirmée',
                    'shipping' => 'En cours de livraison',
                    'delivered' => 'Livrée',
                    'canceled' => 'Annulée',
                    default => $status,
                };
            @endphp

            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Commande {{ $orderNumber }}</h1>
                    <div class="small" style="color: var(--admin-muted);">#{{ $order->id }} • <span class="{{ $badgeClass }}"><span class="status-dot"></span>{{ $statusLabel }}</span></div>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-admin-ghost">Retour</a>

                    <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="confirmed">
                        <button type="submit" class="btn btn-admin-primary" @disabled($status === 'confirmed')>Confirmer</button>
                    </form>

                    <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="shipping">
                        <button type="submit" class="btn btn-admin-ghost" @disabled($status === 'shipping')>En livraison</button>
                    </form>

                    <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="delivered">
                        <button type="submit" class="btn btn-success" @disabled($status === 'delivered')>Livrée</button>
                    </form>
                </div>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="row g-3">
                <div class="col-12 col-lg-5">
                    <div class="admin-card p-4">
                        <div class="fw-bold mb-3">Client</div>

                        <div class="mb-2"><span style="color: var(--admin-muted);">Nom:</span> <span class="fw-semibold">{{ $order->lastname }} {{ $order->firstnames }}</span></div>
                        <div class="mb-2"><span style="color: var(--admin-muted);">WhatsApp:</span> <span class="fw-semibold">{{ $order->whatsapp }}</span></div>
                        @if($order->phone)
                            <div class="mb-2"><span style="color: var(--admin-muted);">Téléphone:</span> <span class="fw-semibold">{{ $order->phone }}</span></div>
                        @endif
                        <div class="mb-2"><span style="color: var(--admin-muted);">Lieu:</span> <span class="fw-semibold">{{ $order->delivery_place }}</span></div>
                        @if($order->delivery_day)
                            <div class="mb-2"><span style="color: var(--admin-muted);">Jour:</span> <span class="fw-semibold">{{ optional($order->delivery_day)->format('d/m/Y') }}</span></div>
                        @endif
                        @if($order->details)
                            <div class="mb-2"><span style="color: var(--admin-muted);">Détails:</span> <div class="mt-1">{{ $order->details }}</div></div>
                        @endif

                        <hr style="border-color: var(--admin-border);">

                        <div class="fw-bold mb-3">Paiement / Livraison</div>
                        <div class="mb-2"><span style="color: var(--admin-muted);">Paiement:</span> <span class="fw-semibold">{{ $order->payment_method ?: '—' }}</span></div>
                        <div class="mb-2"><span style="color: var(--admin-muted);">Méthode:</span> <span class="fw-semibold">{{ $order->shipping_method ?: '—' }}</span></div>
                        <div class="mb-2"><span style="color: var(--admin-muted);">Créée le:</span> <span class="fw-semibold">{{ optional($order->created_at)->format('d/m/Y H:i') }}</span></div>
                    </div>
                </div>

                <div class="col-12 col-lg-7">
                    <div class="admin-card p-0 overflow-hidden">
                        <div class="p-4" style="border-bottom: 1px solid var(--admin-border);">
                            <div class="fw-bold">Articles</div>
                            <div class="small" style="color: var(--admin-muted);">{{ $order->items->count() }} ligne(s)</div>
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
                                    @forelse($order->items as $item)
                                        <tr style="border-top: 1px solid var(--admin-border);">
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    @if($item->product && !empty($item->product->image))
                                                        <img src="{{ asset($item->product->image) }}" alt="{{ $item->product_name }}" width="150" height="150" style="border-radius: 14px; object-fit: cover; border: 1px solid var(--admin-border);">
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
                                        <span class="fw-semibold">{{ number_format((float) $order->subtotal, 0, ',', '.') }}F</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span style="color: var(--admin-muted);">Livraison</span>
                                        <span class="fw-semibold">{{ number_format((float) $order->shipping_amount, 0, ',', '.') }}F</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span style="color: var(--admin-muted);">Total</span>
                                        <span class="fw-bold">{{ number_format((float) $order->total, 0, ',', '.') }}F</span>
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
