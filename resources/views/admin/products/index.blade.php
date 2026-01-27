@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Produits</h1>
                    <div class="small" style="color: var(--admin-muted);">Gère le catalogue affiché sur le site public.</div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-admin-primary">Ajouter</a>
                </div>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="row g-3 mb-3">
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="admin-card stat-card stat-card--primary p-3">
                        <div class="small" style="color: var(--admin-muted);">Produits</div>
                        <div class="h4 fw-bold mb-0">{{ number_format((int) ($productsTotalCount ?? 0), 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="admin-card stat-card stat-card--success p-3">
                        <div class="small" style="color: var(--admin-muted);">En ligne</div>
                        <div class="h4 fw-bold mb-0">{{ number_format((int) ($productsOnlineCount ?? 0), 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="admin-card stat-card stat-card--warning p-3">
                        <div class="small" style="color: var(--admin-muted);">Désactivés</div>
                        <div class="h4 fw-bold mb-0">{{ number_format((int) ($productsOfflineCount ?? 0), 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="admin-card stat-card stat-card--info p-3">
                        <div class="small" style="color: var(--admin-muted);">Produit le plus vendu</div>
                        @if(!empty($bestSellingProduct))
                            <div class="fw-semibold">{{ $bestSellingProduct['name'] }}</div>
                            <div class="small" style="color: var(--admin-muted);">{{ number_format((int) ($bestSellingProduct['qty'] ?? 0), 0, ',', '.') }} vendus</div>
                        @else
                            <div class="h4 fw-bold mb-0">—</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="admin-card p-3 p-md-4 mb-3">
                <form method="GET" action="{{ route('admin.products.index') }}" class="row g-2 align-items-end">
                    <div class="col-12 col-md-6">
                        <label class="form-label small" style="color: var(--admin-muted);">Recherche</label>
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Nom, SKU, slug">
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
                                <th style="width:72px;">Image</th>
                                <th>Produit</th>
                                <th>Catégorie</th>
                                <th class="text-end">Prix</th>
                                <th class="text-center">Actif</th>
                                <th style="width:160px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr style="border-top: 1px solid var(--admin-border);">
                                    <td>
                                        <div class="rounded-3 overflow-hidden" style="width:56px;height:56px;border:1px solid var(--admin-border);">
                                            <img src="{{ asset($product->image) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $product->name }}</div>
                                        <div class="small" style="color: var(--admin-muted);">{{ $product->sku ?: $product->slug }}</div>
                                    </td>
                                    <td>
                                        <div class="small">{{ $product->category?->name ?: '—' }}</div>
                                    </td>
                                    <td class="text-end">
                                        <div class="fw-semibold">{{ $product->formatted_price }}</div>
                                        @if($product->formatted_old_price)
                                            <div class="small" style="color: var(--admin-muted); text-decoration: line-through;">{{ $product->formatted_old_price }}</div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="online-pill {{ $product->is_active ? 'is-online' : 'is-offline' }}">
                                            <span class="online-dot" aria-hidden="true"></span>
                                            {{ $product->is_active ? 'En ligne' : 'Hors ligne' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-admin-ghost">Modifier</a>
                                            <form method="POST" action="{{ route('admin.products.toggle-active', $product) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm {{ $product->is_active ? 'btn-warning' : 'btn-success' }}">
                                                    {{ $product->is_active ? 'Désactiver' : 'Activer' }}
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Supprimer ce produit ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5" style="color: var(--admin-muted);">Aucun produit.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
