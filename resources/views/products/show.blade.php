@extends('layouts.front')

@section('title', $product->name)
@section('meta_description', $product->short_description ?: $product->name)
@section('canonical', route('product.show', $product->slug))

@section('content')
<div class="product-page">
    <!-- Breadcrumb -->
    <nav class="product-breadcrumb">
        <div class="container">
            <ol class="product-breadcrumb__list">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                @if($product->category)
                    <li><a href="{{ route('univers.show', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                @endif
                <li>{{ $product->name }}</li>
            </ol>
        </div>
    </nav>

    <!-- Main Product Section -->
    <section class="product-main">
        <div class="container">
            <div class="product-main__grid">
                <!-- Gallery -->
                <div class="product-gallery">
                    <div class="product-gallery__main">
                        @if($product->discount_percent)
                            <span class="product-gallery__badge">-{{ (int) $product->discount_percent }}%</span>
                        @elseif($product->badge)
                            <span class="product-gallery__badge product-gallery__badge--alt">{{ $product->badge }}</span>
                        @endif
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" id="mainImage" />
                    </div>
                    @if($product->gallery && count($product->gallery) > 0)
                        <div class="product-gallery__thumbs">
                            <button class="product-gallery__thumb product-gallery__thumb--active" data-img="{{ asset($product->image) }}">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" />
                            </button>
                            @foreach($product->gallery as $img)
                                <button class="product-gallery__thumb" data-img="{{ asset($img) }}">
                                    <img src="{{ asset($img) }}" alt="{{ $product->name }}" />
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="product-info">
                    <div class="product-info__header">
                        @if($product->category)
                            <span class="product-info__category">{{ $product->category->name }}</span>
                        @endif
                        <h1 class="product-info__title">{{ $product->name }}</h1>
                        @if($product->short_description)
                            <p class="product-info__subtitle">{{ $product->short_description }}</p>
                        @endif
                    </div>

                    <!-- Trust Badges -->
                    <div class="product-trust">
                        <div class="product-trust__item">
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="currentColor"/></svg>
                            <span>En stock</span>
                        </div>
                        <div class="product-trust__item">
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M18 18.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM19.5 9.5l1.9 2.5H19v-2.5h.5m-2.5-2V15h-3c0 1.1-.9 2-2 2s-2-.9-2-2H5c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2h12v5h3l3 4v5h-2c0 1.1-.9 2-2 2s-2-.9-2-2h-1" fill="currentColor"/></svg>
                            <span>Livraison rapide</span>
                        </div>
                        <div class="product-trust__item">
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z" fill="currentColor"/></svg>
                            <span>Garantie 2 ans</span>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="product-price">
                        <div class="product-price__current" id="productPriceCurrent">{{ $product->formatted_price }}</div>
                        @if($product->formatted_old_price)
                            <div class="product-price__old" id="productPriceOld">{{ $product->formatted_old_price }}</div>
                            @if($product->discount_percent)
                                <div class="product-price__save" id="productPriceSave">Économisez {{ (int) $product->discount_percent }}%</div>
                            @endif
                        @else
                            <div class="product-price__old" id="productPriceOld" style="display:none"></div>
                            <div class="product-price__save" id="productPriceSave" style="display:none"></div>
                        @endif
                    </div>

                    @if(($product->variants ?? collect())->isNotEmpty())
                        @php
                            $variants = $product->variants->values();
                            $categorySlug = (string) ($product->category?->slug ?? '');
                            $categoryName = (string) ($product->category?->name ?? '');
                            $categoryHaystack = mb_strtolower(trim($categorySlug . ' ' . $categoryName));
                            $isMattressCategory = str_contains($categoryHaystack, 'matelas');

                            $usesVariantType = !$isMattressCategory
                                && $variants->pluck('variant_type')->filter(fn ($v) => (string) $v !== '')->isNotEmpty();
                            $variantTypes = $variants->pluck('variant_type')->filter(fn ($v) => (string) $v !== '')->unique()->sort()->values();
                            $thicknesses = $variants->pluck('thickness_cm')->unique()->sort()->values();
                            $places = $variants->pluck('places')->unique()->sort()->values();
                            $defaultVariant = $variants->first();
                            $variantTypeLabel = 'Type';
                            if (str_contains($categoryHaystack, 'drap')) {
                                $variantTypeLabel = 'Type de drap';
                            } elseif (str_contains($categoryHaystack, 'oreiller')) {
                                $variantTypeLabel = "Type d’oreiller";
                            } elseif (str_contains($categoryHaystack, 'couette')) {
                                $variantTypeLabel = 'Type de couette';
                            }
                        @endphp
                        <div class="variant-picker" style="margin-top: 14px;">
                            <div class="variant-picker__grid">
                                <div class="variant-picker__group">
                                    <div class="variant-picker__label">{{ $usesVariantType ? $variantTypeLabel : 'Épaisseur' }}</div>
                                    <div class="variant-picker__chips" role="group" aria-label="Choisir une option">
                                        @if($usesVariantType)
                                            @foreach($variantTypes as $t)
                                                <button
                                                    type="button"
                                                    class="variant-chip"
                                                    data-variant-type="{{ (string) $t }}"
                                                    aria-pressed="{{ (string) $t === (string) $defaultVariant?->variant_type ? 'true' : 'false' }}"
                                                >
                                                    <span class="variant-chip__value">{{ (string) $t }}</span>
                                                </button>
                                            @endforeach
                                        @else
                                            @foreach($thicknesses as $t)
                                                <button
                                                    type="button"
                                                    class="variant-chip"
                                                    data-variant-thickness="{{ (int) $t }}"
                                                    aria-pressed="{{ $t === $defaultVariant?->thickness_cm ? 'true' : 'false' }}"
                                                >
                                                    <span class="variant-chip__value">{{ (int) $t }}</span>
                                                    <span class="variant-chip__unit">cm</span>
                                                </button>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class="variant-picker__group">
                                    <div class="variant-picker__label">Places</div>
                                    <div class="variant-picker__chips" role="group" aria-label="Choisir un nombre de places">
                                        @foreach($places as $p)
                                            <button
                                                type="button"
                                                class="variant-chip"
                                                data-variant-places="{{ (int) $p }}"
                                                aria-pressed="{{ $p === $defaultVariant?->places ? 'true' : 'false' }}"
                                            >
                                                <span class="variant-chip__value">{{ (int) $p }}</span>
                                                <span class="variant-chip__unit">place(s)</span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="variant-picker__hint" id="variantHint"></div>
                            <input type="hidden" id="selectedVariantId" value="{{ $defaultVariant?->id }}">
                            <script type="application/json" id="variantsData">{!! $variants->map(fn($v) => [
                                'id' => (int) $v->id,
                                'variant_type' => $v->variant_type ? (string) $v->variant_type : null,
                                'thickness_cm' => (int) $v->thickness_cm,
                                'places' => (int) $v->places,
                                'price' => (float) $v->price,
                                'formatted_price' => $v->formatted_price,
                                'formatted_old_price' => $v->formatted_old_price,
                                'discount_percent' => $v->discount_percent ? (int) $v->discount_percent : null,
                                'in_stock' => ((int) ($v->stock ?? 0)) > 0,
                            ])->values()->toJson(JSON_UNESCAPED_UNICODE) !!}</script>
                        </div>
                    @endif

                    <!-- CTA Section Redesigned -->
                    <div class="product-cta-section">
                        <!-- Quantity + Add to Cart Row -->
                        <div class="product-cart-row">
                            <div class="product-qty">
                                <button class="product-qty__btn" id="qtyMinus" type="button">−</button>
                                <input type="number" class="product-qty__input" id="qtyInput" value="1" min="1" max="10" data-price="{{ $product->price }}" />
                                <button class="product-qty__btn" id="qtyPlus" type="button">+</button>
                            </div>
                            @if(isset($product->id))
                            <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm" style="flex:1">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="product_variant_id" id="addToCartVariantId" value="">
                                <input type="hidden" name="quantity" id="addToCartQty" value="1">
                                <button class="product-cta-main product-cta-main--dark" type="submit" style="width:100%">
                                    <svg viewBox="0 0 24 24" width="22" height="22"><path d="M17 18c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm0-3l1.1-2h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1v2h2l3.6 7.59L3.62 17H19v-2H7z" fill="currentColor"/></svg>
                                    <span>Ajouter au panier</span>
                                </button>
                            </form>
                            @else
                            <button class="product-cta-main product-cta-main--dark" type="button" disabled style="opacity:.6;cursor:not-allowed;">
                                <svg viewBox="0 0 24 24" width="22" height="22"><path d="M17 18c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm0-3l1.1-2h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1v2h2l3.6 7.59L3.62 17H19v-2H7z" fill="currentColor"/></svg>
                                <span>Ajouter au panier</span>
                            </button>
                            @endif
                        </div>

                        <!-- Total Price Display -->
                        <div class="product-total">
                            <span class="product-total__label">Total à payer :</span>
                            <span class="product-total__price" id="totalPrice">{{ $product->formatted_price }}</span>
                        </div>

                        <!-- Primary Actions -->
                        <div class="product-cta-primary">
                            <a href="https://wa.me/2250700000000?text=Bonjour, je veux commander : {{ urlencode($product->name) }} à {{ $product->formatted_price }}" class="product-cta-main product-cta-main--whatsapp" target="_blank" rel="noopener">
                                <svg viewBox="0 0 24 24" width="22" height="22"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" fill="currentColor"/></svg>
                                <span>Commander via WhatsApp</span>
                            </a>
                        </div>

                        <!-- Direct Order Button -->
                        @if(isset($product->id))
                        <form action="{{ route('cart.add') }}" method="POST" style="width:100%">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_variant_id" id="directOrderVariantId" value="">
                            <input type="hidden" name="quantity" id="directOrderQty" value="1">
                            <input type="hidden" name="redirect_to" value="shipping">
                            <button class="product-cta-direct" type="submit" data-role="checkout">
                                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" fill="currentColor"/></svg>
                                Commandez directement
                            </button>
                        </form>
                        @else
                        <button class="product-cta-direct" type="button" data-role="modal">
                            <svg viewBox="0 0 24 24" width="20" height="20"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" fill="currentColor"/></svg>
                            Commandez directement
                        </button>
                        @endif

                        <!-- Secondary Actions -->
                        <div class="product-cta-secondary">
                            <a href="https://wa.me/2250700000000?text=Bonjour, j'ai une question sur : {{ urlencode($product->name) }}" class="product-cta-link" target="_blank" rel="noopener">
                                <svg viewBox="0 0 24 24" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" fill="currentColor"/></svg>
                                Poser une question
                            </a>
                        </div>
                    </div>

                    <!-- Reassurance -->
                    <div class="product-reassurance">
                        <div class="product-reassurance__item">
                            <svg viewBox="0 0 24 24" width="20" height="20"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z" fill="currentColor"/></svg>
                            <div>
                                <strong>Livraison Partout en Côte d'Ivoire</strong>
                                <span>24-72h</span>
                            </div>
                        </div>
                        <div class="product-reassurance__item">
                            <svg viewBox="0 0 24 24" width="20" height="20"><path d="M12.5 6.9c1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-2.06.45-3.72 1.8-3.72 3.88 0 2.47 2.01 3.7 4.93 4.42 2.62.64 3.15 1.58 3.15 2.58 0 .73-.52 1.9-2.86 1.9-2.19 0-3.05-.98-3.17-2.19H7.12c.13 2.29 1.84 3.57 3.88 4.01V22h3v-2.15c2.08-.41 3.72-1.64 3.72-3.89 0-3.04-2.6-4.08-4.93-4.72-2.33-.64-2.93-1.34-2.93-2.4 0-1.21 1.13-2.04 2.64-2.04z" fill="currentColor"/></svg>
                            <div>
                                <strong>Paiement flexible</strong>
                                <span>Cash, Wave, OM</span>
                            </div>
                        </div>
                        <div class="product-reassurance__item">
                            <svg viewBox="0 0 24 24" width="20" height="20"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z" fill="currentColor"/></svg>
                            <div>
                                <strong>Service client</strong>
                                <span>7j/7 disponible</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Description Section - Redesigned -->
    @if($product->description)
    <section class="product-desc-section">
        <div class="product-desc-section__bg"></div>
        <div class="container">
            <div class="product-desc__header">
                <span class="product-desc__kicker">À propos</span>
                <h2 class="product-desc__title">Description du produit</h2>
            </div>
            <div class="product-desc__grid">
                <div class="product-desc__content">
                    <div class="product-desc__text">
                        {!! $product->description !!}
                    </div>
                </div>
                <div class="product-desc__features">
                    <div class="product-desc__feature">
                        <div class="product-desc__feature-icon">
                            <svg viewBox="0 0 24 24" width="28" height="28"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="currentColor"/></svg>
                        </div>
                        <div>
                            <strong>Qualité Premium</strong>
                            <span>Matériaux haut de gamme</span>
                        </div>
                    </div>
                    <div class="product-desc__feature">
                        <div class="product-desc__feature-icon">
                            <svg viewBox="0 0 24 24" width="28" height="28"><path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z" fill="currentColor"/></svg>
                        </div>
                        <div>
                            <strong>Garantie 2 ans</strong>
                            <span>Service après-vente inclus</span>
                        </div>
                    </div>
                    <div class="product-desc__feature">
                        <div class="product-desc__feature-icon">
                            <svg viewBox="0 0 24 24" width="28" height="28"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z" fill="currentColor"/></svg>
                        </div>
                        <div>
                            <strong>Livraison rapide</strong>
                            <span>Partout en Côte d'Ivoire</span>
                        </div>
                    </div>
                    <div class="product-desc__feature">
                        <div class="product-desc__feature-icon">
                            <svg viewBox="0 0 24 24" width="28" height="28"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z" fill="currentColor"/></svg>
                        </div>
                        <div>
                            <strong>Paiement sécurisé</strong>
                            <span>Cash, Wave, Orange Money</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Related Products -->
    @if($relatedProducts->count())
    <section class="product-related">
        <div class="container">
            <div class="product-related__header">
                <span class="product-related__kicker">Recommandations</span>
                <h2 class="product-related__title">Vous aimerez aussi</h2>
                <p class="product-related__subtitle">Des produits sélectionnés pour compléter votre achat</p>
            </div>
            <div class="product-related__grid">
                @foreach($relatedProducts as $index => $related)
                    <a href="{{ route('product.show', $related->slug) }}" class="evc-carousel-card">
                        <div class="evc-carousel-card__rank">#{{ $index + 1 }}</div>
                        @if($related->discount_percent)
                            <div class="evc-carousel-card__badge">-{{ (int) $related->discount_percent }}%</div>
                        @elseif($index === 0)
                            <div class="evc-carousel-card__badge evc-carousel-card__badge--alt">Top</div>
                        @endif
                        <div class="evc-carousel-card__media">
                            <img src="{{ asset($related->image) }}" alt="{{ $related->name }}" loading="lazy" />
                        </div>
                        <div class="evc-carousel-card__body">
                            <h3 class="evc-carousel-card__name">{{ $related->name }}</h3>
                            <p class="evc-carousel-card__desc">Qualité premium • Livraison rapide</p>
                            <div class="evc-carousel-card__footer">
                                <div class="evc-carousel-card__prices">
                                    <span class="evc-carousel-card__price">{{ $related->formatted_price }}</span>
                                    @if($related->formatted_old_price)
                                        <span class="evc-carousel-card__old">{{ $related->formatted_old_price }}</span>
                                    @endif
                                </div>
                                <span class="evc-carousel-card__btn" aria-label="Voir le produit">
                                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" fill="currentColor"/></svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>

