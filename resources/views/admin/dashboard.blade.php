@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
<div class="content-body ma-dash">
    <div class="container-fluid">
        <header class="ma-dash-head">
            <div>
                <p>{{ now()->translatedFormat('l d F Y') }}</p>
                <h1>Tableau de bord</h1>
            </div>
            <div class="ma-dash-actions">
                <a href="{{ route('admin.products.create') }}" class="ma-dash-btn is-primary"><i class="fas fa-plus"></i> Produit</a>
                <a href="{{ route('admin.orders.index') }}" class="ma-dash-btn"><i class="fas fa-shopping-bag"></i> Commandes</a>
                <a href="{{ route('home') }}" target="_blank" class="ma-dash-btn"><i class="fas fa-external-link-alt"></i> Voir le site</a>
            </div>
        </header>

        <section class="ma-kpis" aria-label="Indicateurs principaux">
            <a href="{{ route('admin.products.index') }}" class="ma-kpi">
                <span class="ma-kpi-icon"><i class="fas fa-box"></i></span>
                <span><small>Produits</small><strong>{{ number_format($stats['products'], 0, ',', ' ') }}</strong></span>
                <em>{{ number_format($productsOnlineCount, 0, ',', ' ') }} en ligne</em>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="ma-kpi">
                <span class="ma-kpi-icon"><i class="fas fa-receipt"></i></span>
                <span><small>Commandes</small><strong>{{ $ordersMissing ? '—' : number_format($ordersTotalCount, 0, ',', ' ') }}</strong></span>
                <em>Total</em>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="ma-kpi is-warning">
                <span class="ma-kpi-icon"><i class="fas fa-clock"></i></span>
                <span><small>À traiter</small><strong>{{ $ordersMissing ? '—' : number_format($ordersPendingCount, 0, ',', ' ') }}</strong></span>
                <em>Commandes</em>
            </a>
            <a href="{{ route('admin.products.index', ['status' => 'low_stock']) }}" class="ma-kpi {{ $lowStockCount > 0 ? 'is-danger' : '' }}">
                <span class="ma-kpi-icon"><i class="fas fa-exclamation-triangle"></i></span>
                <span><small>Stock faible</small><strong>{{ number_format($lowStockCount, 0, ',', ' ') }}</strong></span>
                <em>≤ 5 unités</em>
            </a>
        </section>

        <section class="ma-traffic" aria-label="Trafic du site">
            <div class="ma-traffic-title">
                <span class="ma-live-dot" data-live-dot>●</span>
                <div><strong>Trafic</strong><small>Mise à jour toutes les 15 s</small></div>
            </div>
            <div class="ma-traffic-stat is-live"><small>En ligne</small><strong data-stat="realtime">{{ number_format($visitors['realtime'], 0, ',', ' ') }}</strong><span>5 dernières min</span></div>
            <div class="ma-traffic-stat"><small>Aujourd’hui</small><strong data-stat="today">{{ number_format($visitors['today'], 0, ',', ' ') }}</strong><span>visiteurs</span></div>
            <div class="ma-traffic-stat"><small>Cette semaine</small><strong data-stat="week">{{ number_format($visitors['week'], 0, ',', ' ') }}</strong><span>visiteurs</span></div>
            <div class="ma-traffic-stat"><small>Ce mois</small><strong data-stat="month">{{ number_format($visitors['month'], 0, ',', ' ') }}</strong><span>visiteurs</span></div>
            <div class="ma-traffic-stat is-alert"><small>Paniers abandonnés</small><strong data-stat="abandoned">{{ number_format($abandonedCarts, 0, ',', ' ') }}</strong><span>30 derniers jours</span></div>
        </section>

        @unless($hasPageViews)
            <div class="alert alert-warning">Le suivi des visites est indisponible : la table <code>page_views</code> n’existe pas.</div>
        @endunless

        <div class="ma-dash-grid">
            <section class="ma-dash-card">
                <div class="ma-card-head">
                    <div><h2>Produits les plus vus</h2><p>Popularité du catalogue</p></div>
                    <div class="ma-tabs" role="tablist">
                        <button type="button" class="is-active" data-period="day">Jour</button>
                        <button type="button" data-period="week">Semaine</button>
                        <button type="button" data-period="month">Mois</button>
                    </div>
                </div>

                @foreach(['day', 'week', 'month'] as $period)
                    <div class="ma-top-list {{ $period !== 'day' ? 'd-none' : '' }}" data-period-panel="{{ $period }}">
                        @forelse($topProducts[$period] as $row)
                            @php($product = $row['product'])
                            <div class="ma-top-row">
                                <span class="ma-rank">{{ $loop->iteration }}</span>
                                @if($product && $product->image)
                                    <img src="@image_url($product->image)" alt="" loading="lazy">
                                @else
                                    <span class="ma-product-placeholder"><i class="fas fa-box"></i></span>
                                @endif
                                <div class="ma-top-name">
                                    <strong>{{ ($product && $product->name) ? $product->name : Str::afterLast($row['path'], '/') }}</strong>
                                    <small>{{ number_format($row['views'], 0, ',', ' ') }} vue{{ $row['views'] > 1 ? 's' : '' }}</small>
                                </div>
                                @if($product)
                                    <a href="{{ route('admin.products.edit', $product) }}" aria-label="Modifier {{ $product->name }}"><i class="fas fa-arrow-right"></i></a>
                                @endif
                            </div>
                        @empty
                            <div class="ma-empty">Aucune vue enregistrée sur cette période.</div>
                        @endforelse
                    </div>
                @endforeach
            </section>

            <section class="ma-dash-card">
                <div class="ma-card-head">
                    <div><h2>Commandes récentes</h2><p>Les 6 dernières commandes</p></div>
                    <a href="{{ route('admin.orders.index') }}" class="ma-see-all">Tout voir</a>
                </div>
                <div class="ma-orders">
                    @forelse($latestOrders as $order)
                        @php
                            $status = strtolower((string) $order->status);
                            $statusLabels = ['pending' => 'En attente', 'confirmed' => 'Confirmée', 'completed' => 'Terminée', 'cancelled' => 'Annulée'];
                        @endphp
                        <a href="{{ route('admin.orders.show', $order) }}" class="ma-order-row">
                            <span class="ma-order-id">#{{ $order->id }}</span>
                            <span class="ma-order-client"><strong>{{ trim(($order->firstnames ?? '') . ' ' . ($order->lastname ?? '')) ?: 'Client' }}</strong><small>{{ optional($order->created_at)->format('d/m/Y H:i') }}</small></span>
                            <span class="ma-status is-{{ $status }}">{{ $statusLabels[$status] ?? ucfirst($status ?: '—') }}</span>
                            <strong class="ma-order-total">{{ number_format((float) $order->total, 0, ',', ' ') }} F</strong>
                        </a>
                    @empty
                        <div class="ma-empty">Aucune commande pour le moment.</div>
                    @endforelse
                </div>
            </section>
        </div>

        <section class="ma-dash-card ma-recent-products">
            <div class="ma-card-head">
                <div><h2>Produits récents</h2><p>Derniers ajouts au catalogue</p></div>
                <a href="{{ route('admin.products.index') }}" class="ma-see-all">Tout voir</a>
            </div>
            <div class="ma-product-strip">
                @forelse($latestProducts as $product)
                    <a href="{{ route('admin.products.edit', $product) }}" class="ma-product-mini">
                        @if($product->image)
                            <img src="@image_url($product->image)" alt="" loading="lazy">
                        @else
                            <span class="ma-product-placeholder"><i class="fas fa-box"></i></span>
                        @endif
                        <span><strong>{{ Str::limit($product->name, 28) }}</strong><small>{{ (int) $product->stock }} en stock · {{ $product->is_active ? 'En ligne' : 'Hors ligne' }}</small></span>
                    </a>
                @empty
                    <div class="ma-empty">Aucun produit.</div>
                @endforelse
            </div>
        </section>

        <footer class="ma-secondary-stats">
            <a href="{{ route('admin.categories.index') }}"><strong>{{ number_format($stats['categories']) }}</strong><span>Catégories</span></a>
            <a href="{{ route('admin.articles.index') }}"><strong>{{ number_format($stats['posts']) }}</strong><span>Articles</span></a>
            <a href="{{ route('admin.slider.index') }}"><strong>{{ number_format($stats['slides']) }}</strong><span>Sliders</span></a>
            <a href="{{ route('admin.newsletter.index') }}"><strong>{{ number_format($stats['newsletter']) }}</strong><span>Abonnés</span></a>
            <a href="{{ route('admin.users.index') }}"><strong>{{ number_format($stats['users']) }}</strong><span>Utilisateurs</span></a>
            <span><strong>{{ number_format($productsOfflineCount) }}</strong><span>Produits hors ligne</span></span>
        </footer>
    </div>
