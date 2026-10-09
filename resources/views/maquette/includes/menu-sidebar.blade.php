@php
    $sidebarCategories = $sidebarCategories ?? collect();
    $stockCounts = $stockCounts ?? ['in' => null, 'out' => null];
    $activeAvailability = (string) request()->query('availability', '');
    $currentSlug = request()->route('slug');
    $menuSlug = $menu->slug ?? null;
    $activeCategorySlug = ($currentSlug && $currentSlug !== $menuSlug) ? $currentSlug : null;
    $allUrl = $menuSlug ? route('menu.show', $menuSlug) : url()->current();

    $catIcon = function ($slug) {
        $slug = strtolower((string) $slug);
        $base = 'viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"';
        if (str_contains($slug, 'couette')) return '<svg ' . $base . '><path d="m12 2 9 5-9 5-9-5 9-5z"/><path d="m3 12 9 5 9-5"/><path d="m3 17 9 5 9-5"/></svg>';
        if (str_contains($slug, 'drap')) return '<svg ' . $base . '><path d="M3 20V8a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v12"/><path d="M3 20h18"/><path d="M7 6V4h10v2"/></svg>';
        if (str_contains($slug, 'oreiller') || str_contains($slug, 'traversin') || str_contains($slug, 'taie')) return '<svg ' . $base . '><path d="M5 11a2 2 0 0 1 2 2v2h10v-2a2 2 0 1 1 4 0v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="M5 11V9a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v2"/></svg>';
        if (str_contains($slug, 'matelas') || str_contains($slug, 'protege')) return '<svg ' . $base . '><path d="M3 18v-6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v6"/><path d="M3 18h18"/><path d="M6 10V7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v3"/></svg>';
        if (str_contains($slug, 'housse')) return '<svg ' . $base . '><path d="M4 4h16v16H4z" rx="2"/><path d="M4 9h16"/></svg>';
        if (str_contains($slug, 'lavage') || str_contains($slug, 'linge')) return '<svg ' . $base . '><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="12" cy="13" r="4"/><path d="M7 6h.01"/></svg>';
        return '<svg ' . $base . '><path d="m12 2 9 5-9 5-9-5 9-5z"/><path d="m3 12 9 5 9-5"/></svg>';
    };
@endphp

