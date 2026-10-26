@extends('layouts.admin')

@section('title', 'Produits')

@section('content')
    @php
        $sortLink = function (string $key) {
            $dir = request('sort') === $key && request('dir') === 'desc' ? 'asc' : 'desc';

            return route('admin.products.index', array_merge(request()->except(['sort', 'dir', 'page']), ['sort' => $key, 'dir' => $dir]));
        };
        $sortIcon = function (string $key) {
            if (request('sort') !== $key) {
                return '';
            }

            return request('dir') === 'asc' ? ' ↑' : ' ↓';
        };
    @endphp

    <div class="content-body">
        <div class="container-fluid">
            <x-admin.page-header title="Produits" subtitle="Gère le catalogue affiché sur le site public.">
                <a href="{{ route('admin.products.create') }}" class="btn btn-admin-pink"><i class="fa-solid fa-plus me-1"></i> Nouveau produit</a>
            </x-admin.page-header>

            <div class="row g-3 mb-3">
                <div class="col-6 col-xl-3">
                    <x-admin.stat label="Produits" :value="number_format((int) ($productsTotalCount ?? 0), 0, ',', ' ')" icon="fa-solid fa-couch" tone="navy" />
                </div>
                <div class="col-6 col-xl-3">
                    <x-admin.stat label="En ligne" :value="number_format((int) ($productsOnlineCount ?? 0), 0, ',', ' ')" icon="fa-solid fa-eye" tone="green" :href="route('admin.products.index', ['status' => 'online'])" />
                </div>
                <div class="col-6 col-xl-3">
                    <x-admin.stat label="Hors ligne" :value="number_format((int) ($productsOfflineCount ?? 0), 0, ',', ' ')" icon="fa-solid fa-eye-slash" tone="amber" :href="route('admin.products.index', ['status' => 'offline'])" />
                </div>
                <div class="col-6 col-xl-3">
                    <x-admin.stat label="Meilleure vente"
                        :value="!empty($bestSellingProduct) ? $bestSellingProduct['name'] : '—'"
                        :hint="!empty($bestSellingProduct) ? number_format((int) ($bestSellingProduct['qty'] ?? 0), 0, ',', ' ') . ' vendus' : null"
                        icon="fa-solid fa-trophy" tone="pink" />
                </div>
            </div>

            <div class="ad-card mb-3">
                <form method="GET" action="{{ route('admin.products.index') }}" class="ad-filters" data-auto-submit>
                    <div class="ad-filter-grow">
                        <label class="form-label">Recherche</label>
                        <div class="ad-input-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Nom, SKU, slug">
                        </div>
                    </div>
                    <div class="ad-filter">
                        <label class="form-label">Statut</label>
                        <select name="status" class="form-select">
                            <option value="">Tous</option>
                            <option value="online" @selected(request('status') === 'online')>En ligne</option>
                            <option value="offline" @selected(request('status') === 'offline')>Hors ligne</option>
                            <option value="low_stock" @selected(request('status') === 'low_stock')>Stock faible (≤ 5)</option>
                        </select>
                    </div>
                    <div class="ad-filter">
                        <label class="form-label">Menu</label>
                        <select name="menu_id" class="form-select">
                            <option value="">Tous</option>
                            @foreach ($filterMenus as $menu)
                                <option value="{{ $menu->id }}" @selected((int) request('menu_id') === $menu->id)>{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary">Filtrer</button>
                        @if (request()->hasAny(['q', 'status', 'menu_id']))
                            <a href="{{ route('admin.products.index') }}" class="btn btn-admin-ghost">Réinitialiser</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="ad-card overflow-hidden">
                <div class="table-responsive">
                    <table class="table ad-table align-middle">
                        <thead>
                            <tr>
                                <th><a href="{{ $sortLink('name') }}">Produit{{ $sortIcon('name') }}</a></th>
                                <th>Catégorie</th>
                                <th>Menus</th>
                                <th class="text-center"><a href="{{ $sortLink('stock') }}">Stock{{ $sortIcon('stock') }}</a></th>
                                <th class="text-end"><a href="{{ $sortLink('price') }}">Prix{{ $sortIcon('price') }}</a></th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                @php
                                    $stock = (int) ($product->stock ?? 0);
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ image_thumb($product->image) }}" alt="" class="ad-thumb" width="48" height="48" loading="lazy" decoding="async">
                                            <div style="min-width:0">
                                                <a href="{{ route('admin.products.edit', $product) }}" class="ad-strong d-block text-truncate" style="max-width:280px">{{ $product->name }}</a>
                                                <div class="ad-sub">{{ $product->sku ?: $product->slug }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="ad-sub">{{ $product->category ? $product->category->name : '—' }}</td>
                                    <td>
                                        @if (($product->menus ?? collect())->isNotEmpty())
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach ($product->menus as $menu)
                                                    <span class="badge badge-admin-pink">{{ $menu->name }}</span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="ad-sub">—</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="ad-badge {{ $stock <= 0 ? 'is-red' : ($stock <= 5 ? 'is-amber' : 'is-green') }}">{{ $stock }}</span>
                                    </td>
                                    <td class="text-end text-nowrap">
                                        <div class="ad-strong">{{ $product->formatted_price }}</div>
                                        @if ($product->formatted_old_price)
                                            <div class="ad-sub text-decoration-line-through">{{ $product->formatted_old_price }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="ad-badge {{ $product->is_active ? 'is-green' : 'is-gray' }}">{{ $product->is_active ? 'En ligne' : 'Hors ligne' }}</span>
                                    </td>
                                    <td>
                                        <div class="ad-actions">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-admin-ghost ad-btn-icon" title="Modifier"><i class="fa-solid fa-pen"></i></a>
                                            <form method="POST" action="{{ route('admin.products.toggle-active', $product) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-admin-ghost ad-btn-icon" title="{{ $product->is_active ? 'Mettre hors ligne' : 'Mettre en ligne' }}">
                                                    <i class="fa-solid {{ $product->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" data-confirm="Supprimer le produit « {{ $product->name }} » ?">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-admin-ghost ad-btn-icon text-danger" title="Supprimer"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7"><div class="ad-empty"><i class="fa-solid fa-couch"></i>Aucun produit trouvé.</div></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">{{ $products->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
@endsection
