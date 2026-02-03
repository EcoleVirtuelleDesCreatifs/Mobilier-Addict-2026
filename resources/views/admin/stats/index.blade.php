@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Statistiques</h1>
                    <div class="small" style="color: var(--admin-muted);">Synthèse des performances du site ({{ $currentMonth }}).</div>
                </div>
                <form method="GET" action="{{ route('admin.stats.index') }}" class="d-flex gap-2 align-items-center">
                    <input type="month" name="month" value="{{ $monthValue }}" class="form-control" style="max-width: 180px;">
                    <button type="submit" class="btn btn-admin-ghost">Appliquer</button>
                </form>
            </div>

            @if(!$hasOrders)
                <div class="alert alert-warning">Les tables de commandes ne sont pas disponibles. Les KPI "Ventes" seront à 0.</div>
            @endif

            @php
                $zones = [
                    [
                        'title' => 'Audience',
                        'subtitle' => "En attendant un tracking visiteurs, on affiche les vues d'articles si disponibles.",
                        'cards' => [
                            [
                                'label' => 'Visiteurs (mois)',
                                'value' => number_format($visitorsMonth),
                                'meta' => 'Total: ' . number_format($visitorsTotal),
                            ],
                            [
                                'label' => "Vues d'articles (mois)",
                                'value' => number_format($articleViewsMonth),
                                'meta' => "Total: " . number_format($articleViewsTotal),
                            ],
                        ],
                    ],
                    [
                        'title' => 'Ventes',
                        'subtitle' => 'Commandes et chiffre d’affaires.',
                        'action' => ['label' => 'Voir commandes', 'url' => route('admin.orders.index')],
                        'cards' => [
                            [
                                'label' => 'Commandes (mois)',
                                'value' => number_format($ordersMonthCount),
                                'meta' => 'Total: ' . number_format($ordersTotalCount),
                            ],
                            [
                                'label' => "Produits commandés (mois)",
                                'value' => number_format($productsOrderedMonth),
                                'meta' => 'Total: ' . number_format($productsOrderedTotal),
                            ],
                            [
                                'label' => "Chiffre d'affaires (mois)",
                                'value' => number_format($revenueMonth, 0, ',', ' '),
                                'meta' => 'Total: ' . number_format($revenueTotal, 0, ',', ' '),
                            ],
                            [
                                'label' => 'Valeur moyenne / commande',
                                'value' => number_format($avgOrderValue, 0, ',', ' '),
                                'meta' => null,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Catalogue',
                        'subtitle' => 'Inventaire et disponibilité.',
                        'action' => ['label' => 'Voir produits', 'url' => route('admin.products.index')],
                        'cards' => [
                            [
                                'label' => 'Produits en catalogue',
                                'value' => number_format($productsTotal),
                                'meta' => null,
                            ],
                        ],
                    ],
                ];
            @endphp

            <div class="row g-3">
                @foreach($zones as $zone)
                    <div class="col-12 col-xl-4">
                        <div class="admin-card p-3 p-md-4 h-100">
                            <div class="d-flex justify-content-between align-items-start gap-2">
                                <div>
                                    <div class="h5 mb-1">{{ $zone['title'] }}</div>
                                    <div class="small" style="color: var(--admin-muted);">{{ $zone['subtitle'] }}</div>
                                </div>
                                @if(isset($zone['action']))
                                    <a href="{{ $zone['action']['url'] }}" class="btn btn-admin-ghost btn-sm">{{ $zone['action']['label'] }}</a>
                                @endif
                            </div>

                            <div class="row g-3 mt-1">
                                @foreach($zone['cards'] as $card)
                                    <div class="col-12 col-md-6 col-xl-12">
                                        <div class="p-3 rounded-3" style="border: 1px solid var(--admin-border); background: rgba(255,255,255,.02);">
                                            <div class="small" style="color: var(--admin-muted);">{{ $card['label'] }}</div>
                                            <div class="h3 mb-1">{{ $card['value'] }}</div>
                                            @if(!empty($card['meta']))
                                                <div class="small" style="color: var(--admin-muted);">{{ $card['meta'] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
