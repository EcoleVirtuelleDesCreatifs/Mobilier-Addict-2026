@extends('maquette.layout')

@section('title', $pageTitle . ' — Mobilier Addict')
@section('meta_description', 'Découvrez nos produits pour ' . $pageTitle . ' sur Mobilier Addict.')

@section('content')
    @php
        $productCount = method_exists($products, 'total') ? $products->total() : $products->count();
        $skin = $menuSkin ?? [];
        $hero = $skin['hero'] ?? null;
        $rail = $skin['rail'] ?? null;
        $kicker = $skin['kicker'] ?? null;

        $categoriesBySlug = $menuCategories->keyBy('slug');
        $resolveLink = function ($slug) use ($categoriesBySlug) {
            $category = $slug ? $categoriesBySlug->get($slug) : null;
            return $category ? route('category.show', $category->slug) : '#';
        };
    @endphp

    <!-- breadcrumb start -->
    <div class="breadcrumb">
        <div class="container">
            <ul class="list-unstyled d-flex align-items-center m-0">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li>
                    <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g opacity="0.4">
                            <path
                                d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                                fill="#000" />
                        </g>
                    </svg>
                </li>
                <li>{{ $pageTitle }}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <div class="collection col-v2 mt-100">
        <div class="container">
            <div class="row flex-row-reverse">
                <!-- product area start -->
                <div class="col-lg-9 col-md-12 col-12">
                    @if($hero && ($hero['type'] ?? 'col') === 'col')
                        <!-- collection hero start -->
                        <div class="col-hero" data-aos="fade-up" data-aos-duration="700">
                            <div class="col-hero-text">
                                <span class="col-hero-badge">
                                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 4v16" />
                                        <path d="M2 8h18a2 2 0 0 1 2 2v10" />
                                        <path d="M2 17h20" />
                                        <path d="M6 8v9" />
                                    </svg>
                                    {{ $hero['badge'] ?? 'Univers' }}
                                </span>
                                <h2 class="col-hero-title">{{ $hero['title'] ?? $pageTitle }}</h2>
                                <p class="col-hero-sub">{{ $hero['sub'] ?? '' }}</p>
                                @if(!empty($hero['chips']))
                                    <div class="col-hero-chips">
                                        @foreach($hero['chips'] as $chip)
                                            <a class="col-hero-chip" href="{{ $resolveLink($chip['slug'] ?? null) }}">{{ $chip['label'] }}</a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="col-hero-media d-none d-md-block">
                                <img loading="eager" fetchpriority="high" decoding="async" src="{{ asset($hero['image'] ?? 'assets/maquette/img/products/real/placeholder.jpg') }}" alt="{{ $hero['alt'] ?? $pageTitle }}">
                            </div>
                        </div>
                        <!-- collection hero end -->
                    @endif

                    <div class="filter-sort-wrapper d-flex justify-content-between flex-wrap">
                        <div class="collection-title-wrap d-flex align-items-end">
                            @php
                                $titleWords = preg_split('/\s+/', trim($pageTitle));
                                $titleLast = array_pop($titleWords);
                                $titleFirst = implode(' ', $titleWords);
                            @endphp
                            @if($kicker)
                                <div class="collection-title-stack">
                                    <p class="col-kicker">{{ $kicker }}</p>
                                    <h1 class="collection-title heading_24 mb-0">@if($titleFirst){{ $titleFirst }} @endif<span class="mp-title-accent">{{ $titleLast }}</span></h1>
                                </div>
                            @else
                                <h1 class="collection-title heading_24 mb-0">@if($titleFirst){{ $titleFirst }} @endif<span class="mp-title-accent">{{ $titleLast }}</span></h1>
                            @endif
                            <p class="collection-counter text_16 mb-0 ms-2">({{ $productCount }} article{{ $productCount > 1 ? 's' : '' }})</p>
                        </div>
                        <div class="filter-sorting">
                            <div class="collection-sorting position-relative d-none d-lg-block">
                                <div class="sorting-header text_16 d-flex align-items-center justify-content-end">
                                    <span class="sorting-title me-2">Trier par :</span>
                                    <span class="active-sorting">{{ $activeSortLabel ?? 'En vedette' }}</span>
                                    <span class="sorting-icon">
                                        <svg class="icon icon-down" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </div>
                                <ul class="sorting-lists list-unstyled m-0">
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
                            <div class="filter-drawer-trigger mobile-filter d-flex align-items-center d-lg-none">
                                <span class="mobile-filter-icon me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon icon-filter">
                                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                                    </svg>
                                </span>
                                <span class="mobile-filter-heading">Filtres et tri</span>
                            </div>
                        </div>
                    </div>

                    @if($rail && ($rail['type'] ?? '') === 'perks')
                        <!-- services inclus start -->
                        <div class="perk-strip-wrap" data-aos="fade-up" data-aos-duration="700">
                            <p class="type-rail-title">{{ $rail['title'] ?? '' }}</p>
                            <div class="perk-strip">
                                @foreach($rail['items'] as $perk)
                                    <div class="perk-item">
                                        <span class="perk-icon" aria-hidden="true">{!! $perk['svg'] !!}</span>
                                        <span class="perk-body">
                                            <span class="perk-name">{{ $perk['name'] }}</span>
                                            <span class="perk-text">{{ $perk['text'] }}</span>
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- services inclus end -->
                    @elseif($rail && ($rail['type'] ?? '') === 'types')
                        <!-- types rail start -->
                        <div class="type-rail-wrap" data-aos="fade-up" data-aos-duration="700">
                            <p class="type-rail-title">{{ $rail['title'] ?? '' }}</p>
                            <div class="type-rail">
                                @foreach($rail['items'] as $type)
                                    <a class="type-card {{ !empty($type['active']) ? 'active' : '' }}" href="{{ $resolveLink($type['slug'] ?? null) }}">
                                        <span class="type-card-img"><img loading="lazy" decoding="async" src="{{ asset($type['image'] ?? 'assets/maquette/img/products/real/placeholder.jpg') }}" alt="{{ $type['name'] }}"></span>
                                        <span class="type-card-body">
                                            <span class="type-card-name">{{ $type['name'] }}</span>
                                            @if(!empty($type['count']))
                                                <span class="type-card-count">{{ $type['count'] }} articles</span>
                                            @endif
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <!-- types rail end -->
                    @elseif($rail && ($rail['type'] ?? '') === 'rooms')
                        <!-- par piece start -->
                        <div class="room-tiles-wrap" data-aos="fade-up" data-aos-duration="700">
                            <p class="type-rail-title">{{ $rail['title'] ?? '' }}</p>
                            <div class="room-tiles">
                                @foreach($rail['items'] as $room)
                                    <a class="room-tile" href="{{ $resolveLink($room['slug'] ?? null) }}">
                                        <img loading="lazy" decoding="async" src="{{ asset($room['image'] ?? 'assets/maquette/img/products/real/placeholder.jpg') }}" alt="{{ $room['name'] }}">
                                        <span class="room-tile-label">
                                            <span class="room-tile-name">{{ $room['name'] }}</span>
                                            <span class="room-tile-arrow">
                                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12h14" />
                                                    <path d="m13 6 6 6-6 6" />
                                                </svg>
                                            </span>
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <!-- par piece end -->
                    @endif

                    <div class="collection-product-container">
                        <div class="row featured-grid">
                            @forelse($products as $product)
                                <div class="col-lg-4 col-md-6 col-12" data-aos="fade-up" data-aos-duration="700">
                                    @include('maquette.includes.shop-card')
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <h2 class="heading_24">Aucun produit disponible</h2>
                                    <p class="text_16 mt-2">Découvrez prochainement notre nouvelle sélection.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    @if(method_exists($products, 'links'))
                        <div class="pagination justify-content-center mt-100">
                            {{ $products->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
                <!-- product area end -->

                <!-- sidebar start -->
                <div class="col-lg-3 col-md-12 col-12">
                    @include('maquette.includes.menu-sidebar', ['sidebarCategories' => $menuCategories])
                </div>
                <!-- sidebar end -->
            </div>
        </div>
    </div>
    @include('maquette.includes.seo-schema', ['collectionProducts' => $products, 'collectionTitle' => $pageTitle])
@endsection
