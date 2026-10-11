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
                        <aside class="mp-panel mp-summary cart-recap" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                            <div class="cart-recap__head">
                                <div>
                                    <span>Votre sélection</span>
                                    <h3>Récapitulatif</h3>
                                </div>
                                <div class="cart-recap__count">
                                    <strong>{{ number_format($cartItems->sum('quantity'), 0, ',', ' ') }}</strong>
                                    <span>article{{ $cartItems->sum('quantity') > 1 ? 's' : '' }}</span>
                                </div>
                            </div>

                            <div class="cart-recap__body">
                                <div class="cart-recap__row">
                                    <span>Sous-total</span>
                                    <strong>{{ number_format($subtotal, 0, ',', ' ') }} FCFA</strong>
                                </div>
                                @if($savings > 0)
                                    <div class="cart-recap__saving">
                                        <span>Votre économie</span>
                                        <strong>-{{ number_format($savings, 0, ',', ' ') }} FCFA</strong>
                                    </div>
                                @endif
                                <div class="cart-recap__row">
                                    <span>Livraison</span>
                                    <strong>{{ $shipping > 0 ? number_format($shipping, 0, ',', ' ') . ' FCFA' : 'À confirmer' }}</strong>
                                </div>
                                <div class="cart-recap__total">
                                    <span>Total estimé</span>
                                    <strong>{{ number_format($total, 0, ',', ' ') }} FCFA</strong>
                                </div>
                                <p class="cart-recap__hint">Le montant final et les disponibilités sont confirmés par notre équipe avant la préparation.</p>

                                <a href="{{ route('cart.shipping') }}" class="cart-recap__cta">
                                    Continuer vers la livraison
                                    <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                                </a>

                                <div class="cart-recap__trust">
                                    <div>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                                        <span>Données protégées</span>
                                    </div>
                                    <div>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15.46v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.07-8.67A2 2 0 0 1 3.11.54h3a2 2 0 0 1 2 1.72"/><path d="M7 8.5a16 16 0 0 0 8.5 8.5"/></svg>
                                        <span>Validation WhatsApp</span>
                                    </div>
                                    <div>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 6h18v12H3z"/><path d="m3 7 9 6 9-6"/></svg>
                                        <span>Aucun paiement sans confirmation</span>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
<style>
.cart-recap{padding:0!important;overflow:hidden;border:1px solid rgba(0,35,77,.1);box-shadow:0 22px 52px rgba(0,35,77,.12)}
.cart-recap__head{display:flex;align-items:center;justify-content:space-between;gap:18px;padding:24px;background:#00234D;color:#fff}
.cart-recap__head>div:first-child>span{display:block;color:#ec4899;font-size:10px;font-weight:800;letter-spacing:.14em;text-transform:uppercase;margin-bottom:4px}
.cart-recap__head h3{font-size:21px;line-height:1.2;font-weight:800;color:#fff;margin:0}
.cart-recap__count{min-width:68px;border:1px solid rgba(255,255,255,.16);background:rgba(255,255,255,.08);border-radius:14px;padding:8px 12px;text-align:center}
.cart-recap__count strong{display:block;color:#fff;font-size:17px;line-height:1}.cart-recap__count span{display:block;color:rgba(255,255,255,.6);font-size:9px;text-transform:uppercase;letter-spacing:.08em;margin-top:4px}
.cart-recap__body{padding:22px}
.cart-recap__row{display:flex;align-items:center;justify-content:space-between;gap:16px;padding:7px 0;color:#64748b;font-size:13px}.cart-recap__row strong{color:#00234D;white-space:nowrap}
.cart-recap__saving{display:flex;align-items:center;justify-content:space-between;gap:14px;background:rgba(22,163,74,.08);border:1px solid rgba(22,163,74,.16);border-radius:11px;padding:10px 12px;margin:8px 0;color:#15803d;font-size:12px;font-weight:700}.cart-recap__saving strong{white-space:nowrap}
.cart-recap__total{display:flex;align-items:end;justify-content:space-between;gap:16px;border-top:1px solid #e8edf2;margin-top:12px;padding-top:17px;color:#00234D;font-size:14px;font-weight:800}.cart-recap__total strong{font-size:21px;color:#ec4899;white-space:nowrap}
.cart-recap__hint{font-size:10.5px;line-height:1.55;color:#7b8798;background:#f7f9fc;border-radius:10px;padding:10px 12px;margin:15px 0}
.cart-recap__cta{display:flex;align-items:center;justify-content:center;gap:10px;width:100%;border-radius:999px;background:#ec4899;color:#fff;text-decoration:none;padding:15px 18px;font-size:12px;font-weight:800;text-transform:uppercase;letter-spacing:.04em;box-shadow:0 13px 30px rgba(236,72,153,.3);transition:.2s}.cart-recap__cta:hover{background:#d1357f;color:#fff;transform:translateY(-2px);box-shadow:0 17px 38px rgba(236,72,153,.38)}
.cart-recap__trust{display:flex;flex-direction:column;gap:9px;margin-top:18px;padding-top:17px;border-top:1px solid #edf0f4}.cart-recap__trust>div{display:flex;align-items:center;gap:8px;color:#596579;font-size:10.5px}.cart-recap__trust svg{width:17px;height:17px;color:#16a34a;flex:0 0 17px}
@media(max-width:991.98px){.cart-recap{position:static;margin-top:8px}.mp-checkout-grid>.col-lg-4{order:2}}
@media(max-width:575.98px){.cart-recap__head{padding:19px}.cart-recap__body{padding:18px}.cart-recap__total{align-items:center}.cart-recap__total strong{font-size:18px}.cart-recap__cta{font-size:11px;padding:14px}}
</style>
@endpush
