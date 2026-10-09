@extends('maquette.layout')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <ul class="list-unstyled d-flex align-items-center m-0">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li>
                    <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g opacity="0.4">
                            <path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000" />
                        </g>
                    </svg>
                </li>
                <li>Panier</li>
            </ul>
        </div>
    </div>

    <div class="cart-page mt-100 mp-checkout">
        <div class="container">

            <div class="mp-checkout-head" data-aos="fade-up" data-aos-duration="600">
                <p class="featured-kicker">Votre sélection</p>
                <h1 class="section-heading">Votre <span class="featured-title-accent">panier</span></h1>
            </div>

            <div class="mp-steps" data-aos="fade-up" data-aos-duration="600">
                <span class="mp-step is-active">
                    <span class="mp-step-num">1</span>
                    <span class="mp-step-label">Panier</span>
                </span>
                <span class="mp-step-line"></span>
                <span class="mp-step">
                    <span class="mp-step-num">2</span>
                    <span class="mp-step-label">Livraison</span>
                </span>
                <span class="mp-step-line"></span>
                <span class="mp-step">
                    <span class="mp-step-num">3</span>
                    <span class="mp-step-label">Confirmation</span>
                </span>
            </div>

            @if($cartItems->isEmpty())
                <div class="mp-panel mp-cart-empty text-center" data-aos="fade-up" data-aos-duration="600">
                    <span class="mp-cart-empty-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="20" r="1.6"/><circle cx="17" cy="20" r="1.6"/><path d="M2.5 3.5h2l2.6 11.4a1.6 1.6 0 0 0 1.6 1.3h7.9a1.6 1.6 0 0 0 1.6-1.3L20.5 7H5.2"/></svg>
                    </span>
                    <h2 class="mp-panel-title">Votre panier est vide</h2>
                    <p class="mp-panel-sub mb-4">Parcourez nos collections et trouvez le produit qu'il vous faut.</p>
                    <a href="{{ route('collection.index') }}" class="mp-buy mp-cart-cta">Découvrir nos produits</a>
                </div>
            @else
                <div class="row mp-checkout-grid">
                    <div class="col-lg-8 col-12">
                        <div class="mp-cart-list">
                            @foreach($cartItems as $item)
                                <div class="mp-panel mp-cart-item" data-aos="fade-up" data-aos-duration="600">
                                    <a class="mp-cart-media" href="{{ route('product.show', $item->slug) }}">
                                        <img loading="lazy" decoding="async" src="@image_url($item->image ?: 'assets/maquette/img/products/real/placeholder.jpg')" alt="{{ $item->name }}">
                                    </a>
                                    <div class="mp-cart-info">
                                        <h2 class="mp-cart-name"><a href="{{ route('product.show', $item->slug) }}">{{ $item->name }}</a></h2>
                                        @if($item->options)
                                            <p class="mp-cart-variant">{{ $item->options }}</p>
                                        @endif
                                        <p class="mp-cart-unit">{{ number_format($item->price, 0, ',', ' ') }} FCFA <small>/ unité</small></p>

                                        <div class="mp-cart-row">
                                            <form action="{{ route('cart.update') }}" method="POST" class="mp-qty mp-cart-qty">
                                                @csrf
                                                <input type="hidden" name="cart_key" value="{{ $item->cart_key }}">
                                                <button type="submit" name="quantity" value="{{ max(1, $item->quantity - 1) }}" class="mp-qty-btn" aria-label="Diminuer la quantité">−</button>
                                                <span class="mp-qty-input mp-qty-static">{{ $item->quantity }}</span>
                                                <button type="submit" name="quantity" value="{{ min(10, $item->quantity + 1) }}" class="mp-qty-btn" aria-label="Augmenter la quantité">+</button>
                                            </form>
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="cart_key" value="{{ $item->cart_key }}">
                                                <button type="submit" class="mp-cart-remove" aria-label="Retirer {{ $item->name }} du panier">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                                                    Retirer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="mp-cart-price">
                                        <strong>{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA</strong>
                                        @if($item->old_price && $item->old_price > $item->price)
                                            <del>{{ number_format($item->old_price * $item->quantity, 0, ',', ' ') }} FCFA</del>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a href="{{ route('collection.index') }}" class="mp-back-link mt-3 d-inline-flex">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m11 18-6-6 6-6"/></svg>
                            Continuer mes achats
                        </a>
                    </div>

                    <div class="col-lg-4 col-12">
                        <aside class="mp-panel mp-summary" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                            <h3 class="mp-panel-title mp-summary-title">Récapitulatif</h3>
                            <div class="mp-summary-rows">
                                <div class="mp-summary-row">
                                    <span>Sous-total</span>
                                    <strong>{{ number_format($subtotal, 0, ',', ' ') }} FCFA</strong>
                                </div>
                                @if($savings > 0)
                                    <div class="mp-summary-row">
                                        <span>Économies</span>
                                        <strong class="text-success">-{{ number_format($savings, 0, ',', ' ') }} FCFA</strong>
                                    </div>
                                @endif
                                <div class="mp-summary-row">
                                    <span>Livraison</span>
                                    <strong>{{ $shipping > 0 ? number_format($shipping, 0, ',', ' ') . ' FCFA' : 'À calculer' }}</strong>
                                </div>
                                <div class="mp-summary-row mp-summary-total">
                                    <span>Total</span>
                                    <strong>{{ number_format($total, 0, ',', ' ') }} FCFA</strong>
                                </div>
                            </div>
                            <p class="mp-summary-hint">Livraison et taxes calculées à l'étape suivante.</p>
                            <a href="{{ route('cart.shipping') }}" class="mp-buy mp-cart-cta">
                                Commander
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                            </a>
                            <div class="mp-summary-note">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                                Paiement sécurisé — vous confirmez à l'étape livraison.
                            </div>
                        </aside>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
