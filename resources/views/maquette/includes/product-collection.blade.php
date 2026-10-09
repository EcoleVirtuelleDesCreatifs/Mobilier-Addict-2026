@php
    $collectionProducts = $collectionProducts ?? collect();
    $collectionTitle = $collectionTitle ?? 'Tous les produits';
    $collectionDescription = $collectionDescription ?? null;
    $collectionCategories = $collectionCategories ?? collect();
    $productCount = method_exists($collectionProducts, 'total') ? $collectionProducts->total() : $collectionProducts->count();
    $hasSidebar = $collectionCategories->isNotEmpty();
    $hideHeader = $hideCollectionTitle ?? false;
@endphp

@if(!$hideHeader)
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
            <li>{{ $collectionTitle }}</li>
        </ul>
    </div>
</div>
<!-- breadcrumb end -->
@endif

<div class="collection {{ $hideHeader ? 'pt-0' : 'mt-100' }}">
    <div class="container">
        <div class="row">
            <!-- product area start -->
            <div class="{{ $hasSidebar ? 'col-lg-9' : 'col-lg-12' }} col-md-12 col-12">
                <div class="filter-sort-wrapper d-flex justify-content-between flex-wrap">
                    @if(!$hideHeader)
                    <div class="collection-title-wrap d-flex align-items-end">
                        @php
                                $ctWords = preg_split('/\s+/', trim($collectionTitle));
                                $ctLast = array_pop($ctWords);
                                $ctFirst = implode(' ', $ctWords);
                            @endphp
                            <h1 class="collection-title heading_24 mb-0">@if($ctFirst){{ $ctFirst }} @endif<span class="mp-title-accent">{{ $ctLast }}</span></h1>
                        <p class="collection-counter text_16 mb-0 ms-2">({{ $productCount }} articles)</p>
                    </div>
                    @else
                    <p class="collection-counter text_16 mb-0">{{ $productCount }} article{{ $productCount > 1 ? 's' : '' }}</p>
                    @endif
                    @if($collectionDescription)
                        <p class="text_14 mt-2 mb-0 w-100">{{ $collectionDescription }}</p>
                    @endif
                    <div class="filter-sorting">
                        <div class="collection-sorting position-relative d-none d-lg-block">
                            <div class="sorting-header text_16 d-flex align-items-center justify-content-end">
                                <span class="sorting-title me-2">Trier par :</span>
                                <span class="active-sorting">{{ $activeSortLabel ?? 'En vedette' }}</span>
                                <span class="sorting-icon">
                                    <svg class="icon icon-down" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-chevron-down">
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                                </svg>
                            </span>
                            <span class="mobile-filter-heading">{{ $hasSidebar ? 'Filtres et tri' : 'Tri' }}</span>
                        </div>
                    </div>
                </div>
                <div class="collection-product-container">
                    <div class="row featured-grid">
                        @forelse($collectionProducts as $product)
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

                @if(method_exists($collectionProducts, 'links'))
                    <div class="pagination justify-content-center mt-100">
                        {{ $collectionProducts->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
            <!-- product area end -->

            @if($hasSidebar)
                <!-- sidebar start -->
                <div class="col-lg-3 col-md-12 col-12">
                    @include('maquette.includes.menu-sidebar', ['sidebarCategories' => $collectionCategories])
                </div>
                <!-- sidebar end -->
            @endif
        </div>
    </div>
</div>
@include('maquette.includes.seo-schema')