<!-- Order Modal -->
<div class="order-modal" id="orderModal">
    <div class="order-modal__overlay" id="orderModalClose"></div>
    <div class="order-modal__container">
        <div class="order-modal__header">
            <h2 class="order-modal__title">Finaliser votre commande</h2>
            <button class="order-modal__close" id="orderModalCloseBtn" type="button">&times;</button>
        </div>
        <div class="order-modal__product">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" />
            <div>
                <strong>{{ $product->name }}</strong>
                <span class="order-modal__calc" id="orderCalc">{{ $product->formatted_price }} x 1 = <b>{{ $product->formatted_price }}</b></span>
            </div>
        </div>
        <form class="order-modal__form" id="orderForm">
            <div class="order-form__row">
                <div class="order-form__group">
                    <label for="order_nom">Nom <span>*</span></label>
                    <input type="text" id="order_nom" name="nom" placeholder="Votre nom" required />
                </div>
                <div class="order-form__group">
                    <label for="order_prenoms">Prénoms <span>*</span></label>
                    <input type="text" id="order_prenoms" name="prenoms" placeholder="Vos prénoms" required />
                </div>
            </div>
            <div class="order-form__row">
                <div class="order-form__group">
                    <label for="order_whatsapp">Numéro WhatsApp <span>*</span></label>
                    <input type="tel" id="order_whatsapp" name="whatsapp" placeholder="+225 07 00 00 00 00" required />
                </div>
                <div class="order-form__group">
                    <label for="order_telephone">Numéro Téléphone</label>
                    <input type="tel" id="order_telephone" name="telephone" placeholder="+225 07 00 00 00 00" />
                </div>
            </div>
            <div class="order-form__group">
                <label for="order_lieu">Lieu de livraison <span>*</span></label>
                <input type="text" id="order_lieu" name="lieu" placeholder="Ex: Cocody Angré, Abidjan" required />
            </div>
            <div class="order-form__group">
                <label for="order_jour">Jour de livraison souhaité</label>
                <input type="date" id="order_jour" name="jour" />
            </div>
            <div class="order-form__group">
                <label for="order_detail">Détails supplémentaires</label>
                <textarea id="order_detail" name="detail" rows="3" placeholder="Précisions sur la commande, couleur, taille, etc."></textarea>
            </div>
            <input type="hidden" name="produit" value="{{ $product->name }}" />
            <input type="hidden" name="prix" value="{{ $product->formatted_price }}" />
            <button type="submit" class="order-form__submit order-form__submit--primary">
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" fill="currentColor"/></svg>
                Valider la commande
            </button>
        </form>
    </div>
