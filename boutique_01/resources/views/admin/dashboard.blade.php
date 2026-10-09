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
