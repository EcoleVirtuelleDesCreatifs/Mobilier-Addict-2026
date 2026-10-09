@extends('maquette.layout')

@section('title', $product->name . ' à Abidjan — Mobilier Addict Côte d\'Ivoire')
@section('meta_description', Str::limit(strip_tags($product->short_description ?: $product->description ?: 'Achetez ' . $product->name . ' à Abidjan chez Mobilier Addict.'), 155))

@section('content')
    @php
        $primaryCategory = $product->categories->first() ?: $product->category;
        $gallery = collect($product->images ?? $product->gallery ?? [])->filter()->values();
        if ($gallery->isEmpty() && $product->image) $gallery->push($product->image);
        if ($gallery->isEmpty()) $gallery->push('assets/maquette/img/products/real/placeholder.jpg');
        $features = collect([
            'Dimensions' => $product->dimensions,
            'Matière' => $product->material,
            'Couleur' => $product->color,
            'Fermeté' => $product->firmness,
            'Épaisseur' => $product->thickness,
            'Taille' => $product->size,
            'Référence' => $product->sku,
        ])->filter();
        $inStock = (int) $product->stock > 0;
        $discount = ($product->old_price && $product->old_price > $product->price)
            ? round((($product->old_price - $product->price) / $product->old_price) * 100) : null;
        $colors = collect($product->available_colors)->filter()->values();
        if ($colors->isEmpty() && $product->color) $colors = collect([$product->color]);
        $colorHex = function ($name) {
            $map = [
                'blanc' => '#f4f4f2', 'white' => '#f4f4f2', 'beige' => '#e7d3bd', 'creme' => '#f1e6d4', 'crème' => '#f1e6d4',
                'gris' => '#b8bec7', 'grey' => '#b8bec7', 'bleu' => '#3b82c4', 'blue' => '#3b82c4', 'marine' => '#123e6d',
                'vert' => '#7cb661', 'green' => '#7cb661', 'kaki' => '#9a9b6c', 'rose' => '#f2b8cf', 'pink' => '#f2b8cf',
                'rouge' => '#c2433f', 'bordeaux' => '#8c2f45', 'jaune' => '#f0c75e', 'orange' => '#e8964a',
                'marron' => '#8a6248', 'taupe' => '#b0a18e', 'noir' => '#2b2b2b', 'black' => '#2b2b2b',
                'violet' => '#8a6fb8', 'lila' => '#c8a8d8', 'turquoise' => '#4fb8ae', 'dore' => '#d4af6e', 'doré' => '#d4af6e',
            ];
            $key = Str::lower(trim((string) $name));
            foreach ($map as $k => $hex) {
                if (str_contains($key, $k)) return $hex;
            }
            return '#dfe4ea';
        };
        $rating = (float) ($product->rating ?? 0);
        $reviews = (int) ($product->reviews_count ?? 0);
        $editorialImage = $gallery->get(1) ?? $gallery->first();
    @endphp

    <!-- breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <ul class="list-unstyled d-flex align-items-center m-0">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                @if($primaryCategory)
                    <li><svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"><g opacity="0.4"><path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000"/></g></svg></li>
                    <li><a href="{{ route('category.show', $primaryCategory->slug) }}">{{ $primaryCategory->name }}</a></li>
                @endif
                <li><svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"><g opacity="0.4"><path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000"/></g></svg></li>
                <li>{{ $product->name }}</li>
            </ul>
        </div>
    </div>

    <main id="MainContent" class="content-for-layout">
        <div class="pdp mt-60">
            <div class="container">
                <div class="row">
                    <!-- gallery -->
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="pdp-gallery">
                            <div class="pdp-main-img">
                                @if($discount)
                                    <span class="mp-badge">-{{ $discount }}%</span>
                                @elseif($product->badge)
                                    <span class="mp-badge">{{ $product->badge }}</span>
                                @endif
                                <button type="button" class="mp-wish" aria-label="Ajouter aux favoris">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                                </button>
                                <img id="pdpMainImg" src="@image_url($gallery->first())" alt="{{ $product->name }}">
                                @if($gallery->count() > 1)
                                    <button type="button" class="pdp-arrow pdp-prev" aria-label="Image précédente">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                                    </button>
                                    <button type="button" class="pdp-arrow pdp-next" aria-label="Image suivante">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                    </button>
                                @endif
                            </div>
                            @if($gallery->count() > 1)
                                <div class="pdp-thumbs">
                                    @foreach($gallery as $image)
                                        <button type="button" class="pdp-thumb {{ $loop->first ? 'is-active' : '' }}" data-img="@image_url($image)" aria-label="Voir l'image {{ $loop->iteration }}">
                                            <img loading="lazy" decoding="async" src="@image_url($image)" alt="{{ $product->name }} — vue {{ $loop->iteration }}">
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- details -->
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="pdp-details">
                            @if($primaryCategory)
                                <p class="pdp-kicker">{{ $primaryCategory->name }}</p>
                            @endif
                            <h1 class="pdp-title">{{ $product->name }}</h1>
                            @if($product->size || $product->dimensions || $product->thickness)
                                <p class="pdp-subline">{{ collect([$product->size, $product->dimensions, $product->thickness ? 'Ép. '.$product->thickness : null])->filter()->join(' · ') }}</p>
                            @endif
                            <div class="pdp-rating">
                                <span class="pdp-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg viewBox="0 0 24 24" fill="{{ $i <= round($rating) ? '#f5a623' : 'none' }}" stroke="{{ $i <= round($rating) ? '#f5a623' : '#d5dbe4' }}" stroke-width="1.6"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/></svg>
                                    @endfor
                                </span>
                                <span class="pdp-reviews">({{ $reviews }} avis clients)</span>
                            </div>
                            <div class="pdp-price-row">
                                <span class="pdp-price" id="pdpPrice">{{ number_format((float) $product->price, 0, ',', ' ') }} FCFA</span>
                                @if($product->old_price && $product->old_price > $product->price)
                                    <del class="pdp-price-old">{{ number_format((float) $product->old_price, 0, ',', ' ') }} FCFA</del>
                                @endif
                                <span class="pdp-stock {{ $inStock ? 'is-in' : 'is-out' }}">{{ $inStock ? 'En stock' : 'Rupture' }}</span>
                            </div>
                            @if($product->short_description)
                                <p class="pdp-desc">{{ Str::limit(strip_tags($product->short_description), 140) }}</p>
                            @endif

                            <form class="pdp-form" action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="redirect_to" value="">

                                @if($product->variants->isNotEmpty())
                                    <div class="pdp-field">
                                        <span class="pdp-label">Taille</span>
                                        <div class="pdp-pills">
                                            @foreach($product->variants as $variant)
                                                @php
                                                    $vLabel = collect([
                                                        $variant->dimensions,
                                                        $variant->places ? str_pad((string) $variant->places, 2, '0', STR_PAD_LEFT).' Places' : null,
                                                        $variant->thickness_cm ? $variant->thickness_cm.' cm' : null,
                                                        $variant->variant_type,
                                                    ])->filter()->join(' · ') ?: 'Option '.$loop->iteration;
                                                    $vPrice = (float) ($variant->price ?: $product->price);
                                                @endphp
                                                <label class="pdp-pill">
                                                    <input type="radio" name="product_variant_id" value="{{ $variant->id }}" data-price="{{ $vPrice }}" {{ $loop->first ? 'checked' : '' }}>
                                                    <span>{{ $vLabel }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if($colors->isNotEmpty())
                                    <div class="pdp-field">
                                        <span class="pdp-label">Couleur</span>
                                        <div class="pdp-swatches">
                                            @foreach($colors as $c)
                                                <label class="pdp-swatch" title="{{ $c }}">
                                                    <input type="radio" name="selected_color" value="{{ $c }}" {{ $loop->first ? 'checked' : '' }}>
                                                    <span style="background:{{ $colorHex($c) }}"></span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="pdp-field">
                                    <span class="pdp-label">Quantité</span>
                                    <div class="mp-qty pdp-qty">
                                        <button type="button" class="mp-qty-btn" data-qty-step="-1" aria-label="Diminuer">−</button>
                                        <input class="mp-qty-input" type="text" name="quantity" value="1" inputmode="numeric" aria-label="Quantité">
                                        <button type="button" class="mp-qty-btn" data-qty-step="1" aria-label="Augmenter">+</button>
                                    </div>
                                </div>

                                <div class="pdp-ctas">
                                    <button type="submit" class="pdp-atc" {{ !$inStock ? 'disabled' : '' }}>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1.5"/><circle cx="19" cy="21" r="1.5"/><path d="M2.5 3h2l2.6 12.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L22 7H6"/></svg>
                                        Ajouter au panier
                                    </button>
                                    <button type="submit" class="pdp-buy" data-redirect="shipping" {{ !$inStock ? 'disabled' : '' }}>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h7l-1 8 10-12h-7l1-8z"/></svg>
                                        Commander directement
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- perks -->
                <div class="pdp-perks">
                    <div class="pdp-perk">
                        <span class="pdp-perk-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.62l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg></span>
                        <span><strong>Livraison rapide</strong><small>Partout en Côte d'Ivoire</small></span>
                    </div>
                    <div class="pdp-perk">
                        <span class="pdp-perk-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg></span>
                        <span><strong>Produits de qualité</strong><small>Sélectionnés pour vous</small></span>
                    </div>
                    <div class="pdp-perk">
                        <span class="pdp-perk-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 14v-3a9 9 0 0 1 18 0v3"/><path d="M21 19a2 2 0 0 1-2 2h-1v-7h3v5z"/><path d="M3 19a2 2 0 0 0 2 2h1v-7H3v5z"/></svg></span>
                        <span><strong>Besoin d'aide ?</strong><small>Notre équipe vous accompagne</small></span>
                    </div>
                </div>

                <!-- tabs -->
                <div class="pdp-tabs" data-aos="fade-up" data-aos-duration="700">
                    <nav class="pdp-tab-nav" id="pdpTabs">
                        <a class="pdp-tab-link active" href="#pdp-desc" data-bs-toggle="tab">Description</a>
                        <a class="pdp-tab-link" href="#pdp-specs" data-bs-toggle="tab">Caractéristiques</a>
                        <a class="pdp-tab-link" href="#pdp-ship" data-bs-toggle="tab">Livraison &amp; retour</a>
                        <a class="pdp-tab-link" href="#pdp-reviews" data-bs-toggle="tab">Avis clients ({{ $reviews }})</a>
                    </nav>
                    <div class="tab-content pdp-tab-content">
                        <div id="pdp-desc" class="tab-pane fade show active">
                            <div class="row align-items-center g-5">
                                <div class="col-lg-6">
                                    <img class="pdp-desc-img" loading="lazy" decoding="async" src="@image_url($editorialImage)" alt="{{ $product->name }}">
                                </div>
                                <div class="col-lg-6">
                                    <h2 class="pdp-desc-title">Pensé pour vos <span class="mp-title-accent">nuits.</span></h2>
                                    <p class="pdp-desc-text">{{ Str::limit(strip_tags($product->description ?: $product->short_description), 260) ?: 'Un produit sélectionné avec soin pour transformer votre quotidien en toute simplicité.' }}</p>
                                    <ul class="pdp-benefits list-unstyled m-0">
                                        <li>
                                            <span class="pdp-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg></span>
                                            <span><strong>Doux et confortable</strong><small>Une sensation agréable au quotidien</small></span>
                                        </li>
                                        <li>
                                            <span class="pdp-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v8"/><path d="m16 6-4 4-4-4"/><path d="M4 12a8 8 0 0 0 16 0"/><path d="M4 20h16"/></svg></span>
                                            <span><strong>Respirant</strong><small>Idéal pour un sommeil paisible</small></span>
                                        </li>
                                        <li>
                                            <span class="pdp-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="3"/><path d="M4 9h16"/><path d="M9 4v16"/></svg></span>
                                            <span><strong>Facile d'entretien</strong><small>Résistant aux lavages fréquents</small></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="pdp-specs" class="tab-pane fade">
                            <div class="pdp-specs-card">
                                @if($features->isNotEmpty())
                                    <ul class="pdp-specs-list list-unstyled m-0">
                                        @foreach($features as $label => $value)
                                            <li><strong>{{ $label }}</strong><span>{{ $value }}</span></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="m-0">Aucune caractéristique renseignée pour ce produit.</p>
                                @endif
                            </div>
                        </div>
                        <div id="pdp-ship" class="tab-pane fade">
                            <div class="pdp-specs-card">
                                <ul class="pdp-specs-list list-unstyled m-0">
                                    <li><strong>Livraison</strong><span>Partout en Côte d'Ivoire, sous 24 à 72h</span></li>
                                    <li><strong>Montage</strong><span>Installation offerte sur les gros articles</span></li>
                                    <li><strong>Retour</strong><span>Produit défectueux échangé sous 7 jours</span></li>
                                    <li><strong>Contact</strong><span><a href="{{ route('pages.contact') }}">Notre service client</a></span></li>
                                </ul>
                            </div>
                        </div>
                        <div id="pdp-reviews" class="tab-pane fade">
                            <div class="pdp-specs-card">
                                <div class="pdp-rating mb-3">
                                    <span class="pdp-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg viewBox="0 0 24 24" fill="{{ $i <= round($rating) ? '#f5a623' : 'none' }}" stroke="{{ $i <= round($rating) ? '#f5a623' : '#d5dbe4' }}" stroke-width="1.6"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/></svg>
                                        @endfor
                                    </span>
                                    <span class="pdp-reviews">{{ $reviews }} avis clients</span>
                                </div>
                                <p class="m-0">Les avis détaillés seront bientôt disponibles. Vous avez acheté ce produit ? <a href="{{ route('pages.contact') }}">Partagez votre expérience</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- related -->
                @if($relatedProducts->isNotEmpty())
                    <div class="pdp-related">
                        <div class="pdp-related-head">
                            <h2 class="pdp-related-title"><span class="pdp-related-dash"></span>Complétez votre chambre</h2>
                            @if($primaryCategory)
                                <a class="pdp-related-more" href="{{ route('category.show', $primaryCategory->slug) }}">Voir plus
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                                </a>
                            @endif
                        </div>
                        <div class="row">
                            @foreach($relatedProducts as $related)
                                <div class="col-lg-3 col-md-6 col-6">
                                    <div class="pdp-rel-card">
                                        <a class="pdp-rel-img" href="{{ route('product.show', $related->slug) }}">
                                            <img loading="lazy" decoding="async" src="@image_url($related->image)" alt="{{ $related->name }}">
                                        </a>
                                        <h3 class="pdp-rel-name"><a href="{{ route('product.show', $related->slug) }}">{{ $related->name }}</a></h3>
                                        <div class="pdp-rel-bottom">
                                            <span class="mp-price">{{ number_format((float) $related->price, 0, ',', ' ') }} FCFA</span>
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $related->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="pdp-rel-cart" aria-label="Ajouter {{ $related->name }} au panier">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1.5"/><circle cx="19" cy="21" r="1.5"/><path d="M2.5 3h2l2.6 12.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L22 7H6"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>

    @push('meta')
    <script type="application/ld+json">
    {!! json_encode(array_filter([
        '@@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $product->name,
        'image' => collect($gallery)->map(fn($img) => image_url($img))->values()->all(),
        'description' => strip_tags($product->short_description ?: $product->description ?: ''),
        'sku' => $product->sku ?? $product->slug,
        'brand' => [
            '@type' => 'Brand',
            'name' => $product->brand ?? 'Mobilier Addict',
        ],
        'offers' => [
            '@type' => 'Offer',
            'url' => route('product.show', $product->slug),
            'priceCurrency' => 'XOF',
            'price' => number_format((float) $product->price, 0, '', ''),
            'priceValidUntil' => optional($product->updated_at ?? now())->addYear()->toDateString(),
            'availability' => $inStock ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
            'itemCondition' => 'https://schema.org/NewCondition',
            'shippingDetails' => [
                '@type' => 'OfferShippingDetails',
                'shippingRate' => [
                    '@type' => 'MonetaryAmount',
                    'value' => '0',
                    'currency' => 'XOF',
                ],
                'shippingDestination' => [
                    '@type' => 'DefinedRegion',
                    'addressCountry' => 'CI',
                    'addressLocality' => 'Abidjan',
                ],
            ],
            'hasMerchantReturnPolicy' => [
                '@type' => 'MerchantReturnPolicy',
                'returnPolicyCategory' => 'https://schema.org/MerchantReturnFiniteReturnWindow',
                'merchantReturnDays' => 7,
                'returnMethod' => 'https://schema.org/ReturnByMail',
                'returnFees' => 'https://schema.org/FreeReturn',
            ],
        ],
        'aggregateRating' => $reviews > 0 ? [
            '@type' => 'AggregateRating',
            'ratingValue' => $rating,
            'reviewCount' => $reviews,
        ] : null,
    ]), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @endpush

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var main = document.getElementById('pdpMainImg');
            var thumbs = Array.from(document.querySelectorAll('.pdp-thumb'));
            var idx = 0;
            function show(i) {
                idx = (i + thumbs.length) % thumbs.length;
                thumbs.forEach(function (t, j) { t.classList.toggle('is-active', j === idx); });
                if (main) main.src = thumbs[idx].dataset.img;
            }
            thumbs.forEach(function (t, i) { t.addEventListener('click', function () { show(i); }); });
            var prev = document.querySelector('.pdp-prev');
            var next = document.querySelector('.pdp-next');
            if (prev) prev.addEventListener('click', function () { show(idx - 1); });
            if (next) next.addEventListener('click', function () { show(idx + 1); });

            document.querySelectorAll('[data-qty-step]').forEach(function (b) {
                b.addEventListener('click', function () {
                    var input = b.closest('.mp-qty').querySelector('.mp-qty-input');
                    input.value = Math.min(10, Math.max(1, (parseInt(input.value, 10) || 1) + parseInt(b.dataset.qtyStep, 10)));
                });
            });

            var buyBtn = document.querySelector('.pdp-buy[data-redirect]');
            if (buyBtn) buyBtn.addEventListener('click', function () {
                buyBtn.form.querySelector('[name="redirect_to"]').value = buyBtn.dataset.redirect;
            });

            document.querySelectorAll('.pdp-pill input[data-price]').forEach(function (r) {
                r.addEventListener('change', function () {
                    var el = document.getElementById('pdpPrice');
                    if (el && r.dataset.price) {
                        el.textContent = new Intl.NumberFormat('fr-FR', { maximumFractionDigits: 0 }).format(r.dataset.price) + ' FCFA';
                    }
                });
            });
        });
    </script>
@endsection
