@extends('layouts.front')

@section('title', 'Mon Panier')
@section('meta_description', 'Finalisez votre commande sur Mobilier Addict. Livraison rapide et paiement sécurisé.')

@section('content')
<div class="cart-page">
    <!-- Progress Steps -->
    <div class="cart-progress">
        <div class="container">
            <div class="cart-progress__steps">
                <div class="cart-progress__step cart-progress__step--active">
                    <div class="cart-progress__icon">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M17 18c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm0-3l1.1-2h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1v2h2l3.6 7.59L3.62 17H19v-2H7z" fill="currentColor"/></svg>
                    </div>
                    <span>Panier</span>
                </div>
                <div class="cart-progress__line"></div>
                <div class="cart-progress__step">
                    <div class="cart-progress__icon">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="currentColor"/></svg>
                    </div>
                    <span>Livraison</span>
                </div>
                <div class="cart-progress__line"></div>
                <div class="cart-progress__step">
                    <div class="cart-progress__icon">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" fill="currentColor"/></svg>
                    </div>
                    <span>Paiement</span>
                </div>
                <div class="cart-progress__line"></div>
                <div class="cart-progress__step">
                    <div class="cart-progress__icon">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" fill="currentColor"/></svg>
                    </div>
                    <span>Confirmation</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Header -->
        <div class="cart-header">
            <div class="cart-header__content">
                <h1 class="cart-header__title">Mon Panier</h1>
                <p class="cart-header__count">{{ $cartItems->count() }} article{{ $cartItems->count() > 1 ? 's' : '' }}</p>
            </div>
            <a href="{{ route('home') }}" class="cart-header__continue">
                <svg viewBox="0 0 24 24" width="18" height="18"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" fill="currentColor"/></svg>
                Continuer mes achats
            </a>
        </div>

        @if($cartItems->count() > 0)
        <div class="cart-layout">
            <!-- Cart Items -->
            <div class="cart-main">
                <!-- Free Shipping Banner -->
				@if(empty($usesProductShipping) || !$usesProductShipping)
					@if($shipping > 0)
					<div class="cart-shipping-banner">
						<div class="cart-shipping-banner__icon">
							<svg viewBox="0 0 24 24" width="24" height="24"><path d="M18 18.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM19.5 9.5l1.96 2.5H17V9.5h2.5zM6 18.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM20 8l3 4v5h-2c0 1.66-1.34 3-3 3s-3-1.34-3-3H9c0 1.66-1.34 3-3 3s-3-1.34-3-3H1V6c0-1.11.89-2 2-2h14v4h3zM3 6v9h.76c.55-.61 1.35-1 2.24-1s1.69.39 2.24 1H15V6H3z" fill="currentColor"/></svg>
						</div>
						<div class="cart-shipping-banner__content">
							<p class="cart-shipping-banner__text">
								Plus que <strong>{{ number_format(50000 - $subtotal, 0, ',', '.') }}F</strong> pour bénéficier de la <strong>livraison gratuite !</strong>
							</p>
							<div class="cart-shipping-banner__progress">
								<div class="cart-shipping-banner__bar" style="width: {{ min(100, ($subtotal / 50000) * 100) }}%"></div>
							</div>
						</div>
					</div>
					@else
					<div class="cart-shipping-banner cart-shipping-banner--success">
						<div class="cart-shipping-banner__icon">
							<svg viewBox="0 0 24 24" width="24" height="24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" fill="currentColor"/></svg>
						</div>
						<div class="cart-shipping-banner__content">
							<p class="cart-shipping-banner__text">
								<strong>Félicitations !</strong> Vous bénéficiez de la livraison gratuite 🎉
							</p>
						</div>
					</div>
					@endif
				@endif

                <!-- Cart Items List -->
                <div class="cart-items">
                    @foreach($cartItems as $item)
                    <div class="cart-item" data-id="{{ $item->cart_key ?? $item->id }}">
                        <div class="cart-item__image">
                            <a href="{{ $item->slug ? route('product.show', $item->slug) : route('cart.index') }}">
                                <img src="{{ $item->image }}" alt="{{ $item->name }}" loading="lazy">
                            </a>
                            @if($item->old_price)
                            <span class="cart-item__badge">-{{ round((($item->old_price - $item->price) / $item->old_price) * 100) }}%</span>
                            @endif
                        </div>
                        <div class="cart-item__details">
                            <div class="cart-item__info">
                                <a href="{{ $item->slug ? route('product.show', $item->slug) : route('cart.index') }}" class="cart-item__name">{{ $item->name }}</a>
                                @if($item->options)
                                <p class="cart-item__options">{{ $item->options }}</p>
                                @endif
                                <div class="cart-item__stock">
                                    <span class="cart-item__stock-dot"></span>
                                    En stock • Expédition sous 24h
                                </div>
                            </div>
                            <div class="cart-item__actions">
                                <form class="cart-item__quantity" action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cart_key" value="{{ $item->cart_key ?? '' }}">
                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                    <button class="cart-item__qty-btn" type="button" aria-label="Diminuer" data-action="minus">
                                        <svg viewBox="0 0 24 24" width="16" height="16"><path d="M19 13H5v-2h14v2z" fill="currentColor"/></svg>
                                    </button>
                                    <input type="number" name="quantity" class="cart-item__qty-input" value="{{ $item->quantity }}" min="1" max="10">
                                    <button class="cart-item__qty-btn" type="button" aria-label="Augmenter" data-action="plus">
                                        <svg viewBox="0 0 24 24" width="16" height="16"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" fill="currentColor"/></svg>
                                    </button>
                                </form>
                                <div class="cart-item__prices">
                                    <span class="cart-item__price">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}F</span>
                                    @if($item->old_price)
                                    <span class="cart-item__old-price">{{ number_format($item->old_price * $item->quantity, 0, ',', '.') }}F</span>
                                    @endif
                                </div>
                            </div>
                            <div class="cart-item__footer">
                                <button class="cart-item__wishlist" type="button">
                                    <svg viewBox="0 0 24 24" width="16" height="16"><path d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z" fill="currentColor"/></svg>
                                    Ajouter aux favoris
                                </button>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cart_key" value="{{ $item->cart_key ?? '' }}">
                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                    <button class="cart-item__remove" type="submit">
                                        <svg viewBox="0 0 24 24" width="16" height="16"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" fill="currentColor"/></svg>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Promo Code -->
                <div class="cart-promo">
                    <div class="cart-promo__header">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z" fill="currentColor"/></svg>
                        <span>Code promo</span>
                    </div>
                    <div class="cart-promo__form">
                        <input type="text" class="cart-promo__input" placeholder="Entrez votre code">
                        <button class="cart-promo__btn" type="button">Appliquer</button>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="cart-sidebar">
                <div class="cart-summary">
                    <h2 class="cart-summary__title">Récapitulatif</h2>

                    <div class="cart-summary__rows">
                        <div class="cart-summary__row">
                            <span>Sous-total</span>
                            <span>{{ number_format($subtotal, 0, ',', '.') }}F</span>
                        </div>
                        @if($savings > 0)
                        <div class="cart-summary__row cart-summary__row--savings">
                            <span>Économies</span>
                            <span>-{{ number_format($savings, 0, ',', '.') }}F</span>
                        </div>
                        @endif
                        <div class="cart-summary__row">
                            <span>Livraison</span>
                            <span>{{ $shipping > 0 ? number_format($shipping, 0, ',', '.') . 'F' : 'Gratuite' }}</span>
                        </div>
                    </div>

                    <div class="cart-summary__total">
                        <span>Total</span>
                        <span>{{ number_format($total, 0, ',', '.') }}F</span>
                    </div>

                    <a class="cart-summary__checkout" href="{{ route('cart.shipping') }}">
                        Passer la commande
                        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" fill="currentColor"/></svg>
                    </a>

                    <div class="cart-summary__payment-methods">
                        <span>Paiements acceptés</span>
                        <div class="cart-summary__payment-icons">
                            <div class="payment-icon" title="Visa">
                                <svg viewBox="0 0 50 50" width="36" height="24"><path fill="#1A1F71" d="M20.3 35.3l2.6-15.6h4.1l-2.6 15.6h-4.1zm16.9-15.2c-.8-.3-2.1-.7-3.7-.7-4.1 0-6.9 2.1-7 5.1 0 2.2 2 3.4 3.6 4.2 1.6.8 2.1 1.3 2.1 2 0 1.1-1.3 1.6-2.4 1.6-1.6 0-2.5-.2-3.8-.8l-.5-.2-.6 3.4c1 .4 2.7.8 4.5.8 4.3 0 7.1-2.1 7.2-5.3 0-1.8-1.1-3.1-3.4-4.2-1.4-.7-2.3-1.2-2.3-1.9 0-.7.7-1.3 2.3-1.3 1.3 0 2.3.3 3 .6l.4.2.6-3.5zm10.5-.4h-3.2c-1 0-1.7.3-2.2 1.3l-6.1 14.3h4.3l.9-2.3h5.3l.5 2.3h3.8l-3.3-15.6zm-5.1 10.1c.3-.9 1.6-4.3 1.6-4.3l.5-1.3.3 1.2.9 4.4h-3.3zM18.1 19.7l-4 10.7-.4-2.2c-.8-2.5-3.1-5.2-5.7-6.5l3.7 13.5h4.4l6.5-15.5h-4.5z"/><path fill="#F9A533" d="M10.4 19.7H4l-.1.4c5.2 1.3 8.6 4.4 10 8.1l-1.4-7.2c-.3-.9-1-1.2-2.1-1.3z"/></svg>
                            </div>
                            <div class="payment-icon" title="Mastercard">
                                <svg viewBox="0 0 50 50" width="36" height="24"><circle cx="17" cy="25" r="12" fill="#EB001B"/><circle cx="33" cy="25" r="12" fill="#F79E1B"/><path fill="#FF5F00" d="M25 15.5c3 2.4 5 6 5 10s-2 7.6-5 10c-3-2.4-5-6-5-10s2-7.6 5-10z"/></svg>
                            </div>
                            <div class="payment-icon" title="Orange Money">
                                <svg viewBox="0 0 50 50" width="36" height="24"><rect width="50" height="50" rx="8" fill="#FF6600"/><text x="25" y="30" text-anchor="middle" fill="white" font-size="12" font-weight="bold">OM</text></svg>
                            </div>
                            <div class="payment-icon" title="Wave">
                                <svg viewBox="0 0 50 50" width="36" height="24"><rect width="50" height="50" rx="8" fill="#1DC8F2"/><text x="25" y="30" text-anchor="middle" fill="white" font-size="10" font-weight="bold">Wave</text></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trust Badges -->
                <div class="cart-trust">
                    <div class="cart-trust__item">
                        <svg viewBox="0 0 24 24" width="24" height="24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z" fill="currentColor"/></svg>
                        <div>
                            <strong>Paiement sécurisé</strong>
                            <span>Transactions 100% protégées</span>
                        </div>
                    </div>
                    <div class="cart-trust__item">
                        <svg viewBox="0 0 24 24" width="24" height="24"><path d="M18 18.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM19.5 9.5l1.96 2.5H17V9.5h2.5zM6 18.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM20 8l3 4v5h-2c0 1.66-1.34 3-3 3s-3-1.34-3-3H9c0 1.66-1.34 3-3 3s-3-1.34-3-3H1V6c0-1.11.89-2 2-2h14v4h3zM3 6v9h.76c.55-.61 1.35-1 2.24-1s1.69.39 2.24 1H15V6H3z" fill="currentColor"/></svg>
                        <div>
                            <strong>Livraison rapide</strong>
                            <span>Expédition sous 24-48h</span>
                        </div>
                    </div>
                    <div class="cart-trust__item">
                        <svg viewBox="0 0 24 24" width="24" height="24"><path d="M12.5 8c-2.65 0-5.05.99-6.9 2.6L2 7v9h9l-3.62-3.62c1.39-1.16 3.16-1.88 5.12-1.88 3.54 0 6.55 2.31 7.6 5.5l2.37-.78C21.08 11.03 17.15 8 12.5 8z" fill="currentColor"/></svg>
                        <div>
                            <strong>Retour gratuit</strong>
                            <span>30 jours pour changer d'avis</span>
                        </div>
                    </div>
                </div>

                <!-- Customer Support -->
                <div class="cart-support">
                    <div class="cart-support__icon">
                        <svg viewBox="0 0 24 24" width="32" height="32"><path d="M20 15.5c-1.25 0-2.45-.2-3.57-.57-.35-.11-.74-.03-1.02.24l-2.2 2.2c-2.83-1.44-5.15-3.75-6.59-6.59l2.2-2.21c.28-.26.36-.65.25-1C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1zM19 12h2c0-4.97-4.03-9-9-9v2c3.87 0 7 3.13 7 7zm-4 0h2c0-2.76-2.24-5-5-5v2c1.66 0 3 1.34 3 3z" fill="currentColor"/></svg>
                    </div>
                    <div class="cart-support__content">
                        <strong>Besoin d'aide ?</strong>
                        <p>Notre équipe est disponible pour vous accompagner</p>
                        <a href="tel:+2250799140356" class="cart-support__phone">📞 +225 0799140356</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Suggested Products -->
        <section class="cart-suggestions">
            <div class="cart-suggestions__header">
                <h2 class="cart-suggestions__title">Complétez votre commande</h2>
                <p class="cart-suggestions__subtitle">Ces articles pourraient vous intéresser</p>
            </div>
            <div class="cart-suggestions__grid">
                @foreach($suggestedProducts as $product)
                <a href="{{ route('demo.product') }}" class="cart-suggestion-card">
                    @if($product->discount_percent)
                    <div class="cart-suggestion-card__badge">-{{ $product->discount_percent }}%</div>
                    @endif
                    <div class="cart-suggestion-card__image">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy">
                    </div>
                    <div class="cart-suggestion-card__content">
                        <h3 class="cart-suggestion-card__name">{{ $product->name }}</h3>
                        <div class="cart-suggestion-card__prices">
                            <span class="cart-suggestion-card__price">{{ $product->formatted_price }}</span>
                            @if($product->formatted_old_price)
                            <span class="cart-suggestion-card__old">{{ $product->formatted_old_price }}</span>
                            @endif
                        </div>
                        <button class="cart-suggestion-card__btn cart-suggestion-card__btn--pink" type="button">
                            <svg viewBox="0 0 24 24" width="16" height="16"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" fill="currentColor"/></svg>
                            AJOUTER AU PANIER
                        </button>
                    </div>
                </a>
                @endforeach
            </div>
        </section>

        @else
        <!-- Empty Cart -->
        <div class="cart-empty">
            <div class="cart-empty__icon">
                <svg viewBox="0 0 24 24" width="80" height="80"><path d="M17 18c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm0-3l1.1-2h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1v2h2l3.6 7.59L3.62 17H19v-2H7z" fill="currentColor" opacity=".3"/></svg>
            </div>
            <h2 class="cart-empty__title">Votre panier est vide</h2>
            <p class="cart-empty__text">Explorez notre catalogue et trouvez les produits parfaits pour votre intérieur.</p>
            <a href="{{ route('home') }}" class="cart-empty__btn">
                Découvrir nos produits
                <svg viewBox="0 0 24 24" width="20" height="20"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" fill="currentColor"/></svg>
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.cart-item__quantity').forEach((form) => {
        const input = form.querySelector('input[name="quantity"]');
        const minus = form.querySelector('[data-action="minus"]');
        const plus = form.querySelector('[data-action="plus"]');

        const submit = () => form.submit();

        if (minus && input) {
            minus.addEventListener('click', () => {
                const val = parseInt(input.value || '1', 10);
                if (val > 1) {
                    input.value = val - 1;
                    submit();
                }
            });
        }

        if (plus && input) {
            plus.addEventListener('click', () => {
                const val = parseInt(input.value || '1', 10);
                if (val < 10) {
                    input.value = val + 1;
                    submit();
                }
            });
        }

        if (input) {
            input.addEventListener('change', () => {
                const val = parseInt(input.value || '1', 10);
                if (val >= 1 && val <= 10) submit();
            });
        }
    });
});
</script>
@endpush

