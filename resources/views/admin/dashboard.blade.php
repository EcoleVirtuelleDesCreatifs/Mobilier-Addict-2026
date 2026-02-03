@extends('layouts.admin')

@section('title', 'Administration')

@section('content')
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <!-- En-tête avec sélecteur de mois -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="text-black font-w600 mb-1">Tableau de Bord</h1>
                        <p class="mb-0">Statistiques pour {{ $currentMonth }}</p>
                    </div>
                    <div>
                        <select id="monthSelector" class="form-select" style="width: 200px;">
                            <option value="{{ Carbon\Carbon::now()->format('Y-m') }}">{{ Carbon\Carbon::now()->format('F Y') }}</option>
                            @for($i = 1; $i <= 11; $i++)
                                @php
                                    $date = Carbon\Carbon::now()->subMonths($i);
                                @endphp
                                <option value="{{ $date->format('Y-m') }}">{{ $date->format('F Y') }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques générales -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-primary card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ number_format($articlesCount) }}</h2>
                                <span class="fs-14">Total Articles</span>
                            </div>
                            <i class="fas fa-newspaper text-primary" style="font-size: 2rem;"></i>
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
                                <h2 class="num-text text-black font-w700">{{ number_format($categoriesCount) }}</h2>
                                <span class="fs-14">Catégories</span>
                            </div>
                            <i class="fas fa-folder text-success" style="font-size: 2rem;"></i>
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
                                <h2 class="num-text text-black font-w700">{{ number_format($usersCount) }}</h2>
                                <span class="fs-14">Utilisateurs</span>
                            </div>
                            <i class="fas fa-users text-warning" style="font-size: 2rem;"></i>
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
                                <h2 class="num-text text-black font-w700">{{ number_format($totalViews) }}</h2>
                                <span class="fs-14">Total Vues</span>
                            </div>
                            <i class="fas fa-eye text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <h3 class="text-black font-w600 mb-3">Actions rapides</h3>
            </div>
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
            <div class="col-12">
                <h3 class="text-black font-w600 mb-3">Navigation</h3>
            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Menus (Header)</h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.menus.index') }}" class="btn btn-admin-pink btn-sm">Gérer</a>
                            <a href="{{ route('admin.menus.create') }}" class="btn btn-admin-pink-outline btn-sm">Ajouter</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(($headerMenus ?? collect())->isEmpty())
                            <div class="text-muted">Aucun menu header.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-responsive-md mb-0">
                                    <thead>
                                        <tr>
                                            <th><strong>Nom</strong></th>
                                            <th><strong>URL</strong></th>
                                            <th class="text-center"><strong>Ordre</strong></th>
                                            <th class="text-center"><strong>Actif</strong></th>
                                            <th class="text-end"><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($headerMenus as $menu)
                                            <tr>
                                                <td>
                                                    <div class="fw-semibold">{{ $menu->name }}</div>
                                                    @if($menu->children->count() > 0)
                                                        <small class="text-muted">{{ $menu->children->count() }} sous-menu(s)</small>
                                                    @endif
                                                </td>
                                                <td class="text-muted">{{ $menu->url ?: '—' }}</td>
                                                <td class="text-center">{{ (int) $menu->order }}</td>
                                                <td class="text-center">
                                                    <span class="badge {{ $menu->is_active ? 'badge-success' : 'badge-secondary' }}">{{ $menu->is_active ? 'Oui' : 'Non' }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-admin-pink shadow btn-xs sharp">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <h3 class="text-black font-w600 mb-3">E-commerce</h3>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-danger card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700">{{ $ordersMissing ? '—' : number_format($ordersTotalCount) }}</h2>
                                <span class="fs-14">Total Commandes</span>
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
            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Dernières Commandes</h4>
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
                        <h4 class="card-title">Derniers Produits</h4>
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
                                                        <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset($product->image) }}" class="rounded me-2" width="40" height="40" style="object-fit:cover" alt="">
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

        <!-- Statistiques mensuelles -->
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="text-black font-w600 mb-3">Statistiques Mensuelles</h3>
            </div>
        </div>

        <div class="row mb-4" id="monthlyStatsRow">
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="card card-bd">
                    <div class="bg-primary card-border"></div>
                    <div class="card-body box-style">
                        <div class="media align-items-center">
                            <div class="media-body me-3">
                                <h2 class="num-text text-black font-w700" id="monthlyViewsCount">{{ number_format($monthlyViews) }}</h2>
                                <span class="fs-14">Vues du Mois</span>
                            </div>
                            <i class="fas fa-chart-line text-primary" style="font-size: 2rem;"></i>
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
                                <h2 class="num-text text-black font-w700" id="monthlyVisitorsCount">{{ number_format($monthlyVisitors) }}</h2>
                                <span class="fs-14">Visiteurs du Mois</span>
                            </div>
                            <i class="fas fa-user-friends text-success" style="font-size: 2rem;"></i>
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
                                <h2 class="num-text text-black font-w700" id="bestArticleViews">{{ $bestArticle ? number_format($bestArticle->views_count ?? 0) : '0' }}</h2>
                                <span class="fs-14">Meilleur Article</span>
                                @if($bestArticle)
                                    <small class="d-block text-muted">{{ Str::limit($bestArticle->title, 25) }}</small>
                                @endif
                            </div>
                            <i class="fas fa-trophy text-warning" style="font-size: 2rem;"></i>
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
                                <h2 class="num-text text-black font-w700" id="bestCategoryViews">{{ $bestCategory ? number_format($bestCategory->total_views ?? 0) : '0' }}</h2>
                                <span class="fs-14">Meilleure Catégorie</span>
                                @if($bestCategory)
                                    <small class="d-block text-muted">{{ $bestCategory->title }}</small>
                                @endif
                            </div>
                            <i class="fas fa-star text-danger" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Détails des performances -->
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Top 5 Articles du Mois</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th><strong>Article</strong></th>
                                        <th><strong>Catégorie</strong></th>
                                        <th><strong>Vues</strong></th>
                                        <th><strong>Date</strong></th>
                                        <th><strong>Actions</strong></th>
                                    </tr>
                                </thead>
                                <tbody id="topArticlesTable">
                                    @forelse($topArticles as $article)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($article->image)
                                                    <img src="{{ asset('storage/' . $article->image) }}" class="rounded me-2" width="40" alt="">
                                                @else
                                                    <div class="bg-secondary rounded me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                        <i class="fas fa-newspaper text-white"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <span class="w-space-no font-w600">{{ Str::limit($article->title, 40) }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($article->category)
                                                <span class="badge badge-primary">{{ $article->category->title }}</span>
                                            @else
                                                <span class="badge badge-secondary">Aucune</span>
                                            @endif
                                        </td>
                                        <td><strong>{{ number_format($article->views_count ?? 0) }}</strong></td>
                                        <td>{{ $article->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-admin-pink shadow btn-xs sharp me-1">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Aucun article trouvé pour cette période</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Top 5 Catégories du Mois</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th><strong>Catégorie</strong></th>
                                        <th><strong>Vues</strong></th>
                                    </tr>
                                </thead>
                                <tbody id="topCategoriesTable">
                                    @forelse($categoryStats as $category)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-folder text-primary me-2"></i>
                                                <span class="font-w600">{{ $category->title }}</span>
                                            </div>
                                        </td>
                                        <td><strong>{{ number_format($category->total_views ?? 0) }}</strong></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="text-center">Aucune catégorie trouvée</td>
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
<!--**********************************
    Content body end
***********************************-->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const monthSelector = document.getElementById('monthSelector');

    if (monthSelector) {
        monthSelector.addEventListener('change', function() {
            const selectedMonth = this.value;

            // Afficher un loader
            const statsRow = document.getElementById('monthlyStatsRow');
            if (statsRow) {
                statsRow.style.opacity = '0.5';
            }

            // Requête AJAX pour récupérer les nouvelles statistiques
            fetch(`{{ route('admin.dashboard.monthly-stats') }}?month=${selectedMonth}`)
                .then(response => response.json())
                .then(data => {
                    // Mettre à jour les compteurs
                    document.getElementById('monthlyViewsCount').textContent = new Intl.NumberFormat().format(data.monthlyViews);
                    document.getElementById('monthlyVisitorsCount').textContent = new Intl.NumberFormat().format(data.monthlyVisitors);

                    if (data.bestArticle) {
                        document.getElementById('bestArticleViews').textContent = new Intl.NumberFormat().format(data.bestArticle.views_count || 0);
                    } else {
                        document.getElementById('bestArticleViews').textContent = '0';
                    }

                    if (data.bestCategory) {
                        document.getElementById('bestCategoryViews').textContent = new Intl.NumberFormat().format(data.bestCategory.total_views || 0);
                    } else {
                        document.getElementById('bestCategoryViews').textContent = '0';
                    }

                    // Restaurer l'opacité
                    if (statsRow) {
                        statsRow.style.opacity = '1';
                    }
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des statistiques:', error);
                    if (statsRow) {
                        statsRow.style.opacity = '1';
                    }
                });
        });
    }
});
</script>

@endsection
