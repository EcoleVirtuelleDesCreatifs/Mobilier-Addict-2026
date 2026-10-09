@extends('maquette.layout')

@section('title', $pageTitle . ' — Mobilier Addict')
@section('meta_description', 'Découvrez nos matelas sur Mobilier Addict : mémoire de forme, ressorts ensachés, latex. Livraison offerte.')

@section('content')
    @php
        $productCount = method_exists($products, 'total') ? $products->total() : $products->count();
        $heroProduct = $products->first();
        $heroImage = $heroProduct ? $heroProduct->image : null;

        $comfortFilters = [
            ['name' => 'Souple', 'lvl' => '25%', 'desc' => 'Accueil moelleux, effet cocon'],
            ['name' => 'Équilibré', 'lvl' => '50%', 'desc' => 'Le juste milieu, pour tous les dormeurs'],
            ['name' => 'Ferme', 'lvl' => '75%', 'desc' => 'Soutien renforcé, dos bien maintenu'],
            ['name' => 'Très ferme', 'lvl' => '100%', 'desc' => 'Maintien maximal, zéro affaissement'],
        ];
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
                    <!-- hero matelas -->
                    <div class="sleep-hero" data-aos="fade-up" data-aos-duration="700">
                        <div class="sleep-hero-content">
                            <span class="sleep-hero-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M2 4v16" />
                                    <path d="M2 8h18a2 2 0 0 1 2 2v10" />
                                    <path d="M2 17h20" />
                                    <path d="M6 8v9" />
                                </svg>
                                Univers chambre
                            </span>
                            <h2 class="sleep-hero-title">{{ $pageTitle }}</h2>
                            <p class="sleep-hero-sub">Mémoire de forme, ressorts ensachés ou latex :
                                trouvez le soutien qui vous ressemble et dormez enfin sur vos deux
                                oreilles.</p>
                            <div class="sleep-hero-stats">
                                <div class="sleep-stat">
                                    <strong>100</strong>
                                    <span>nuits d'essai</span>
                                </div>
                                <div class="sleep-stat">
                                    <strong>10 ans</strong>
                                    <span>de garantie</span>
                                </div>
                                <div class="sleep-stat">
                                    <strong>0 F</strong>
                                    <span>livraison offerte</span>
                                </div>
                            </div>
                        </div>
                        <div class="sleep-hero-media">
                            @if($heroImage)
                                <img loading="eager" fetchpriority="high" decoding="async" src="@image_url($heroImage)" alt="{{ $pageTitle }} Mobilier Addict">
                            @else
                                <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/img/products/real/placeholder.jpg') }}" alt="{{ $pageTitle }} Mobilier Addict">
                            @endif
                        </div>
                    </div>

                    <!-- guide de confort -->
                    @if($matelasCategories && $matelasCategories->count())
                        <div class="comfort-guide" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                            <p class="type-rail-title">Quel confort&nbsp;?</p>
                            <div class="comfort-grid">
                                @foreach($comfortFilters as $comfort)
                                    <a href="{{ route('menu.show', $menu->slug) }}#" class="comfort-card">
                                        <span class="comfort-name">{{ $comfort['name'] }}</span>
                                        <span class="comfort-bar"><i style="--lvl:{{ $comfort['lvl'] }}"></i></span>
                                        <span class="comfort-desc">{{ $comfort['desc'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="filter-sort-wrapper d-flex justify-content-between flex-wrap">
                        <div class="collection-title-wrap d-flex align-items-end">
                            <p class="collection-counter text_16 mb-0">{{ $productCount }} article{{ $productCount > 1 ? 's' : '' }}</p>
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
                                    <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'bestsellers']) }}" class="text_14">Meilleures ventes</a></li>
                                    <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'az']) }}" class="text_14">Alphabétique, A-Z</a></li>
                                    <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'za']) }}" class="text_14">Alphabétique, Z-A</a></li>
                                    <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'price-asc']) }}" class="text_14">Prix croissant</a></li>
                                    <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'price-desc']) }}" class="text_14">Prix décroissant</a></li>
                                    <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}" class="text_14">Date, ancien au récent</a></li>
                                    <li><a href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" class="text_14">Date, récent à ancien</a></li>
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

                    <div class="collection-product-container">
                        <div class="row featured-grid">
                            @forelse($products as $product)
                                <div class="col-lg-4 col-md-6 col-12" data-aos="fade-up" data-aos-duration="700">
                                    @include('maquette.includes.shop-card')
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <h2 class="heading_24">Aucun matelas disponible</h2>
                                    <p>Découvrez prochainement notre nouvelle sélection de matelas.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    @if(method_exists($products, 'links'))
                        <div class="pagination justify-content-center mt-100">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
                <!-- product area end -->

                <!-- sidebar start -->
                <div class="col-lg-3 col-md-12 col-12">
                    @include('maquette.includes.menu-sidebar', ['sidebarCategories' => $menuCategories ?? collect(), 'sidebarComforts' => $matelasCategories ?? collect()])
                </div>
                <!-- sidebar end -->
            </div>
        </div>
    </div>
    @include('maquette.includes.seo-schema', ['collectionProducts' => $products, 'collectionTitle' => $pageTitle])
@endsection