</div>

<style>
/* Product Page Styles */
.product-page { background: #fafbfc; padding-bottom: 4rem; }

/* Breadcrumb */
.product-breadcrumb { background: linear-gradient(135deg, #1a1a2e, #16213e); border-bottom: none; min-height: 77px; display: flex; align-items: center; }
.product-breadcrumb__list { display: flex; flex-wrap: wrap; gap: .5rem; list-style: none; padding: 0; margin: 0; font-size: .9rem; }
.product-breadcrumb__list li { display: flex; align-items: center; gap: .5rem; color: rgba(255,255,255,.7); }
.product-breadcrumb__list li:not(:last-child)::after { content: '/'; color: rgba(255,255,255,.4); }
.product-breadcrumb__list a { color: rgba(255,255,255,.7); text-decoration: none; transition: color .2s; }
.product-breadcrumb__list a:hover { color: #ec4899; }
.product-breadcrumb__list li:last-child { color: #fff; font-weight: 600; }

/* Main Section */
.product-main { background: #fff; padding: 2.5rem 0; }
.product-main__grid { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: start; }

/* Gallery */
.product-gallery { position: sticky; top: 2rem; }
.product-gallery__main { position: relative; background: #f8f9fa; border-radius: 16px; overflow: hidden; aspect-ratio: 1; display: flex; align-items: center; justify-content: center; }
.product-gallery__main img { max-width: 100%; max-height: 100%; object-fit: contain; }
.product-gallery__badge { position: absolute; top: 1rem; left: 1rem; background: linear-gradient(135deg, #c2185b, #e91e63); color: #fff; padding: .4rem .8rem; border-radius: 6px; font-size: .8rem; font-weight: 600; z-index: 2; }
.product-gallery__badge--alt { background: linear-gradient(135deg, #7b1fa2, #9c27b0); }
.product-gallery__thumbs { display: flex; gap: .75rem; margin-top: 1rem; }
.product-gallery__thumb { width: 70px; height: 70px; border: 2px solid #eee; border-radius: 10px; overflow: hidden; cursor: pointer; padding: 0; background: #fff; transition: border-color .2s; }
.product-gallery__thumb:hover, .product-gallery__thumb--active { border-color: #c2185b; }
.product-gallery__thumb img { width: 100%; height: 100%; object-fit: cover; }

/* Product Info */
.product-info { display: flex; flex-direction: column; gap: 1.5rem; }
.product-info__category { display: inline-block; background: linear-gradient(135deg, #f3e5f5, #fce4ec); color: #7b1fa2; padding: .35rem .75rem; border-radius: 20px; font-size: .75rem; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; }
.product-info__title { font-size: 2rem; font-weight: 700; color: #1a1a2e; margin: .5rem 0 0; line-height: 1.2; }
.product-info__subtitle { color: #666; font-size: 1rem; line-height: 1.6; margin: 0; }

/* Trust Badges */
.product-trust { display: flex; flex-wrap: wrap; gap: 1rem; }
.product-trust__item { display: flex; align-items: center; gap: .4rem; font-size: .85rem; color: #2e7d32; font-weight: 500; }
.product-trust__item svg { color: #2e7d32; }

/* Price */
.product-price { display: flex; align-items: baseline; gap: 1rem; flex-wrap: wrap; }
.product-price__current { font-size: 2.25rem; font-weight: 800; color: #c2185b; }
.product-price__old { font-size: 1.25rem; color: #999; text-decoration: line-through; }
.product-price__save { background: #e8f5e9; color: #2e7d32; padding: .3rem .6rem; border-radius: 4px; font-size: .8rem; font-weight: 600; }

/* Quantity Selector */
.product-qty { display: inline-flex; align-items: center; border: 2px solid #eee; border-radius: 10px; overflow: hidden; align-self: flex-start; }
.product-qty__btn { width: 44px; height: 44px; border: none; background: #f8f9fa; font-size: 1.25rem; cursor: pointer; transition: background .2s; color: #333; }
.product-qty__btn:hover { background: #eee; }
.product-qty__input { width: 50px; height: 44px; border: none; text-align: center; font-size: 1rem; font-weight: 600; }
.product-qty__input::-webkit-inner-spin-button { -webkit-appearance: none; }

/* CTA Section - Redesigned */
.product-cta-section { display: flex; flex-direction: column; gap: 1rem; }
.product-cart-row { display: flex; gap: .75rem; align-items: stretch; }
.product-cart-row .product-qty { flex-shrink: 0; }
.product-cart-row .product-cta-main { flex: 1; }
.product-total { display: flex; align-items: center; justify-content: space-between; background: linear-gradient(135deg, #fdf2f8, #fce7f3); padding: 1rem 1.25rem; border-radius: 12px; border: 2px solid #fbcfe8; }
.product-total__label { font-size: 1rem; font-weight: 600; color: #9d174d; }
.product-total__price { font-size: 1.5rem; font-weight: 800; color: #be185d; }
.product-cta-main--dark { background: linear-gradient(135deg, #1a1a2e, #16213e); color: #fff; box-shadow: 0 4px 15px rgba(26,26,46,.2); }
.product-cta-main--dark:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(26,26,46,.35); }
.product-cta-primary { display: flex; flex-direction: column; gap: .75rem; }
.product-cta-main { display: flex; align-items: center; justify-content: center; gap: .6rem; padding: 1rem 1.25rem; border-radius: 12px; font-size: 1rem; font-weight: 700; text-decoration: none; border: none; cursor: pointer; transition: all .25s ease; }
.product-cta-main span { white-space: nowrap; }
.product-cta-main--pink { background: linear-gradient(135deg, #1a1a2e, #16213e); color: #fff; box-shadow: 0 4px 15px rgba(26,26,46,.2); }
.product-cta-main--pink:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(26,26,46,.35); }
.product-cta-main--whatsapp { background: linear-gradient(135deg, #25d366, #128c7e); color: #fff; box-shadow: 0 4px 15px rgba(37,211,102,.25); }
.product-cta-main--whatsapp:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(37,211,102,.4); }
.product-cta-direct { width: 100%; display: flex; align-items: center; justify-content: center; gap: .6rem; padding: 1rem; border-radius: 12px; font-size: 1rem; font-weight: 700; background: linear-gradient(135deg, #ec4899, #be185d); color: #fff; border: none; cursor: pointer; transition: all .25s ease; box-shadow: 0 4px 15px rgba(236,72,153,.25); animation: pulse-aggressive 1s ease-in-out infinite; }
.product-cta-direct:hover { transform: translateY(-3px) scale(1.03); box-shadow: 0 12px 40px rgba(236,72,153,.6); animation: none; }
@keyframes pulse-aggressive { 0%, 100% { box-shadow: 0 4px 20px rgba(236,72,153,.3); transform: scale(1); } 50% { box-shadow: 0 8px 40px rgba(236,72,153,.7), 0 0 60px rgba(236,72,153,.4); transform: scale(1.03); } }
.product-cta-secondary { display: flex; justify-content: center; gap: 2rem; padding-top: .5rem; }
.product-cta-link { display: flex; align-items: center; gap: .4rem; color: #25d366; font-size: .9rem; font-weight: 600; text-decoration: none; transition: color .2s; }
.product-cta-link:hover { color: #128c7e; }
.product-cta-link svg { color: #25d366; transition: color .2s; }
.product-cta-link:hover svg { color: #128c7e; }

/* Reassurance */
.product-reassurance { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; padding-top: 1.5rem; border-top: 1px solid #eee; }
.product-reassurance__item { display: flex; align-items: flex-start; gap: .6rem; }
.product-reassurance__item svg { color: #c2185b; flex-shrink: 0; margin-top: 2px; }
.product-reassurance__item div { display: flex; flex-direction: column; }
.product-reassurance__item strong { font-size: .85rem; color: #333; }
.product-reassurance__item span { font-size: .75rem; color: #888; }

/* Description Section - Redesigned */
.product-desc-section { position: relative; padding: 4rem 0; overflow: hidden; }
.product-desc-section__bg { position: absolute; inset: 0; background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 50%, #fbcfe8 100%); z-index: -1; }
.product-desc__header { text-align: center; margin-bottom: 3rem; }
.product-desc__kicker { display: inline-block; background: linear-gradient(135deg, #ec4899, #be185d); color: #fff; padding: .5rem 1.5rem; border-radius: 999px; font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem; }
.product-desc__title { font-size: 2.25rem; font-weight: 800; color: #1a1a2e; margin: 0; }
.product-desc__grid { display: grid; grid-template-columns: 1.2fr 1fr; gap: 3rem; align-items: start; }
.product-desc__content { background: #fff; border-radius: 20px; padding: 2.5rem; box-shadow: 0 10px 40px rgba(190,24,93,.1); }
.product-desc__text { color: #4b5563; line-height: 1.9; font-size: 1.05rem; }
.product-desc__features { display: flex; flex-direction: column; gap: 1.25rem; }
.product-desc__feature { display: flex; align-items: center; gap: 1rem; background: #fff; padding: 1.25rem 1.5rem; border-radius: 16px; box-shadow: 0 4px 20px rgba(190,24,93,.08); transition: transform .3s, box-shadow .3s; }
.product-desc__feature:hover { transform: translateY(-4px); box-shadow: 0 8px 30px rgba(190,24,93,.15); }
.product-desc__feature-icon { width: 56px; height: 56px; background: linear-gradient(135deg, #fce7f3, #fbcfe8); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: #be185d; flex-shrink: 0; }
.product-desc__feature div { display: flex; flex-direction: column; gap: 2px; }
.product-desc__feature strong { font-size: 1rem; font-weight: 700; color: #1a1a2e; }
.product-desc__feature span { font-size: .85rem; color: #6b7280; }

/* Related Products */
.product-related { padding: 3rem 0 4rem; background: linear-gradient(180deg, #fafbfc 0%, #fff 100%); }
.product-related__header { text-align: center; margin-bottom: 2.5rem; }
.product-related__kicker { display: inline-block; background: linear-gradient(135deg, #ec4899, #be185d); color: #fff; padding: .5rem 1.25rem; border-radius: 999px; font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem; }
.product-related__title { font-size: 2rem; font-weight: 800; color: #1a1a2e; margin: 0 0 .75rem; }
.product-related__subtitle { color: #64748b; font-size: 1rem; margin: 0; }
.product-related__grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
.product-related__grid .evc-carousel-card { transition: transform .3s, box-shadow .3s; }
.product-related__grid .evc-carousel-card:hover { transform: translateY(-8px); }

/* Order Modal */
.order-modal { display: none; position: fixed; inset: 0; z-index: 9999; align-items: center; justify-content: center; padding: 1rem; }
.order-modal.active { display: flex; }
.order-modal__overlay { position: absolute; inset: 0; background: rgba(0,0,0,.6); backdrop-filter: blur(4px); }
.order-modal__container { position: relative; background: #fff; border-radius: 20px; max-width: 550px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 60px rgba(0,0,0,.3); animation: modalSlide .3s ease; }
@keyframes modalSlide { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
.order-modal__header { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem; border-bottom: 1px solid #eee; }
.order-modal__title { font-size: 1.25rem; font-weight: 700; color: #1a1a2e; margin: 0; }
.order-modal__close { width: 36px; height: 36px; border: none; background: #f1f5f9; border-radius: 50%; font-size: 1.5rem; cursor: pointer; color: #64748b; transition: all .2s; display: flex; align-items: center; justify-content: center; line-height: 1; }
.order-modal__close:hover { background: #fee2e2; color: #dc2626; }
.order-modal__product { display: flex; align-items: center; gap: 1rem; padding: 1rem 1.5rem; background: #f8fafc; border-bottom: 1px solid #eee; }
.order-modal__product img { width: 60px; height: 60px; object-fit: cover; border-radius: 10px; }
.order-modal__product div { display: flex; flex-direction: column; }
.order-modal__product strong { font-size: .95rem; color: #1a1a2e; }
.order-modal__product span { font-size: 1rem; font-weight: 700; color: #ec4899; }
.order-modal__form { padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem; }
.order-form__row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.order-form__group { display: flex; flex-direction: column; gap: .35rem; }
.order-form__group label { font-size: .85rem; font-weight: 600; color: #374151; }
.order-form__group label span { color: #ec4899; }
.order-form__group input, .order-form__group textarea { padding: .75rem 1rem; border: 2px solid #e5e7eb; border-radius: 10px; font-size: .95rem; transition: border-color .2s, box-shadow .2s; }
.order-form__group input:focus, .order-form__group textarea:focus { outline: none; border-color: #ec4899; box-shadow: 0 0 0 3px rgba(236,72,153,.1); }
.order-form__group textarea { resize: vertical; min-height: 80px; }
.order-form__submit { display: flex; align-items: center; justify-content: center; gap: .6rem; padding: 1rem; border: none; border-radius: 12px; font-size: 1rem; font-weight: 700; cursor: pointer; transition: all .25s; margin-top: .5rem; }
.order-form__submit--primary { background: linear-gradient(135deg, #ec4899, #be185d); color: #fff; }
.order-form__submit--primary:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(236,72,153,.4); }

/* Responsive */
@media (max-width: 992px) {
    .product-main__grid { grid-template-columns: 1fr; gap: 2rem; }
    .product-gallery { position: static; }
    .product-related__grid { grid-template-columns: repeat(2, 1fr); }
    .product-desc__grid { grid-template-columns: 1fr; gap: 2rem; }
}
@media (max-width: 576px) {
    .product-info__title { font-size: 1.5rem; }
    .product-price__current { font-size: 1.75rem; }
    .product-actions { flex-direction: column; }
    .product-reassurance { grid-template-columns: 1fr; }
    .product-related__grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
    .order-form__row { grid-template-columns: 1fr; }
    .product-desc__title { font-size: 1.75rem; }
    .product-desc__content { padding: 1.5rem; }
}

.variant-picker { padding: 14px; border: 1px solid rgba(15, 23, 42, .08); border-radius: 16px; background: linear-gradient(180deg, rgba(255,255,255,.9), rgba(248,250,252,.9)); box-shadow: 0 20px 45px rgba(2, 6, 23, .06); }
.variant-picker__grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.variant-picker__group { display: flex; flex-direction: column; gap: 10px; }
.variant-picker__label { font-weight: 900; letter-spacing: -.01em; color: #0f172a; }
.variant-picker__chips { display: flex; flex-wrap: wrap; gap: 10px; }
.variant-chip { appearance: none; border: 1.5px solid rgba(15, 23, 42, .18); background: #fff; border-radius: 14px; padding: 10px 12px; min-width: 78px; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; gap: 2px; cursor: pointer; transition: transform .15s ease, box-shadow .2s ease, border-color .2s ease, background .2s ease; }
.variant-chip__value { font-weight: 950; color: #0f172a; font-size: 16px; line-height: 1; }
.variant-chip__unit { font-size: 11px; font-weight: 700; color: #64748b; line-height: 1; }
.variant-chip:hover { transform: translateY(-1px); box-shadow: 0 12px 22px rgba(2, 6, 23, .10); border-color: rgba(236, 72, 153, .55); }
.variant-chip[aria-pressed="true"] { border-color: rgba(236, 72, 153, .85); background: rgba(236, 72, 153, .08); box-shadow: 0 14px 28px rgba(236, 72, 153, .18); }
.variant-chip[aria-pressed="true"] .variant-chip__value { color: #be185d; }
.variant-chip:disabled { opacity: .45; cursor: not-allowed; transform: none; box-shadow: none; }
.variant-chip:disabled:hover { border-color: rgba(15, 23, 42, .18); }
.variant-picker__hint { margin-top: 10px; font-size: 12px; font-weight: 700; color: #64748b; }

@media (max-width: 576px) {
    .variant-picker__grid { grid-template-columns: 1fr; }
    .variant-chip { min-width: 84px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quantity controls
    const qtyInput = document.getElementById('qtyInput');
    const qtyMinus = document.getElementById('qtyMinus');
    const qtyPlus = document.getElementById('qtyPlus');

    const totalPriceEl = document.getElementById('totalPrice');
    const orderCalcEl = document.getElementById('orderCalc');
    const addToCartQty = document.getElementById('addToCartQty');
    const directOrderQty = document.getElementById('directOrderQty');
    const priceCurrentEl = document.getElementById('productPriceCurrent');
    const priceOldEl = document.getElementById('productPriceOld');
    const priceSaveEl = document.getElementById('productPriceSave');
    const addToCartVariantId = document.getElementById('addToCartVariantId');
    const directOrderVariantId = document.getElementById('directOrderVariantId');
    const variantHintEl = document.getElementById('variantHint');

    let unitPrice = qtyInput ? parseFloat(qtyInput.dataset.price) || 0 : 0;
    let formattedUnitPrice = unitPrice.toLocaleString('fr-FR') + 'F';

    const updateTotal = () => {
        const qty = parseInt(qtyInput.value) || 1;
        if (addToCartQty) {
            addToCartQty.value = qty;
        }
        if (directOrderQty) {
            directOrderQty.value = qty;
        }
        const total = unitPrice * qty;
        const formattedTotal = total.toLocaleString('fr-FR') + 'F';
        if (totalPriceEl) {
            totalPriceEl.textContent = formattedTotal;
        }
        if (orderCalcEl) {
            orderCalcEl.innerHTML = formattedUnitPrice + ' x ' + qty + ' = <b>' + formattedTotal + '</b>';
        }
    };

    const setVariant = (variant) => {
        if (!variant) {
            return;
        }
        if (addToCartVariantId) {
            addToCartVariantId.value = String(variant.id || '');
        }
        if (directOrderVariantId) {
            directOrderVariantId.value = String(variant.id || '');
        }

        if (qtyInput) {
            qtyInput.dataset.price = String(variant.price || 0);
        }
        unitPrice = parseFloat(variant.price) || 0;
        formattedUnitPrice = unitPrice.toLocaleString('fr-FR') + 'F';

        if (priceCurrentEl && variant.formatted_price) {
            priceCurrentEl.textContent = variant.formatted_price;
        }
        if (priceOldEl) {
            if (variant.formatted_old_price) {
                priceOldEl.style.display = '';
                priceOldEl.textContent = variant.formatted_old_price;
            } else {
                priceOldEl.style.display = 'none';
                priceOldEl.textContent = '';
            }
        }
        if (priceSaveEl) {
            if (variant.discount_percent) {
                priceSaveEl.style.display = '';
                priceSaveEl.textContent = 'Économisez ' + String(variant.discount_percent) + '%';
            } else {
                priceSaveEl.style.display = 'none';
                priceSaveEl.textContent = '';
            }
        }

        updateTotal();
    };

    const variantsJsonEl = document.getElementById('variantsData');
    const selectedVariantIdEl = document.getElementById('selectedVariantId');
    let variants = [];
    if (variantsJsonEl) {
        try {
            variants = JSON.parse(variantsJsonEl.textContent || '[]') || [];
        } catch (e) {
            variants = [];
        }
    }

    const hasVariantType = document.querySelectorAll('[data-variant-type]').length > 0;

    const getVariant = (a, places) => {
        if (hasVariantType) {
            return variants.find(v => String(v.variant_type || '') === String(a || '') && String(v.places) === String(places));
        }
        return variants.find(v => String(v.thickness_cm) === String(a) && String(v.places) === String(places));
    };

    const initVariantUI = () => {
        if (!variants.length) {
            if (addToCartVariantId) addToCartVariantId.value = '';
            if (directOrderVariantId) directOrderVariantId.value = '';
            updateTotal();
            return;
        }

        const thicknessBtns = document.querySelectorAll('[data-variant-thickness]');
        const typeBtns = document.querySelectorAll('[data-variant-type]');
        const placesBtns = document.querySelectorAll('[data-variant-places]');

        const getActivePrimary = () => {
            if (hasVariantType) {
                const active = document.querySelector('[data-variant-type][aria-pressed="true"]');
                return active ? active.getAttribute('data-variant-type') : null;
            }
            const active = document.querySelector('[data-variant-thickness][aria-pressed="true"]');
            return active ? active.getAttribute('data-variant-thickness') : null;
        };
        const getActivePlaces = () => {
            const active = document.querySelector('[data-variant-places][aria-pressed="true"]');
            return active ? active.getAttribute('data-variant-places') : null;
        };

        const setPressed = (btns, btn) => {
            btns.forEach(b => b.setAttribute('aria-pressed', 'false'));
            btn.setAttribute('aria-pressed', 'true');
        };

        const setDisabledFromSelection = () => {
            const a = getActivePrimary();
            const p = getActivePlaces();

            if (hasVariantType) {
                typeBtns.forEach(btn => {
                    const tv = btn.getAttribute('data-variant-type');
                    const ok = p ? !!getVariant(tv, p) : variants.some(v => String(v.variant_type || '') === String(tv || ''));
                    btn.disabled = !ok;
                });
            } else {
                thicknessBtns.forEach(btn => {
                    const tv = btn.getAttribute('data-variant-thickness');
                    const ok = p ? !!getVariant(tv, p) : variants.some(v => String(v.thickness_cm) === String(tv));
                    btn.disabled = !ok;
                });
            }

            placesBtns.forEach(btn => {
                const pv = btn.getAttribute('data-variant-places');
                const ok = a ? !!getVariant(a, pv) : variants.some(v => String(v.places) === String(pv));
                btn.disabled = !ok;
            });
        };

        const normalizeSelection = () => {
            const a = getActivePrimary();
            const p = getActivePlaces();
            if (a && p && getVariant(a, p)) {
                return;
            }

            const first = variants[0];
            const aTarget = hasVariantType
                ? (a && variants.some(v => String(v.variant_type || '') === String(a || '')) ? a : String(first.variant_type || ''))
                : (a && variants.some(v => String(v.thickness_cm) === String(a)) ? a : String(first.thickness_cm));
            const pTarget = p && variants.some(v => String(v.places) === String(p)) ? p : String(first.places);
            const candidate = getVariant(aTarget, pTarget) || (hasVariantType
                ? variants.find(v => String(v.variant_type || '') === String(aTarget || ''))
                : variants.find(v => String(v.thickness_cm) === String(aTarget))) || first;

            if (hasVariantType) {
                typeBtns.forEach(btn => {
                    const tv = btn.getAttribute('data-variant-type');
                    btn.setAttribute('aria-pressed', String(tv || '') === String(candidate.variant_type || '') ? 'true' : 'false');
                });
            } else {
                thicknessBtns.forEach(btn => {
                    const tv = btn.getAttribute('data-variant-thickness');
                    btn.setAttribute('aria-pressed', String(tv) === String(candidate.thickness_cm) ? 'true' : 'false');
                });
            }
            placesBtns.forEach(btn => {
                const pv = btn.getAttribute('data-variant-places');
                btn.setAttribute('aria-pressed', String(pv) === String(candidate.places) ? 'true' : 'false');
            });
        };

        const applySelection = () => {
            normalizeSelection();
            setDisabledFromSelection();
            const a = getActivePrimary();
            const p = getActivePlaces();
            const v = getVariant(a, p) || variants[0];
            if (selectedVariantIdEl) {
                selectedVariantIdEl.value = String(v.id || '');
            }
            setVariant(v);

            if (variantHintEl) {
                const okText = v && v.in_stock === false ? 'Indisponible' : 'Disponible';
                const leftText = hasVariantType
                    ? (a ? String(a) : '')
                    : (a ? (a + ' cm') : '');
                variantHintEl.textContent = (leftText ? leftText : '') + (p ? (' • ' + p + ' place(s)') : '') + (a && p ? (' • ' + okText) : '');
            }
        };

        if (hasVariantType) {
            typeBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    if (btn.disabled) return;
                    setPressed(typeBtns, btn);
                    applySelection();
                });
            });
        } else {
            thicknessBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    if (btn.disabled) return;
                    setPressed(thicknessBtns, btn);
                    applySelection();
                });
            });
        }
        placesBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                if (btn.disabled) return;
                setPressed(placesBtns, btn);
                applySelection();
            });
        });

        applySelection();
    };

    if (qtyMinus && qtyPlus && qtyInput) {
        qtyMinus.addEventListener('click', () => {
            const val = parseInt(qtyInput.value) || 1;
            if (val > 1) {
                qtyInput.value = val - 1;
                updateTotal();
            }
        });
        qtyPlus.addEventListener('click', () => {
            const val = parseInt(qtyInput.value) || 1;
            if (val < 10) {
                qtyInput.value = val + 1;
                updateTotal();
            }
        });
        qtyInput.addEventListener('change', updateTotal);
    }

    initVariantUI();

    // Gallery thumbnails
    const mainImage = document.getElementById('mainImage');
    const thumbs = document.querySelectorAll('.product-gallery__thumb');

    thumbs.forEach(thumb => {
        thumb.addEventListener('click', function() {
            thumbs.forEach(t => t.classList.remove('product-gallery__thumb--active'));
            this.classList.add('product-gallery__thumb--active');
            mainImage.src = this.dataset.img;
        });
    });

    // Order Modal
    const orderModal = document.getElementById('orderModal');
    const orderBtn = document.querySelector('.product-cta-direct[data-role="modal"]');
    const closeBtn = document.getElementById('orderModalCloseBtn');
    const closeOverlay = document.getElementById('orderModalClose');
    const orderForm = document.getElementById('orderForm');

    if (orderBtn && orderModal) {
        orderBtn.addEventListener('click', () => {
            orderModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }

    const closeModal = () => {
        orderModal.classList.remove('active');
        document.body.style.overflow = '';
    };

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (closeOverlay) closeOverlay.addEventListener('click', closeModal);

    // Form submission - Validate order
    if (orderForm) {
        orderForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = this.querySelector('.order-form__submit');
            const originalText = submitBtn.innerHTML;

            // Show loading state
            submitBtn.innerHTML = '<svg class="animate-spin" viewBox="0 0 24 24" width="20" height="20"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" fill="none" opacity="0.3"/><path d="M12 2a10 10 0 0 1 10 10" stroke="currentColor" stroke-width="3" fill="none" stroke-linecap="round"/></svg> Validation en cours...';
            submitBtn.disabled = true;

            // Simulate saving (replace with actual AJAX call to save order)
            setTimeout(() => {
                // Show success
                submitBtn.innerHTML = '<svg viewBox="0 0 24 24" width="20" height="20"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" fill="currentColor"/></svg> Commande validée !';
                submitBtn.style.background = 'linear-gradient(135deg, #10b981, #059669)';

                setTimeout(() => {
                    closeModal();
                    // Reset form
                    orderForm.reset();
                    submitBtn.innerHTML = originalText;
                    submitBtn.style.background = '';
                    submitBtn.disabled = false;

                    // Show success notification
                    if (window.showFlashToast) {
                        window.showFlashToast('Votre commande a été enregistrée avec succès. Nous vous contacterons très bientôt pour confirmer la livraison.', 'success');
                    }
                }, 1500);
            }, 1500);
        });
    }
});
</script>
@endsection
