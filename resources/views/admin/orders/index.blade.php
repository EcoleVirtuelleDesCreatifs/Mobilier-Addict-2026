@extends('layouts.admin')

@section('title', 'Commandes')

@section('content')
    @php
        $statusMap = [
            'pending' => ['En attente', 'is-amber'],
            'confirmed' => ['Confirmée', 'is-blue'],
            'shipping' => ['En livraison', 'is-violet'],
            'delivered' => ['Livrée', 'is-green'],
            'canceled' => ['Annulée', 'is-red'],
        ];
    @endphp

    <div class="content-body">
        <div class="container-fluid">
            <x-admin.page-header title="Commandes" subtitle="Suivi et gestion des commandes clients." />

            @if (!empty($ordersMissing))
                <div class="alert alert-info">La table des commandes n'existe pas encore : exécute les migrations pour activer ce module.</div>
            @else
                <div class="row g-3 mb-3">
                    <div class="col-6 col-xl-3">
                        <x-admin.stat label="Commandes" :value="number_format((int) ($ordersTotalCount ?? 0), 0, ',', ' ')" icon="fa-solid fa-bag-shopping" tone="navy" :href="route('admin.orders.index')" />
                    </div>
                    <div class="col-6 col-xl-3">
                        <x-admin.stat label="Aujourd'hui" :value="number_format((int) ($ordersTodayCount ?? 0), 0, ',', ' ')" icon="fa-solid fa-calendar-day" tone="pink" />
                    </div>
                    <div class="col-6 col-xl-3">
                        <x-admin.stat label="En livraison" :value="number_format((int) ($ordersShippingCount ?? 0), 0, ',', ' ')" icon="fa-solid fa-truck" tone="blue" :href="route('admin.orders.index', ['status' => 'shipping'])" />
                    </div>
                    <div class="col-6 col-xl-3">
                        <x-admin.stat label="Livrées" :value="number_format((int) ($ordersDeliveredCount ?? 0), 0, ',', ' ')" icon="fa-solid fa-circle-check" tone="green" :href="route('admin.orders.index', ['status' => 'delivered'])" />
                    </div>
                </div>

                <div class="ad-card mb-3">
                    <form method="GET" action="{{ route('admin.orders.index') }}" class="ad-filters" data-auto-submit>
                        <div class="ad-filter-grow">
                            <label class="form-label">Recherche</label>
                            <div class="ad-input-icon">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Nom, WhatsApp, téléphone, n°">
                            </div>
                        </div>
                        <div class="ad-filter">
                            <label class="form-label">Statut</label>
                            <select name="status" class="form-select">
                                <option value="">Tous</option>
                                @foreach (($allowedStatuses ?? []) as $s)
                                    <option value="{{ $s }}" @selected(request('status') === $s)>{{ $statusMap[$s][0] ?? $s }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-admin-primary">Filtrer</button>
                            @if (request()->hasAny(['q', 'status']))
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-admin-ghost">Réinitialiser</a>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="ad-card overflow-hidden">
                    <div class="table-responsive">
                        <table class="table ad-table align-middle">
                            <thead>
                                <tr>
                                    <th>Commande</th>
                                    <th>Client</th>
                                    <th>Statut</th>
                                    <th class="text-center">Articles</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    @php
                                        $status = (string) $order->status;
                                        $statusInfo = $statusMap[$status] ?? [$status, 'is-gray'];
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order) }}" class="ad-strong">CMD-{{ str_pad((string) $order->id, 6, '0', STR_PAD_LEFT) }}</a>
                                            <div class="ad-sub">{{ optional($order->created_at)->format('d/m/Y H:i') }}</div>
                                        </td>
                                        <td>
                                            <div class="ad-strong">{{ trim($order->lastname . ' ' . $order->firstnames) ?: '—' }}</div>
                                            <div class="ad-sub">
                                                @if ($order->whatsapp)
                                                    <i class="fa-brands fa-whatsapp me-1"></i>{{ $order->whatsapp }}
                                                @elseif ($order->user)
                                                    {{ $order->user->email }}
                                                @endif
                                            </div>
                                        </td>
                                        <td><span class="ad-badge {{ $statusInfo[1] }}">{{ $statusInfo[0] }}</span></td>
                                        <td class="text-center">{{ $order->items_count }}</td>
                                        <td class="text-end ad-strong text-nowrap">{{ number_format((float) $order->total, 0, ',', ' ') }} F</td>
                                        <td>
                                            <div class="ad-actions">
                                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-admin-ghost ad-btn-icon" title="Voir"><i class="fa-solid fa-eye"></i></a>
                                                <form method="POST" action="{{ route('admin.orders.invoices.store', $order) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-admin-ghost ad-btn-icon" title="Générer la facture"><i class="fa-solid fa-file-invoice"></i></button>
                                                </form>
                                                @if ($status === 'pending')
                                                    <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="confirmed">
                                                        <button type="submit" class="btn btn-sm btn-admin-primary">Confirmer</button>
                                                    </form>
                                                @endif
                                                @if (in_array($status, ['pending', 'confirmed'], true))
                                                    <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="shipping">
                                                        <button type="submit" class="btn btn-sm btn-admin-ghost" title="Passer en livraison"><i class="fa-solid fa-truck"></i></button>
                                                    </form>
                                                @endif
                                                @if (!in_array($status, ['delivered', 'canceled'], true))
                                                    <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="delivered">
                                                        <button type="submit" class="btn btn-sm btn-success" title="Marquer livrée"><i class="fa-solid fa-check"></i></button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"><div class="ad-empty"><i class="fa-solid fa-bag-shopping"></i>Aucune commande.</div></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if (method_exists($orders, 'links'))
                    <div class="mt-3">{{ $orders->links('pagination::bootstrap-5') }}</div>
                @endif
            @endif
        </div>
    </div>
@endsection
