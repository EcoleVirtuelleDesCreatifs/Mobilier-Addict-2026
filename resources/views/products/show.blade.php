@extends('maquette.layout')

@section('title', \App\Support\ProductName::seoTitle($product))
@section('meta_description', Str::limit(strip_tags($product->short_description ?: $product->description ?: 'Achetez ' . $product->name . ' à Abidjan chez Mobilier Addict.'), 155))
@php
    // Canonical : les fiches déclinées par taille (90, 120, 140, 160, 180…)
    // pointent vers la première fiche du même modèle pour éviter le contenu dupliqué.
    $baseName = preg_replace('/\s*[-–—]\s*\d+\s*(cm)?\s*x\s*\d+\s*(cm)?\s*$/iu', '', (string) $product->name);
    $canonicalProduct = null;
    if ($baseName !== '' && $baseName !== $product->name) {
        $canonicalProduct = \App\Models\Product::where('is_active', 1)
            ->where('name', 'like', $baseName . '%')
            ->orderBy('id')
            ->first();
    }
    if (!$canonicalProduct) {
        $canonicalProduct = $product;
    }
@endphp
@section('canonical', route('product.show', $canonicalProduct->slug))
@if(request()->routeIs('demo.product'))
@section('robots', 'noindex, nofollow')
@endif

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
        $activeVariants = $product->variants->where('is_active', true);
        $defaultVariant = $product->preferredVariant();
        $displayPrice = (float) ($defaultVariant?->price ?? $product->price);
        $inStock = $product->isInStock($defaultVariant);
        $discount = ($product->old_price && $product->old_price > $displayPrice)
            ? round((($product->old_price - $displayPrice) / $product->old_price) * 100) : null;
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

        // Fil d'Ariane : Accueil > Rayon (menu) > N places > Produit
        $nameParts = \App\Support\ProductName::parse((string) $product->name);
        $productMenus = $product->relationLoaded('menus') ? $product->menus : collect();
        $crumbMenu = $productMenus->firstWhere('slug', 'matelas') ?: $productMenus->where('is_active', true)->first();
        $crumbs = [['label' => 'Accueil', 'url' => route('home')]];
        if ($crumbMenu) {
            $crumbs[] = ['label' => $crumbMenu->name, 'url' => route('menu.show', $crumbMenu->slug)];
            $places = \App\Support\ProductName::places($product);
            if ($places) {
                $width = $nameParts['dims'] ? strtok($nameParts['dims'], '×') : null;
                $crumbs[] = [
                    'label' => \App\Support\ProductName::placesLabel($places),
                    'url' => route('menu.show', array_filter(['slug' => $crumbMenu->slug, 'size' => in_array($width, ['90', '120', '140', '160', '180'], true) ? $width : null])),
                ];
            }
        } elseif ($primaryCategory) {
            $crumbs[] = ['label' => $primaryCategory->name, 'url' => route('category.show', $primaryCategory->slug)];
        }
        $crumbs[] = ['label' => $nameParts['base'] ?: $product->name, 'url' => null];
        $editorialImage = $gallery->get(1) ?? $gallery->first();
    @endphp

    <!-- breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <ul class="list-unstyled d-flex align-items-center m-0" aria-label="Fil d'Ariane">
                @foreach($crumbs as $crumb)
                    @unless($loop->first)
                    <li><svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"><g opacity="0.4"><path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000"/></g></svg></li>
                    @endunless
                    <li>@if($crumb['url'])<a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>@else<span aria-current="page">{{ $crumb['label'] }}</span>@endif</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="product-content">
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
                                @include('maquette.includes.favorite-button')
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
                            @if($reviews > 0 && false)
                                {{-- Étoiles masquées : aucun avis client lisible pour l'instant. --}}
                            @endif
                            <div class="pdp-price-row">
                                @if((float) $displayPrice > 0)
                                    <span class="pdp-price" id="pdpPrice">{{ number_format((float) $displayPrice, 0, ',', ' ') }} FCFA</span>
                                @else
                                    <span class="pdp-price" id="pdpPrice">Prix sur demande</span>
                                @endif
                                @if($product->old_price && $product->old_price > $displayPrice)
                                    <del class="pdp-price-old">{{ number_format((float) $product->old_price, 0, ',', ' ') }} FCFA</del>
                                @endif
                                @if((float) $displayPrice > 0)
                                    <span class="pdp-stock {{ $inStock ? 'is-in' : 'is-out' }}">{{ $inStock ? 'En stock' : 'Rupture' }}</span>
                                @else
                                    <span class="pdp-stock is-out">Sur commande</span>
                                @endif
                            </div>
                            @if($product->short_description)
                                <p class="pdp-desc">{{ Str::limit(strip_tags($product->short_description), 140) }}</p>
                            @endif

                            <form id="product-options" class="pdp-form" action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                @if($activeVariants->isNotEmpty())
                                    <div class="pdp-field">
                                        <span class="pdp-label">Taille</span>
                                        <div class="pdp-pills">
                                            @foreach($activeVariants as $variant)
                                                @php
                                                    $vLabel = collect([
                                                        $variant->dimensions,
                                                        $variant->places ? ((int) $variant->places) . ' places' : null,
                                                        $variant->thickness_cm ? $variant->thickness_cm.' cm' : null,
                                                        $variant->variant_type,
                                                    ])->filter()->join(' · ') ?: 'Option '.$loop->iteration;
                                                    $vPrice = (float) $variant->price;
                                                    $vAvailable = $product->isInStock($variant) && $vPrice > 0;
                                                @endphp
                                                <label class="pdp-pill">
                                                    <input type="radio" name="product_variant_id" value="{{ $variant->id }}" data-price="{{ $vPrice }}" data-available="{{ $vAvailable ? '1' : '0' }}" {{ $variant->id === $defaultVariant?->id ? 'checked' : '' }} {{ !$vAvailable ? 'disabled' : '' }}>
                                                    <span>{{ $vLabel }}{{ !$vAvailable ? ' — Indisponible' : '' }}</span>
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

                                <div class="pdp-purchase">
                                <div class="pdp-field">
                                    <span class="pdp-label">Quantité</span>
                                    <div class="mp-qty pdp-qty">
                                        <button type="button" class="mp-qty-btn" data-qty-step="-1" aria-label="Diminuer">−</button>
                                        <input class="mp-qty-input" type="text" name="quantity" value="1" inputmode="numeric" aria-label="Quantité">
                                        <button type="button" class="mp-qty-btn" data-qty-step="1" aria-label="Augmenter">+</button>
                                    </div>
                                </div>

                                    @if((float) $displayPrice > 0)
                                    <button type="submit" class="pdp-atc" {{ !$inStock ? 'disabled' : '' }}>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1.5"/><circle cx="19" cy="21" r="1.5"/><path d="M2.5 3h2l2.6 12.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L22 7H6"/></svg>
                                        Ajouter au panier
                                    </button>
                                    @endif
                                </div>
                                <div class="pdp-ctas">
                                    @php
                                        $waNumber = preg_replace('/\D+/', '', (string) config('services.whatsapp_number'));
                                        $waText = 'Bonjour Mobilier Addict, je suis intéressé(e) par « ' . $product->name . ' »' . ((float) $displayPrice > 0 ? ' (' . number_format((float) $displayPrice, 0, ',', ' ') . ' FCFA)' : '') . ' : ' . route('product.show', $product->slug);
                                    @endphp
                                    @if($waNumber)
                                        <a class="pdp-wa-link" href="https://wa.me/{{ $waNumber }}?text={{ rawurlencode($waText) }}" target="_blank" rel="noopener">
                                            <svg viewBox="0 0 32 32" fill="currentColor" stroke="none" width="18" height="18" aria-hidden="true"><path d="M16 .8C7.6.8.8 7.6.8 16c0 2.7.7 5.3 2 7.6L.8 31.2l7.8-2c2.2 1.2 4.7 1.9 7.4 1.9 8.4 0 15.2-6.8 15.2-15.2S24.4.8 16 .8zm0 27.7c-2.3 0-4.6-.6-6.5-1.8l-.5-.3-4.6 1.2 1.2-4.5-.3-.5C4 20.5 3.3 18.3 3.3 16 3.3 9 9 3.3 16 3.3S28.7 9 28.7 16 23 28.5 16 28.5zm7-9.5c-.4-.2-2.3-1.1-2.6-1.2-.3-.1-.6-.2-.8.2-.2.4-.9 1.2-1.1 1.4-.2.2-.4.3-.8.1-.4-.2-1.6-.6-3.1-1.9-1.1-1-1.9-2.3-2.1-2.6-.2-.4 0-.6.2-.8.2-.2.4-.4.6-.7.2-.2.3-.4.4-.7.1-.3.1-.5 0-.7-.1-.2-.8-2-1.1-2.8-.3-.7-.6-.6-.8-.6h-.7c-.2 0-.7.1-1 .5-.3.4-1.3 1.3-1.3 3.1s1.3 3.6 1.5 3.9c.2.3 2.6 4 6.3 5.6.9.4 1.6.6 2.1.8.9.3 1.7.2 2.3.1.7-.1 2.3-.9 2.6-1.8.3-.9.3-1.7.2-1.8-.1-.2-.4-.3-.8-.5z"/></svg>
                                            Commander sur WhatsApp
                                        </a>
                                    @endif
                                    @if($displayPrice > 0)
                                        <button type="submit" class="pdp-buy" name="redirect_to" value="shipping" {{ !$inStock ? 'disabled' : '' }}>Commander directement →</button>
                                    @endif
                                </div>
                                <style>
                                    .pdp-wa-link{display:inline-flex;align-items:center;gap:8px;color:#128c4a;font-weight:600;font-size:14px;text-decoration:none;margin-top:6px}
                                    .pdp-wa-link:hover{text-decoration:underline;color:#0d6e3a}
                                    .pdp-info-strip{margin-top:18px;padding:14px 16px;border:1px solid #e6eaf0;border-radius:12px;background:#f8fafc;font-size:13.5px;color:#4b5563;line-height:1.6}
                                    .pdp-info-strip strong{color:#0f2c59}
                                </style>
                                @if((float) $displayPrice > 0)
                                    <div class="pdp-info-strip">
                                        <strong>Livraison</strong> : Abidjan sous 48&nbsp;h (gratuite dès 50&nbsp;000&nbsp;F
                                        d'achat, sinon 2&nbsp;000–5&nbsp;000&nbsp;F selon la commune) ; intérieur du pays
                                        sur devis via transporteur partenaire.
                                    </div>
                                @endif
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
                    <div class="pdp-accordion">
                        <details id="pdp-desc" open><summary>Description</summary>
                            <div class="pdp-desc-text">{{ strip_tags($product->description ?: $product->short_description) ?: 'Contactez notre équipe pour les informations détaillées de ce modèle.' }}</div>
                        </details>
                        @if($features->isNotEmpty())
                            <details id="pdp-specs"><summary>Caractéristiques</summary>
                                <div class="pdp-specs-card">
                                    <ul class="pdp-specs-list list-unstyled m-0">
                                        @foreach($features as $label => $value)
                                            <li><strong>{{ $label }}</strong><span>{{ $value }}</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </details>
                        @endif
                        <details id="pdp-ship"><summary>Livraison &amp; paiement</summary>
                            <div class="pdp-specs-card">
                                <ul class="pdp-specs-list list-unstyled m-0">
                                    <li><strong>Livraison Abidjan</strong><span>Sous 48h — gratuite dès 50 000 F d'achat, sinon 2 000–5 000 F selon la commune</span></li>
                                    <li><strong>Livraison intérieur</strong><span>Partout en Côte d'Ivoire via transporteur partenaire, tarif sur devis</span></li>
                                    <li><strong>Montage</strong><span>Installation offerte sur les gros articles</span></li>
                                    <li><strong>Paiement</strong><span>Espèces ou Mobile Money à la livraison</span></li>
                                    <li><strong>Retour</strong><span>Produit défectueux : signalez-le sous 7 jours (photo + référence commande) par WhatsApp ou téléphone ; nous récupérons l'article et l'échangeons ou le remboursons, sans frais.</span></li>
                                    <li><strong>Contact</strong><span><a href="{{ route('pages.contact') }}">Notre service client</a></span></li>
                                </ul>
                            </div>
                        </details>
                        <details id="pdp-reviews"><summary>Avis clients</summary>
                            <div class="pdp-specs-card">
                                <p class="m-0">Aucun avis pour le moment. Vous avez acheté ce produit ?
                                    <a href="{{ route('pages.contact') }}">Partagez votre expérience</a> — votre retour aide les autres clients.</p>
                            </div>
                        </details>
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
    </div>

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
            'price' => number_format((float) $displayPrice, 0, '', ''),
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
        // Étoiles Google : uniquement avec de vrais avis clients (note et nombre d'avis renseignés).
        'aggregateRating' => ($rating > 0 && $reviews > 0) ? [
            '@type' => 'AggregateRating',
            'ratingValue' => number_format($rating, 1, '.', ''),
            'reviewCount' => $reviews,
            'bestRating' => '5',
            'worstRating' => '1',
        ] : null,
    ]), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    <script type="application/ld+json">
    {!! json_encode([
        '@@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => collect($crumbs)->values()->map(fn ($c, $i) => array_filter([
            '@type' => 'ListItem',
            'position' => $i + 1,
            'name' => $c['label'],
            'item' => $c['url'] ?? route('product.show', $product->slug),
        ]))->all(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
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

            document.querySelectorAll('.pdp-pill input[data-price]').forEach(function (r) {
                r.addEventListener('change', function () {
                    var el = document.getElementById('pdpPrice');
                    var available = r.dataset.available === '1' && Number(r.dataset.price) > 0;
                    if (el) {
                        el.textContent = Number(r.dataset.price) > 0
                            ? new Intl.NumberFormat('fr-FR', { maximumFractionDigits: 0 }).format(r.dataset.price) + ' FCFA'
                            : 'Prix sur demande';
                    }
                    document.querySelectorAll('#product-options .pdp-atc, #product-options .pdp-buy').forEach(function (button) {
                        button.disabled = !available;
                    });
                    var stock = document.querySelector('.pdp-stock');
                    if (stock) {
                        stock.textContent = available ? 'En stock' : 'Indisponible';
                        stock.classList.toggle('is-in', available);
                        stock.classList.toggle('is-out', !available);
                    }
                });
            });
        });
    </script>
@endsection