</div>
@endsection

@push('styles')
<style>
.ma-dash{background:#f5f7fa;min-height:100vh}.ma-dash .container-fluid{padding:28px 30px 40px}.ma-dash-head{display:flex;align-items:end;justify-content:space-between;gap:20px;margin-bottom:24px}.ma-dash-head p{margin:0 0 3px;color:#8a94a3;font-size:12px;text-transform:capitalize}.ma-dash-head h1{margin:0;color:#00234D;font-size:27px;font-weight:800;letter-spacing:-.03em}.ma-dash-actions{display:flex;gap:8px;flex-wrap:wrap}.ma-dash-btn{display:inline-flex;align-items:center;gap:7px;height:38px;padding:0 13px;border:1px solid #dde3ea;border-radius:10px;background:#fff;color:#00234D;font-size:11px;font-weight:700;text-decoration:none}.ma-dash-btn:hover{border-color:#ec4899;color:#ec4899}.ma-dash-btn.is-primary{background:#ec4899;color:#fff;border-color:#ec4899}.ma-dash-btn.is-primary:hover{background:#d63582;color:#fff}
.ma-kpis{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;margin-bottom:14px}.ma-kpi{display:grid;grid-template-columns:42px 1fr auto;align-items:center;gap:12px;padding:17px;background:#fff;border:1px solid #e5e9ef;border-radius:16px;text-decoration:none;transition:.18s}.ma-kpi:hover{transform:translateY(-2px);border-color:#ec4899;box-shadow:0 10px 25px rgba(0,35,77,.07)}.ma-kpi-icon{width:42px;height:42px;border-radius:12px;background:rgba(0,35,77,.07);color:#00234D;display:flex;align-items:center;justify-content:center}.ma-kpi small,.ma-kpi strong{display:block}.ma-kpi small{font-size:10px;text-transform:uppercase;letter-spacing:.08em;color:#8a94a3}.ma-kpi strong{font-size:22px;color:#00234D;line-height:1.2}.ma-kpi em{font-style:normal;font-size:10px;color:#98a2b3;text-align:right}.ma-kpi.is-warning .ma-kpi-icon{background:#fff7df;color:#d99400}.ma-kpi.is-danger .ma-kpi-icon{background:#fff0f3;color:#dc3545}
.ma-traffic{display:grid;grid-template-columns:1.2fr repeat(5,1fr);align-items:stretch;background:#00234D;border-radius:17px;overflow:hidden;margin-bottom:18px;color:#fff}.ma-traffic-title,.ma-traffic-stat{padding:16px 18px}.ma-traffic-title{display:flex;align-items:center;gap:10px}.ma-live-dot{color:#16a34a;font-size:12px}.ma-traffic-title strong,.ma-traffic-title small{display:block}.ma-traffic-title small{color:rgba(255,255,255,.45);font-size:9px}.ma-traffic-stat{border-left:1px solid rgba(255,255,255,.1)}.ma-traffic-stat small,.ma-traffic-stat strong,.ma-traffic-stat span{display:block}.ma-traffic-stat small{font-size:9px;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.5)}.ma-traffic-stat strong{font-size:21px;line-height:1.2;margin:2px 0;color:#fff}.ma-traffic-stat span{font-size:9px;color:rgba(255,255,255,.42)}.ma-traffic-stat.is-live strong{color:#5ee48a}.ma-traffic-stat.is-alert strong{color:#ff8dbe}
.ma-dash-grid{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:18px;margin-bottom:18px}.ma-dash-card{background:#fff;border:1px solid #e5e9ef;border-radius:17px;padding:20px;box-shadow:0 8px 24px rgba(0,35,77,.035)}.ma-card-head{display:flex;align-items:center;justify-content:space-between;gap:15px;margin-bottom:16px}.ma-card-head h2{margin:0;color:#00234D;font-size:15px;font-weight:800}.ma-card-head p{margin:2px 0 0;color:#98a2b3;font-size:10px}.ma-see-all{color:#ec4899;font-size:10px;font-weight:800;text-decoration:none;text-transform:uppercase;letter-spacing:.06em}.ma-tabs{display:flex;background:#f3f5f8;padding:3px;border-radius:9px}.ma-tabs button{border:0;background:transparent;padding:6px 9px;border-radius:7px;color:#7d8795;font-size:9px;font-weight:700}.ma-tabs button.is-active{background:#fff;color:#00234D;box-shadow:0 2px 7px rgba(0,35,77,.09)}
.ma-top-list,.ma-orders{display:flex;flex-direction:column}.ma-top-row,.ma-order-row{display:flex;align-items:center;gap:11px;min-height:58px;border-top:1px solid #f0f2f5}.ma-top-row:first-child,.ma-order-row:first-child{border-top:0}.ma-rank{width:22px;color:#a0a8b5;font-size:10px;font-weight:800;text-align:center}.ma-top-row img,.ma-product-mini img,.ma-product-placeholder{width:38px;height:38px;border-radius:9px;object-fit:cover;background:#f1f3f6;display:flex;align-items:center;justify-content:center;color:#a6aeba;flex:0 0 38px}.ma-top-name,.ma-order-client{flex:1;min-width:0}.ma-top-name strong,.ma-top-name small,.ma-order-client strong,.ma-order-client small{display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.ma-top-name strong,.ma-order-client strong{color:#26334a;font-size:11px}.ma-top-name small,.ma-order-client small{color:#9ba4b2;font-size:9px;margin-top:2px}.ma-top-row>a{color:#a8b0bc;padding:5px}.ma-order-row{text-decoration:none}.ma-order-id{color:#ec4899;font-size:10px;font-weight:800;width:31px}.ma-status{font-size:8px;font-weight:800;padding:5px 7px;border-radius:999px;background:#f0f2f5;color:#6d7785;text-transform:uppercase}.ma-status.is-pending{background:#fff5d8;color:#a66a00}.ma-status.is-completed,.ma-status.is-confirmed{background:#e8f8ee;color:#16813d}.ma-status.is-cancelled{background:#ffebee;color:#be2939}.ma-order-total{color:#00234D;font-size:10px;white-space:nowrap}.ma-empty{padding:28px;text-align:center;color:#9ba4b2;font-size:11px}
.ma-recent-products{margin-bottom:14px}.ma-product-strip{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:8px}.ma-product-mini{display:flex;align-items:center;gap:10px;padding:9px;border-radius:11px;text-decoration:none;border:1px solid transparent}.ma-product-mini:hover{background:#f8f9fb;border-color:#edf0f4}.ma-product-mini>span:last-child{min-width:0}.ma-product-mini strong,.ma-product-mini small{display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.ma-product-mini strong{font-size:10.5px;color:#26334a}.ma-product-mini small{font-size:8.5px;color:#9ba4b2;margin-top:3px}
.ma-secondary-stats{display:grid;grid-template-columns:repeat(6,1fr);background:#fff;border:1px solid #e5e9ef;border-radius:14px;overflow:hidden}.ma-secondary-stats>a,.ma-secondary-stats>span{display:flex;align-items:center;justify-content:center;gap:7px;padding:11px;border-left:1px solid #edf0f4;text-decoration:none}.ma-secondary-stats>*:first-child{border-left:0}.ma-secondary-stats strong{color:#00234D;font-size:13px}.ma-secondary-stats span span,.ma-secondary-stats a span{color:#9099a6;font-size:9px}
@media(max-width:1199.98px){.ma-kpis{grid-template-columns:repeat(2,1fr)}.ma-traffic{grid-template-columns:repeat(3,1fr)}.ma-traffic-title{grid-column:1/-1}.ma-traffic-stat:nth-of-type(1){border-left:0}.ma-secondary-stats{grid-template-columns:repeat(3,1fr)}.ma-secondary-stats>*:nth-child(4){border-left:0}}
@media(max-width:767.98px){.ma-dash .container-fluid{padding:20px 15px 32px}.ma-dash-head{align-items:flex-start;flex-direction:column}.ma-dash-head h1{font-size:23px}.ma-dash-actions{width:100%}.ma-dash-btn{flex:1;justify-content:center}.ma-kpis{grid-template-columns:1fr 1fr;gap:9px}.ma-kpi{grid-template-columns:36px 1fr;padding:12px;gap:9px}.ma-kpi-icon{width:36px;height:36px}.ma-kpi strong{font-size:18px}.ma-kpi em{display:none}.ma-traffic{grid-template-columns:1fr 1fr}.ma-traffic-title{grid-column:1/-1}.ma-traffic-stat:nth-of-type(odd){border-left:0}.ma-dash-grid{grid-template-columns:1fr}.ma-product-strip{grid-template-columns:1fr}.ma-secondary-stats{grid-template-columns:repeat(2,1fr)}.ma-secondary-stats>*:nth-child(odd){border-left:0}.ma-secondary-stats>*:nth-child(4){border-left:1px solid #edf0f4}.ma-order-total{display:none}}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('[data-period]');
    tabs.forEach(tab => tab.addEventListener('click', function () {
        tabs.forEach(item => item.classList.toggle('is-active', item === tab));
        document.querySelectorAll('[data-period-panel]').forEach(panel => panel.classList.toggle('d-none', panel.dataset.periodPanel !== tab.dataset.period));
    }));

    const url = @json(route('admin.dashboard.realtime'));
    const fmt = new Intl.NumberFormat('fr-FR');
    const dot = document.querySelector('[data-live-dot]');
    const refresh = async () => {
        try {
            const response = await fetch(url, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
            if (!response.ok) throw new Error();
            const data = await response.json();
            const values = { realtime: data.visitors?.realtime, today: data.visitors?.today, week: data.visitors?.week, month: data.visitors?.month, abandoned: data.abandonedCarts };
            Object.entries(values).forEach(([key, value]) => {
                const element = document.querySelector(`[data-stat="${key}"]`);
                if (element && value !== undefined) element.textContent = fmt.format(value);
            });
            if (dot) dot.style.color = '#16a34a';
        } catch (error) {
            if (dot) dot.style.color = '#dc2626';
        }
    };
    refresh();
    setInterval(refresh, 15000);
});
</script>
@endpush