@push('styles')
<style>
/* Cart Page Styles */
.cart-page{background:linear-gradient(180deg,#f8fafc 0%,#fff 100%);min-height:100vh;padding-bottom:80px}

/* Progress Steps */
.cart-progress{background:#fff;border-bottom:1px solid #e2e8f0;padding:20px 0}
.cart-progress__steps{display:flex;align-items:center;justify-content:center;gap:8px;max-width:600px;margin:0 auto}
.cart-progress__step{display:flex;align-items:center;gap:8px;color:#94a3b8;font-size:13px;font-weight:500}
.cart-progress__step--active{color:#ec4899}
.cart-progress__step--active .cart-progress__icon{background:#ec4899;color:#fff}
.cart-progress__step--completed{color:#10b981}
.cart-progress__step--completed .cart-progress__icon{background:#10b981;color:#fff}
.cart-progress__icon{width:36px;height:36px;border-radius:50%;background:#f1f5f9;display:flex;align-items:center;justify-content:center;transition:all .3s ease}
.cart-progress__line{flex:1;height:2px;background:#e2e8f0;max-width:60px}

/* Header */
.cart-header{display:flex;align-items:center;justify-content:space-between;padding:32px 0 24px;flex-wrap:wrap;gap:16px}
.cart-header__title{font-size:28px;font-weight:700;color:#1e293b;margin:0}
.cart-header__count{color:#64748b;font-size:14px;margin:4px 0 0}
.cart-header__continue{display:flex;align-items:center;gap:8px;color:#64748b;font-size:14px;font-weight:500;text-decoration:none;transition:color .2s}
.cart-header__continue:hover{color:#ec4899}

/* Layout */
.cart-layout{display:grid;grid-template-columns:1fr 380px;gap:32px;align-items:start}
@media(max-width:1024px){.cart-layout{grid-template-columns:1fr}}

/* Main Content */
.cart-main{display:flex;flex-direction:column;gap:24px}

/* Shipping Banner */
.cart-shipping-banner{display:flex;align-items:center;gap:16px;background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:16px 20px;box-shadow:0 4px 20px rgba(0,0,0,.04)}
.cart-shipping-banner--success{background:linear-gradient(135deg,#ecfdf5,#d1fae5);border-color:#a7f3d0}
.cart-shipping-banner--success .cart-shipping-banner__icon{background:#10b981;color:#fff}
.cart-shipping-banner__icon{width:48px;height:48px;border-radius:12px;background:#fdf2f8;color:#ec4899;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.cart-shipping-banner__content{flex:1}
.cart-shipping-banner__text{margin:0 0 8px;font-size:14px;color:#334155}
.cart-shipping-banner__progress{height:6px;background:#e2e8f0;border-radius:3px;overflow:hidden}
.cart-shipping-banner__bar{height:100%;background:linear-gradient(90deg,#ec4899,#f472b6);border-radius:3px;transition:width .5s ease}

/* Cart Items */
.cart-items{display:flex;flex-direction:column;gap:16px}
.cart-item{display:flex;gap:20px;background:#fff;border:1px solid #e2e8f0;border-radius:20px;padding:20px;box-shadow:0 4px 20px rgba(0,0,0,.04);transition:all .3s ease}
.cart-item:hover{border-color:#cbd5e1;box-shadow:0 8px 30px rgba(0,0,0,.08)}
.cart-item__image{position:relative;width:140px;height:140px;flex-shrink:0;border-radius:12px;overflow:hidden;background:#f8fafc}
.cart-item__image img{width:100%;height:100%;object-fit:cover;transition:transform .4s ease}
.cart-item:hover .cart-item__image img{transform:scale(1.05)}
.cart-item__badge{position:absolute;top:8px;left:8px;background:linear-gradient(135deg,#ec4899,#be185d);color:#fff;font-size:11px;font-weight:700;padding:4px 8px;border-radius:6px}
.cart-item__details{flex:1;display:flex;flex-direction:column;gap:12px}
.cart-item__info{flex:1}
.cart-item__name{font-size:16px;font-weight:600;color:#1e293b;text-decoration:none;display:block;margin-bottom:4px;transition:color .2s}
.cart-item__name:hover{color:#ec4899}
.cart-item__options{font-size:13px;color:#64748b;margin:0 0 8px}
.cart-item__stock{display:flex;align-items:center;gap:6px;font-size:12px;color:#10b981;font-weight:500}
.cart-item__stock-dot{width:6px;height:6px;background:#10b981;border-radius:50%;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.5}}
.cart-item__actions{display:flex;align-items:center;justify-content:space-between;gap:16px}
.cart-item__quantity{display:flex;align-items:center;background:#f8fafc;border-radius:10px;border:1px solid #e2e8f0}
.cart-item__qty-btn{width:36px;height:36px;border:none;background:transparent;color:#64748b;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s}
.cart-item__qty-btn:hover{color:#ec4899;background:#fdf2f8}
.cart-item__qty-input{width:40px;height:36px;border:none;background:transparent;text-align:center;font-size:14px;font-weight:600;color:#1e293b}
.cart-item__qty-input::-webkit-outer-spin-button,.cart-item__qty-input::-webkit-inner-spin-button{-webkit-appearance:none;margin:0}
.cart-item__prices{text-align:right}
.cart-item__price{font-size:18px;font-weight:700;color:#ec4899;display:block}
.cart-item__old-price{font-size:13px;color:#94a3b8;text-decoration:line-through}
.cart-item__footer{display:flex;align-items:center;gap:16px;padding-top:12px;border-top:1px solid #f1f5f9}
.cart-item__wishlist,.cart-item__remove{display:flex;align-items:center;gap:6px;font-size:12px;color:#64748b;background:none;border:none;cursor:pointer;padding:6px 10px;border-radius:6px;transition:all .2s}
.cart-item__wishlist:hover{color:#ec4899;background:#fdf2f8}
.cart-item__remove:hover{color:#ef4444;background:#fef2f2}

/* Promo Code */
.cart-promo{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:20px;box-shadow:0 4px 20px rgba(0,0,0,.04)}
.cart-promo__header{display:flex;align-items:center;gap:10px;color:#64748b;font-size:14px;font-weight:500;margin-bottom:12px}
.cart-promo__form{display:flex;gap:8px}
.cart-promo__input{flex:1;padding:12px 16px;border:1px solid #e2e8f0;border-radius:10px;font-size:14px;transition:border-color .2s}
.cart-promo__input:focus{outline:none;border-color:#ec4899}
.cart-promo__btn{padding:12px 20px;background:#1e293b;color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;transition:all .2s}
.cart-promo__btn:hover{background:#0f172a}

/* Sidebar */
.cart-sidebar{position:sticky;top:100px;display:flex;flex-direction:column;gap:16px}

/* Summary */
.cart-summary{background:#fff;border:2px solid #e2e8f0;border-radius:20px;padding:24px;box-shadow:0 8px 40px rgba(0,0,0,.08)}
.cart-summary__title{font-size:17px;font-weight:700;color:#1e293b;margin:0 0 20px;padding-bottom:16px;border-bottom:1px solid #f1f5f9}
.cart-summary__rows{display:flex;flex-direction:column;gap:14px;margin-bottom:16px}
.cart-summary__row{display:flex;justify-content:space-between;font-size:14px;color:#64748b}
.cart-summary__row span:last-child{font-weight:500;color:#334155}
.cart-summary__row--savings{color:#10b981}
.cart-summary__row--savings span:last-child{color:#10b981;font-weight:600}
.cart-summary__total{display:flex;justify-content:space-between;align-items:center;font-size:18px;font-weight:700;color:#1e293b;padding:18px 0;border-top:2px solid #f1f5f9;margin-bottom:20px}
.cart-summary__total span:last-child{font-size:22px;color:#ec4899}
.cart-summary__checkout{width:100%;padding:18px;background:linear-gradient(135deg,#ec4899,#be185d);color:#fff;border:none;border-radius:12px;font-size:15px;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:10px;transition:all .3s ease;box-shadow:0 8px 20px rgba(236,72,153,.3);position:relative;overflow:hidden}
.cart-summary__checkout::before{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.2),transparent);transition:left .5s}
.cart-summary__checkout:hover{transform:translateY(-2px);box-shadow:0 12px 30px rgba(236,72,153,.4)}
.cart-summary__checkout:hover::before{left:100%}

/* Suggested products button */
.cart-suggestion-card__btn.cart-suggestion-card__btn--pink{background:linear-gradient(135deg,#ec4899,#be185d) !important;color:#fff !important;border-color:#ec4899 !important}
.cart-suggestion-card__btn.cart-suggestion-card__btn--pink:hover{background:linear-gradient(135deg,#f472b6,#be185d) !important;border-color:#f472b6 !important;color:#fff !important}
.cart-suggestion-card__btn.cart-suggestion-card__btn--pink svg{color:#fff !important}
.cart-summary__payment-methods{margin-top:20px;padding-top:16px;border-top:1px solid #f1f5f9;text-align:center}
.cart-summary__payment-methods>span{display:block;font-size:11px;color:#94a3b8;margin-bottom:12px;text-transform:uppercase;letter-spacing:.5px}
.cart-summary__payment-icons{display:flex;align-items:center;justify-content:center;gap:8px;flex-wrap:wrap}
.payment-icon{width:44px;height:28px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:6px;display:flex;align-items:center;justify-content:center;transition:all .2s}
.payment-icon:hover{border-color:#cbd5e1;transform:translateY(-1px)}
.payment-icon svg{width:32px;height:20px}

/* Trust Badges */
.cart-trust{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:20px;display:flex;flex-direction:column;gap:14px}
.cart-trust__item{display:flex;align-items:center;gap:14px;padding:10px 12px;background:#f8fafc;border-radius:10px;transition:all .2s}
.cart-trust__item:hover{background:#fdf2f8}
.cart-trust__item svg{color:#ec4899;flex-shrink:0;width:20px;height:20px}
.cart-trust__item div{flex:1}
.cart-trust__item strong{display:block;font-size:13px;color:#1e293b;margin-bottom:1px}
.cart-trust__item span{font-size:11px;color:#64748b}

/* Support */
.cart-support{background:linear-gradient(135deg,#0f172a,#1e3a5f);border-radius:16px;padding:20px;display:flex;align-items:center;gap:16px;color:#fff}
.cart-support__icon{width:56px;height:56px;background:rgba(255,255,255,.1);border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.cart-support__icon svg{color:#fff}
.cart-support__content strong{display:block;font-size:14px;margin-bottom:4px}
.cart-support__content p{font-size:12px;opacity:.8;margin:0 0 8px}
.cart-support__phone{color:#ec4899;font-size:15px;font-weight:600;text-decoration:none}

/* Suggestions */
.cart-suggestions{margin-top:48px;padding-top:48px;border-top:1px solid #e2e8f0}
.cart-suggestions__header{text-align:center;margin-bottom:32px}
.cart-suggestions__title{font-size:24px;font-weight:700;color:#1e293b;margin:0 0 8px}
.cart-suggestions__subtitle{font-size:14px;color:#64748b;margin:0}
.cart-suggestions__grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.cart-suggestions__grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:480px){.cart-suggestions__grid{grid-template-columns:1fr}}
.cart-suggestion-card{position:relative;background:#fff;border:1px solid #e2e8f0;border-radius:16px;overflow:hidden;text-decoration:none;transition:all .3s ease}
.cart-suggestion-card:hover{border-color:#cbd5e1;box-shadow:0 12px 30px rgba(0,0,0,.1);transform:translateY(-4px)}
.cart-suggestion-card__badge{position:absolute;top:12px;left:12px;background:linear-gradient(135deg,#ec4899,#be185d);color:#fff;font-size:11px;font-weight:700;padding:4px 10px;border-radius:6px;z-index:1}
.cart-suggestion-card__image{aspect-ratio:1;overflow:hidden;background:#f8fafc}
.cart-suggestion-card__image img{width:100%;height:100%;object-fit:cover;transition:transform .4s ease}
.cart-suggestion-card:hover .cart-suggestion-card__image img{transform:scale(1.08)}
.cart-suggestion-card__content{padding:16px}
.cart-suggestion-card__name{font-size:14px;font-weight:600;color:#1e293b;margin:0 0 8px}
.cart-suggestion-card__prices{display:flex;align-items:baseline;gap:8px;margin-bottom:12px}
.cart-suggestion-card__price{font-size:16px;font-weight:700;color:#ec4899}
.cart-suggestion-card__old{font-size:12px;color:#94a3b8;text-decoration:line-through}
.cart-suggestion-card__btn{width:100%;padding:10px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;font-size:13px;font-weight:600;color:#1e293b;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:6px;transition:all .2s}
.cart-suggestion-card__btn:hover{background:#ec4899;border-color:#ec4899;color:#fff}

/* Empty Cart */
.cart-empty{text-align:center;padding:80px 20px;max-width:400px;margin:0 auto}
.cart-empty__icon{color:#e2e8f0;margin-bottom:24px}
.cart-empty__title{font-size:24px;font-weight:700;color:#1e293b;margin:0 0 12px}
.cart-empty__text{font-size:15px;color:#64748b;margin:0 0 32px;line-height:1.6}
.cart-empty__btn{display:inline-flex;align-items:center;gap:10px;padding:16px 32px;background:linear-gradient(135deg,#ec4899,#be185d);color:#fff;border-radius:12px;font-size:15px;font-weight:600;text-decoration:none;transition:all .3s ease;box-shadow:0 8px 20px rgba(236,72,153,.3)}
.cart-empty__btn:hover{transform:translateY(-2px);box-shadow:0 12px 30px rgba(236,72,153,.4);color:#fff}

/* Responsive */
@media(max-width:768px){
    .cart-header__title{font-size:22px}
    .cart-progress__step span{display:none}
    .cart-item{flex-direction:column;gap:16px}
    .cart-item__image{width:100%;height:180px}
    .cart-item__actions{flex-direction:column;align-items:stretch;gap:12px}
    .cart-item__prices{text-align:left}
    .cart-sidebar{position:static}
}
</style>
@endpush
