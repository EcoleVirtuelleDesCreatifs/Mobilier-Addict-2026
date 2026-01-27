@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Commandes</h1>
                    <div class="small" style="color: var(--admin-muted);">Suivi et gestion des commandes.</div>
                </div>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if(!empty($ordersMissing))
                <div class="admin-card p-4">
                    <div class="alert alert-info mb-0">
                        Pour activer la gestion des commandes, il faut créer:
                        <div class="mt-2">
                            <div class="small">- une migration <code>orders</code> + éventuellement <code>order_items</code></div>
                            <div class="small">- un modèle <code>Order</code></div>
                            <div class="small">- et brancher le checkout côté site</div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="admin-card stat-card stat-card--primary p-3">
                            <div class="small" style="color: var(--admin-muted);">Commandes</div>
                            <div class="h4 fw-bold mb-0">{{ number_format((int) ($ordersTotalCount ?? 0), 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="admin-card stat-card stat-card--success p-3">
                            <div class="small" style="color: var(--admin-muted);">Livrées</div>
                            <div class="h4 fw-bold mb-0">{{ number_format((int) ($ordersDeliveredCount ?? 0), 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="admin-card stat-card stat-card--info p-3">
                            <div class="small" style="color: var(--admin-muted);">En livraison</div>
                            <div class="h4 fw-bold mb-0">{{ number_format((int) ($ordersShippingCount ?? 0), 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="admin-card stat-card stat-card--warning p-3">
                            <div class="small" style="color: var(--admin-muted);">Commandes du jour</div>
                            <div class="h4 fw-bold mb-0">{{ number_format((int) ($ordersTodayCount ?? 0), 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <div class="admin-card p-3 p-md-4 mb-3">
                    <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-2 align-items-end">
                        <div class="col-12 col-md-5">
                            <label class="form-label small" style="color: var(--admin-muted);">Recherche</label>
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Nom, WhatsApp, téléphone, id">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label small" style="color: var(--admin-muted);">Statut</label>
                            <select name="status" class="form-select">
                                <option value="">Tous</option>
                                @foreach(($allowedStatuses ?? []) as $s)
                                    <option value="{{ $s }}" @selected(request('status') === $s)>{{ $s }}</option>
                                @endforeach
                            </select>
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
                                    <th>Commande</th>
                                    <th>Client</th>
                                    <th>WhatsApp</th>
                                    <th>Statut</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-center">Articles</th>
                                    <th>Date</th>
                                    <th style="width: 240px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
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
                                    <tr style="border-top: 1px solid var(--admin-border);">
                                        <td>
                                            <div class="fw-semibold">{{ $orderNumber }}</div>
                                            <div class="small" style="color: var(--admin-muted);">#{{ $order->id }}</div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $order->lastname }} {{ $order->firstnames }}</div>
                                            @if($order->user)
                                                <div class="small" style="color: var(--admin-muted);">{{ $order->user->email }}</div>
                                            @endif
                                        </td>
                                        <td>{{ $order->whatsapp }}</td>
                                        <td>
                                            <span class="{{ $badgeClass }}"><span class="status-dot"></span>{{ $statusLabel }}</span>
                                        </td>
                                        <td class="text-end fw-semibold">{{ number_format((float) $order->total, 0, ',', '.') }}F</td>
                                        <td class="text-center">{{ $order->items_count }}</td>
                                        <td>
                                            <div class="small" style="color: var(--admin-muted);">{{ optional($order->created_at)->format('d/m/Y H:i') }}</div>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-2 flex-wrap">
                                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-admin-ghost">Voir</a>

                                                @if($status === 'pending')
                                                    <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="confirmed">
                                                        <button type="submit" class="btn btn-sm btn-admin-primary">Confirmer</button>
                                                    </form>
                                                @endif

                                                @if(in_array($status, ['pending', 'confirmed'], true))
                                                    <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="shipping">
                                                        <button type="submit" class="btn btn-sm btn-admin-ghost">En livraison</button>
                                                    </form>
                                                @endif

                                                @if($status !== 'delivered')
                                                    <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="delivered">
                                                        <button type="submit" class="btn btn-sm btn-success">Livrée</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5" style="color: var(--admin-muted);">Aucune commande.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(method_exists($orders, 'links'))
                    <div class="mt-3">
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
