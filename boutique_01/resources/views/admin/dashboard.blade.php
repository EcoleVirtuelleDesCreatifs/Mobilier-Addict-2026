@extends('layouts.admin')

@section('title', 'Administration')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="text-black font-w600 mb-1">Tableau de bord</h1>
                <p class="mb-0">Vue d'ensemble de la boutique</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap" style="gap:10px">
                            <a class="btn btn-admin-pink" href="{{ route('admin.products.create') }}"><i class="fas fa-plus me-2"></i>Créer un produit</a>
                            <a class="btn btn-admin-pink-outline" href="{{ route('admin.products.index') }}"><i class="fas fa-box me-2"></i>Gérer les produits</a>
                            <a class="btn btn-admin-pink-outline" href="{{ route('admin.orders.index') }}"><i class="fas fa-shopping-bag me-2"></i>Voir les commandes</a>
                            <a class="btn btn-admin-pink-outline" href="{{ route('admin.home_sections.index') }}"><i class="fas fa-sliders-h me-2"></i>Sections Home</a>
                            <a class="btn btn-admin-pink-outline" href="{{ route('admin.categories.index') }}"><i class="fas fa-folder me-2"></i>Catégories</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-xl-4 col-md-6">
                <div class="card card-bd">
                    <div class="bg-primary card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ number_format($stats['products']) }}</h2>
                                <span class="fs-14">Produits</span>
                            </div>
                            <i class="fas fa-box text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card card-bd">
                    <div class="bg-success card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ number_format($stats['categories']) }}</h2>
                                <span class="fs-14">Catégories</span>
                            </div>
                            <i class="fas fa-folder text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card card-bd">
                    <div class="bg-info card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ number_format($stats['posts']) }}</h2>
                                <span class="fs-14">Articles</span>
                            </div>
                            <i class="fas fa-newspaper text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card card-bd">
                    <div class="bg-warning card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ number_format($stats['slides']) }}</h2>
                                <span class="fs-14">Slides</span>
                            </div>
                            <i class="fas fa-images text-warning" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card card-bd">
                    <div class="bg-danger card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ number_format($stats['newsletter']) }}</h2>
                                <span class="fs-14">Abonnés newsletter</span>
                            </div>
                            <i class="fas fa-envelope text-danger" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card card-bd">
                    <div class="bg-secondary card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ number_format($stats['users']) }}</h2>
                                <span class="fs-14">Utilisateurs</span>
                            </div>
                            <i class="fas fa-users text-secondary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <h3 class="dash-section-title mb-3">E-commerce</h3>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-danger card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ $ordersMissing ? '—' : number_format($ordersTotalCount) }}</h2>
                                <span class="fs-14">Total commandes</span>
                            </div>
                            <i class="fas fa-shopping-bag text-danger" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-warning card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ $ordersMissing ? '—' : number_format($ordersPendingCount) }}</h2>
                                <span class="fs-14">Commandes en attente</span>
                            </div>
                            <i class="fas fa-hourglass-half text-warning" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-success card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ number_format($lowStockCount) }}</h2>
                                <span class="fs-14">Stock faible (≤ 5)</span>
                            </div>
                            <i class="fas fa-exclamation-triangle text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-info card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ number_format($productsOnlineCount) }}/{{ number_format($productsOfflineCount) }}</h2>
                                <span class="fs-14">Produits en ligne / hors ligne</span>
                            </div>
                            <i class="fas fa-boxes text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <h3 class="dash-section-title mb-3">Trafic</h3>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-success card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700" data-stat="realtime">{{ number_format($visitors['realtime']) }}</h2>
                                <span class="fs-14">En ligne maintenant <span class="badge bg-success ms-1" style="font-size:.6rem;">5 min</span> <span class="badge bg-light text-dark ms-1" data-live-dot style="font-size:.6rem;">● live</span></span>
                            </div>
                            <i class="fas fa-bolt text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-primary card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700" data-stat="today">{{ number_format($visitors['today']) }}</h2>
                                <span class="fs-14">Visiteurs aujourd'hui</span>
                            </div>
                            <i class="fas fa-user-clock text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-info card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700" data-stat="week">{{ number_format($visitors['week']) }}</h2>
                                <span class="fs-14">Visiteurs cette semaine</span>
                            </div>
                            <i class="fas fa-calendar-week text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-secondary card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700" data-stat="month">{{ number_format($visitors['month']) }}</h2>
                                <span class="fs-14">Visiteurs ce mois</span>
                            </div>
                            <i class="fas fa-calendar-alt text-secondary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-danger card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700" data-stat="abandoned">{{ number_format($abandonedCarts) }}</h2>
                                <span class="fs-14">Paniers abandonnés <span class="text-muted fs-12">(30 j)</span></span>
                            </div>
                            <i class="fas fa-cart-arrow-down text-danger" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Produits les plus vus</h4>
                    </div>
                    <div class="card-body">
                        @if(!$hasPageViews)
                            <div class="alert alert-warning mb-0">La table <code>page_views</code> n'existe pas encore. Les statistiques de vues seront disponibles après migration.</div>
                        @else
                            <div class="row g-4">
                                @foreach(['day' => "Aujourd'hui", 'week' => 'Cette semaine', 'month' => 'Ce mois'] as $period => $periodLabel)
                                    <div class="col-xl-4 col-md-6">
                                        <div class="fw-semibold mb-2">{{ $periodLabel }}</div>
                                        @forelse($topProducts[$period] as $item)
                                            <div class="d-flex align-items-center gap-2 py-1" style="border-bottom:1px solid #f1f1f4;">
                                                @if($item['product'] && $item['product']->image)
                                                    <img src="@image_url($item['product']->image)" class="rounded" width="36" height="36" style="object-fit:cover" alt="">
                                                @else
                                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="width:36px;height:36px;">
                                                        <i class="fas fa-box text-white" style="font-size:.8rem;"></i>
                                                    </div>
                                                @endif
                                                <div class="flex-grow-1" style="min-width:0;">
                                                    <div class="font-w600 fs-13 text-truncate">{{ $item['product']->name ?? $item['path'] }}</div>
                                                </div>
                                                <span class="badge badge-admin-pink">{{ number_format($item['views']) }} <i class="fas fa-eye ms-1"></i></span>
                                            </div>
                                        @empty
                                            <div class="text-muted fs-13">Aucune vue pour cette période.</div>
                                        @endforelse
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Dernières commandes</h4>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-admin-pink btn-sm">Voir tout</a>
                    </div>
                    <div class="card-body">
                        @if($ordersMissing)
                            <div class="alert alert-warning mb-0">La table <code>orders</code> n'existe pas encore. Les statistiques commandes seront disponibles après migration.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Client</strong></th>
                                            <th><strong>Statut</strong></th>
                                            <th><strong>Total</strong></th>
                                            <th><strong>Date</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($latestOrders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ trim(($order->firstnames ?? '') . ' ' . ($order->lastname ?? '')) ?: '—' }}</td>
                                                <td>
                                                    @php
                                                        $orderStatus = strtolower((string) ($order->status ?? ''));
                                                        $orderStatusLabel = $orderStatus === 'pending' ? 'En attente' : ($order->status ?? '—');
                                                    @endphp
                                                    <span class="badge badge-admin-pink">{{ $orderStatusLabel }}</span>
                                                </td>
                                                <td><strong>{{ number_format((float) ($order->total ?? 0), 0, ',', '.') }} F</strong></td>
                                                <td>{{ optional($order->created_at)->format('d M Y') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-admin-pink shadow btn-xs sharp">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Aucune commande</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Derniers produits</h4>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-admin-pink btn-sm">Voir tout</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th><strong>Produit</strong></th>
                                        <th><strong>Stock</strong></th>
                                        <th><strong>Statut</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($latestProducts as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($product->image)
                                                        <img src="@image_url($product->image)" class="rounded me-2" width="40" height="40" style="object-fit:cover" alt="">
                                                    @else
                                                        <div class="bg-secondary rounded me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                            <i class="fas fa-box text-white"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <span class="w-space-no font-w600">{{ Str::limit($product->name, 36) }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><strong>{{ (int) ($product->stock ?? 0) }}</strong></td>
                                            <td>
                                                @if($product->is_active)
                                                    <span class="badge badge-admin-pink">En ligne</span>
                                                @else
                                                    <span class="badge badge-secondary">Hors ligne</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-admin-pink shadow btn-xs sharp">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Aucun produit</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const url = @json(route('admin.dashboard.realtime'));
        const fmt = new Intl.NumberFormat('fr-FR');
        const dot = document.querySelector('[data-live-dot]');

        const refresh = async () => {
            try {
                const res = await fetch(url, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
                if (!res.ok) return;
                const data = await res.json();
                const map = {
                    realtime: data.visitors?.realtime,
                    today: data.visitors?.today,
                    week: data.visitors?.week,
                    month: data.visitors?.month,
                    abandoned: data.abandonedCarts,
                };
                Object.entries(map).forEach(([key, val]) => {
                    const el = document.querySelector(`[data-stat="${key}"]`);
                    if (el && val !== undefined) el.textContent = fmt.format(val);
                });
                if (dot) dot.style.color = '#16a34a';
            } catch (e) {
                if (dot) dot.style.color = '#dc2626';
            }
        };

        refresh();
        setInterval(refresh, 15000);
    });
</script>
@endpush