<div class="mp-sidebar collection-filter filter-drawer">
    <div class="filter-widget d-lg-none d-flex align-items-center justify-content-between">
        <h5 class="heading_24">Filtrer par</h5>
        <button type="button" class="btn-close text-reset filter-drawer-trigger d-lg-none"></button>
    </div>

    <div class="mp-filter-card d-lg-none">
        <h2 class="mp-filter-title">Trier par : <span class="mp-sort-active">{{ $activeSortLabel ?? 'En vedette' }}</span></h2>
        <ul class="sorting-lists-mobile list-unstyled m-0">
            <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'featured']) }}" class="text_14">En vedette</a></li>
            <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'bestseller']) }}" class="text_14">Meilleures ventes</a></li>
            <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'name-asc']) }}" class="text_14">Alphabétique, A-Z</a></li>
            <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'name-desc']) }}" class="text_14">Alphabétique, Z-A</a></li>
            <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'price-asc']) }}" class="text_14">Prix croissant</a></li>
            <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'price-desc']) }}" class="text_14">Prix décroissant</a></li>
            <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'date-asc']) }}" class="text_14">Date, ancien au récent</a></li>
            <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'date-desc']) }}" class="text_14">Date, récent à ancien</a></li>
        </ul>
    </div>

    @if($sidebarCategories->isNotEmpty())
        <div class="mp-filter-card">
            <h2 class="mp-filter-title">Catégories</h2>
            <ul class="mp-cat-list list-unstyled m-0">
                <li>
                    <a class="mp-cat-item {{ $activeCategorySlug ? '' : 'is-active' }}" href="{{ $allUrl }}">
                        <span class="mp-cat-icon">{!! '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>' !!}</span>
                        <span class="mp-cat-name">Tous</span>
                    </a>
                </li>
                @foreach($sidebarCategories as $cat)
                    <li>
                        <a class="mp-cat-item {{ $activeCategorySlug === $cat->slug ? 'is-active' : '' }}" href="{{ route('category.show', $cat->slug) }}">
                            <span class="mp-cat-icon">{!! $catIcon($cat->slug) !!}</span>
                            <span class="mp-cat-name">{{ $cat->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="mp-filters-form" method="GET" action="{{ url()->current() }}">
        @if(request('sort'))
            <input type="hidden" name="sort" value="{{ request('sort') }}">
        @endif

        @php
            $pBoundMin = (float) ($priceMin ?? 0);
            $pBoundMax = (float) ($priceMax ?? 0);
            $pSpan = max(1, $pBoundMax - $pBoundMin);
            $pSelMin = is_numeric(request('price_min')) ? (float) request('price_min') : $pBoundMin;
            $pSelMax = is_numeric(request('price_max')) ? (float) request('price_max') : $pBoundMax;
            $pSelMin = max($pBoundMin, min($pSelMin, $pBoundMax));
            $pSelMax = max($pBoundMin, min($pSelMax, $pBoundMax));
            $pLeft = round(($pSelMin - $pBoundMin) / $pSpan * 100, 1);
            $pRight = round(($pSelMax - $pBoundMin) / $pSpan * 100, 1);
        @endphp
        <div class="mp-filter-card">
            <h2 class="mp-filter-title">Prix</h2>
            <div class="mp-price-rail" aria-hidden="true">
                <span class="mp-price-rail-fill" style="left:{{ $pLeft }}%;width:{{ max(0, $pRight - $pLeft) }}%"></span>
                <span class="mp-price-handle" style="left:{{ $pLeft }}%"></span>
                <span class="mp-price-handle" style="left:{{ $pRight }}%"></span>
            </div>
            <div class="mp-price-inputs">
                <label class="mp-price-field">
                    <span>Min</span>
                    <input type="number" name="price_min" value="{{ request('price_min') }}" min="{{ (int) $pBoundMin }}" max="{{ (int) $pBoundMax }}" step="1000" placeholder="{{ number_format($pBoundMin, 0, ',', ' ') }}">
                </label>
                <label class="mp-price-field">
                    <span>Max</span>
                    <input type="number" name="price_max" value="{{ request('price_max') }}" min="{{ (int) $pBoundMin }}" max="{{ (int) $pBoundMax }}" step="1000" placeholder="{{ number_format($pBoundMax, 0, ',', ' ') }}">
                </label>
            </div>
            <button type="submit" class="mp-apply">Appliquer le prix</button>
        </div>

        <div class="mp-filter-card">
            <h2 class="mp-filter-title">Disponibilité</h2>
            <label class="mp-check">
                <input type="radio" name="availability" value="in" {{ $activeAvailability === 'in' ? 'checked' : '' }} onchange="this.form.submit()">
                <span class="mp-check-box" aria-hidden="true"></span>
                <span>En stock @if($stockCounts['in'] !== null)<em>({{ $stockCounts['in'] }})</em>@endif</span>
            </label>
            <label class="mp-check">
                <input type="radio" name="availability" value="out" {{ $activeAvailability === 'out' ? 'checked' : '' }} onchange="this.form.submit()">
                <span class="mp-check-box" aria-hidden="true"></span>
                <span>Rupture @if($stockCounts['out'] !== null)<em>({{ $stockCounts['out'] }})</em>@endif</span>
            </label>
        </div>

        @if(!empty($sidebarComforts) && count($sidebarComforts))
            <div class="mp-filter-card">
                <h2 class="mp-filter-title">Confort</h2>
                @foreach($sidebarComforts as $comfort)
                    <label class="mp-check">
                        <input type="checkbox" name="comfort[]" value="{{ $comfort['key'] }}" {{ in_array($comfort['key'], (array) request('comfort', []), true) ? 'checked' : '' }} onchange="this.form.submit()">
                        <span class="mp-check-box" aria-hidden="true"></span>
                        <span>{{ $comfort['label'] }}</span>
                    </label>
                @endforeach
            </div>
        @endif

        <button type="submit" class="mp-apply d-lg-none">Appliquer les filtres</button>
    </form>

    <a class="mp-reset" href="{{ url()->current() }}">Réinitialiser les filtres</a>
</div>
