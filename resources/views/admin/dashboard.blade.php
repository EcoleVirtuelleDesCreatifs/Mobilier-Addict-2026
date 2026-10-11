@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
<div class="content-body">
    <div class="container-fluid">

        <div class="row page-titles mx-0 mb-3">
            <div class="col-sm-6 p-0">
                <h4 class="text-black font-w600 mb-0">Tableau de bord</h4>
                <small class="text-muted">{{ now()->translatedFormat('l d F Y') }}</small>
            </div>
            <div class="col-sm-6 p-0 text-sm-right mt-2 mt-sm-0">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">+ Produit</a>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary btn-sm">Commandes</a>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary btn-sm">Voir le site</a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <a href="{{ route('admin.products.index') }}" class="card d-block">
                    <div class="card-body">
                        <small class="text-muted d-block">Produits</small>
                        <h3 class="text-black font-w700 mb-0">{{ number_format($stats['products'], 0, ',', ' ') }}</h3>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6">
                <a href="{{ route('admin.orders.index') }}" class="card d-block">
                    <div class="card-body">
                        <small class="text-muted d-block">Commandes</small>
                        <h3 class="text-black font-w700 mb-0">{{ number_format($ordersTotalCount, 0, ',', ' ') }}</h3>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6">
                <a href="{{ route('admin.orders.index') }}" class="card d-block">
                    <div class="card-body">
                        <small class="text-muted d-block">Commandes à traiter</small>
                        <h3 class="text-warning font-w700 mb-0">{{ number_format($ordersPendingCount, 0, ',', ' ') }}</h3>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6">
                <a href="{{ route('admin.products.index') }}" class="card d-block">
                    <div class="card-body">
                        <small class="text-muted d-block">Stock faible</small>
                        <h3 class="text-danger font-w700 mb-0">{{ number_format($lowStockCount, 0, ',', ' ') }}</h3>
                    </div>
                </a>
            </div>
        </div>

        <div class="card" style="background:#00234D;border:none;">
            <div class="card-body py-3">
                <div class="row text-white align-items-center">
                    <div class="col-md-3 col-6 mb-2 mb-md-0">
                        <small class="d-block" style="opacity:.6;"><span id="rt-dot" style="display:inline-block;width:8px;height:8px;border-radius:50%;background:#22c55e;margin-right:6px;"></span>En ligne</small>
                        <strong id="rt-online" class="text-white" style="font-size:22px;">{{ number_format($visitors['realtime'] ?? 0, 0, ',', ' ') }}</strong>
                    </div>
                    <div class="col-md-3 col-6 mb-2 mb-md-0">
                        <small class="d-block" style="opacity:.6;">Aujourd'hui</small>
                        <strong id="rt-today" class="text-white" style="font-size:22px;">{{ number_format($visitors['today'] ?? 0, 0, ',', ' ') }}</strong>
                    </div>
                    <div class="col-md-3 col-6">
                        <small class="d-block" style="opacity:.6;">Ce mois</small>
                        <strong id="rt-month" class="text-white" style="font-size:22px;">{{ number_format($visitors['month'] ?? 0, 0, ',', ' ') }}</strong>
                    </div>
                    <div class="col-md-3 col-6">
                        <small class="d-block" style="opacity:.6;">Paniers abandonnés</small>
                        <strong id="rt-carts" class="text-warning" style="font-size:22px;">{{ number_format($abandonedCarts, 0, ',', ' ') }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h5 class="card-title mb-0">Produits les plus vus</h5>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-outline-primary top-tab active" data-period="day">Jour</button>
                            <button type="button" class="btn btn-outline-primary top-tab" data-period="week">Semaine</button>
                            <button type="button" class="btn btn-outline-primary top-tab" data-period="month">Mois</button>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        @if(!$hasPageViews)
                            <p class="text-muted small mb-0">Statistiques de visites indisponibles.</p>
                        @else
                            @foreach(['day', 'week', 'month'] as $period)
                                <div class="top-panel {{ $period !== 'day' ? 'd-none' : '' }}" data-panel="{{ $period }}">
                                    @forelse($topProducts[$period] as $row)
                                        @php $product = $row['product']; @endphp
                                        <div class="d-flex align-items-center py-2" style="border-bottom:1px solid #f4f4f6;">
                                            <span class="mr-3 font-w700" style="color:#ec4899;width:22px;">{{ $loop->iteration }}</span>
                                            @if($product && $product->image)
                                                <img src="{{ image_url($product->image) }}" class="rounded mr-3" width="40" height="40" style="object-fit:cover;" alt="">
                                            @endif
                                            <div class="flex-grow-1 text-truncate">
                                                <strong class="d-block text-truncate" style="color:#00234D;">{{ ($product && $product->name) ? $product->name : \Illuminate\Support\Str::afterLast($row['path'], '/') }}</strong>
                                                <small class="text-muted">{{ number_format($row['views'], 0, ',', ' ') }} vue{{ $row['views'] > 1 ? 's' : '' }}</small>
                                            </div>
                                            @if($product && $product->slug)
                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-xs btn-outline-primary ml-2">Voir</a>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-muted small mb-0 py-2">Aucune visite sur cette période.</p>
                                    @endforelse
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h5 class="card-title mb-0">Commandes récentes</h5>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">Tout voir</a>
                    </div>
                    <div class="card-body pt-2">
                        @forelse($latestOrders as $order)
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="d-flex align-items-center py-2 text-decoration-none" style="border-bottom:1px solid #f4f4f6;">
                                <div class="flex-grow-1">
                                    <strong style="color:#00234D;">#{{ $order->reference ?? $order->id }}</strong>
                                    <small class="text-muted d-block">{{ $order->customer_name ?? 'Client' }} — {{ optional($order->created_at)->format('d/m/Y') }}</small>
                                </div>
                                <span class="badge badge-sm {{ $order->status === 'pending' ? 'badge-warning' : 'badge-success' }}">{{ $order->status }}</span>
                                <strong class="ml-3" style="color:#ec4899;">{{ number_format((float) ($order->total ?? 0), 0, ',', ' ') }} F</strong>
                            </a>
                        @empty
                            <p class="text-muted small mb-0 py-2">Aucune commande.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5 class="card-title mb-0">Aperçu boutique</h5>
            </div>
            <div class="card-body pt-2">
                <div class="row text-center">
                    <div class="col-4 col-md-2 py-2"><strong class="d-block" style="color:#00234D;">{{ $stats['categories'] }}</strong><small class="text-muted">Catégories</small></div>
                    <div class="col-4 col-md-2 py-2"><strong class="d-block" style="color:#00234D;">{{ $stats['posts'] }}</strong><small class="text-muted">Articles</small></div>
                    <div class="col-4 col-md-2 py-2"><strong class="d-block" style="color:#00234D;">{{ $stats['slides'] }}</strong><small class="text-muted">Sliders</small></div>
                    <div class="col-4 col-md-2 py-2"><strong class="d-block" style="color:#00234D;">{{ $stats['newsletter'] }}</strong><small class="text-muted">Newsletter</small></div>
                    <div class="col-4 col-md-2 py-2"><strong class="d-block" style="color:#00234D;">{{ $productsOnlineCount }}</strong><small class="text-muted">En ligne</small></div>
                    <div class="col-4 col-md-2 py-2"><strong class="d-block" style="color:#00234D;">{{ $stats['users'] }}</strong><small class="text-muted">Utilisateurs</small></div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    var tabs = document.querySelectorAll('.top-tab');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');
            document.querySelectorAll('.top-panel').forEach(function (p) {
                p.classList.toggle('d-none', p.getAttribute('data-panel') !== btn.getAttribute('data-period'));
            });
        });
    });

    var url = @json(route('admin.dashboard.realtime'));
    function fmt(n) { return new Intl.NumberFormat('fr-FR').format(n || 0); }
    function refresh() {
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (r) { return r.json(); })
            .then(function (d) {
                document.getElementById('rt-online').textContent = fmt(d.visitors.realtime);
                document.getElementById('rt-today').textContent = fmt(d.visitors.today);
                document.getElementById('rt-month').textContent = fmt(d.visitors.month);
                document.getElementById('rt-carts').textContent = fmt(d.abandonedCarts);
                document.getElementById('rt-dot').style.background = '#22c55e';
            })
            .catch(function () {
                document.getElementById('rt-dot').style.background = '#ef4444';
            });
    }
    setInterval(refresh, 15000);
})();
</script>
@endpush
