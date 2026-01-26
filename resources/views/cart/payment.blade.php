@extends('layouts.front')

@section('title', 'Paiement')
@section('meta_description', 'Finalisez votre paiement en toute sécurité sur Mobilier Addict.')

@section('content')
<div class="cart-page">
    <!-- Progress Steps -->
    <div class="cart-progress">
        <div class="container">
            <div class="cart-progress__steps">
                <div class="cart-progress__step cart-progress__step--completed">
                    <div class="cart-progress__icon">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" fill="currentColor"/></svg>
                    </div>
                    <span>Panier</span>
                </div>
                <div class="cart-progress__line cart-progress__line--completed"></div>
                <div class="cart-progress__step cart-progress__step--completed">
                    <div class="cart-progress__icon">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" fill="currentColor"/></svg>
                    </div>
                    <span>Livraison</span>
                </div>
                <div class="cart-progress__line cart-progress__line--completed"></div>
                <div class="cart-progress__step cart-progress__step--active">
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
                <h1 class="cart-header__title">Paiement</h1>
                <p class="cart-header__count">Choisissez votre mode de paiement</p>
            </div>
            <a href="{{ route('cart.shipping') }}" class="cart-header__continue">
                <svg viewBox="0 0 24 24" width="18" height="18"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" fill="currentColor"/></svg>
                Modifier la livraison
            </a>
        </div>

        <div class="cart-layout">
            <!-- Payment Form -->
            <div class="cart-main">
                <form class="checkout-form" action="{{ route('cart.placeOrder') }}" method="POST">
                    @csrf
                    <!-- Payment Methods -->
                    <div class="checkout-section">
                        <h2 class="checkout-section__title">
                            <svg viewBox="0 0 24 24" width="22" height="22"><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" fill="currentColor"/></svg>
                            Mode de paiement
                        </h2>
                        <div class="payment-methods">
                            <label class="payment-method payment-method--selected">
                                <input type="radio" name="payment_method" value="card" checked>
                                <div class="payment-method__content">
                                    <div class="payment-method__icon">
                                        <svg viewBox="0 0 24 24" width="28" height="28"><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" fill="currentColor"/></svg>
                                    </div>
                                    <div class="payment-method__info">
                                        <strong>Carte bancaire</strong>
                                        <span>Visa, Mastercard</span>
                                    </div>
                                    <div class="payment-method__logos">
                                        <svg viewBox="0 0 50 50" width="32" height="20"><path fill="#1A1F71" d="M20.3 35.3l2.6-15.6h4.1l-2.6 15.6h-4.1zm16.9-15.2c-.8-.3-2.1-.7-3.7-.7-4.1 0-6.9 2.1-7 5.1 0 2.2 2 3.4 3.6 4.2 1.6.8 2.1 1.3 2.1 2 0 1.1-1.3 1.6-2.4 1.6-1.6 0-2.5-.2-3.8-.8l-.5-.2-.6 3.4c1 .4 2.7.8 4.5.8 4.3 0 7.1-2.1 7.2-5.3 0-1.8-1.1-3.1-3.4-4.2-1.4-.7-2.3-1.2-2.3-1.9 0-.7.7-1.3 2.3-1.3 1.3 0 2.3.3 3 .6l.4.2.6-3.5z"/></svg>
                                        <svg viewBox="0 0 50 50" width="32" height="20"><circle cx="17" cy="25" r="12" fill="#EB001B"/><circle cx="33" cy="25" r="12" fill="#F79E1B"/><path fill="#FF5F00" d="M25 15.5c3 2.4 5 6 5 10s-2 7.6-5 10c-3-2.4-5-6-5-10s2-7.6 5-10z"/></svg>
                                    </div>
                                </div>
                            </label>
                            <label class="payment-method">
                                <input type="radio" name="payment_method" value="orange_money">
                                <div class="payment-method__content">
                                    <div class="payment-method__icon payment-method__icon--orange">
                                        <span>OM</span>
                                    </div>
                                    <div class="payment-method__info">
                                        <strong>Orange Money</strong>
                                        <span>Paiement mobile</span>
                                    </div>
                                </div>
                            </label>
                            <label class="payment-method">
                                <input type="radio" name="payment_method" value="wave">
                                <div class="payment-method__content">
                                    <div class="payment-method__icon payment-method__icon--wave">
                                        <span>Wave</span>
                                    </div>
                                    <div class="payment-method__info">
                                        <strong>Wave</strong>
                                        <span>Paiement mobile</span>
                                    </div>
                                </div>
                            </label>
                            <label class="payment-method">
                                <input type="radio" name="payment_method" value="cash">
                                <div class="payment-method__content">
                                    <div class="payment-method__icon payment-method__icon--cash">
                                        <svg viewBox="0 0 24 24" width="28" height="28"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z" fill="currentColor"/></svg>
                                    </div>
                                    <div class="payment-method__info">
                                        <strong>Paiement à la livraison</strong>
                                        <span>Espèces</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Card Details (shown when card is selected) -->
                    <div class="checkout-section" id="card-details">
                        <h2 class="checkout-section__title">
                            <svg viewBox="0 0 24 24" width="22" height="22"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z" fill="currentColor"/></svg>
                            Informations de la carte
                        </h2>
                        <div class="checkout-form__grid">
                            <div class="checkout-form__group checkout-form__group--full">
                                <label for="card_number">Numéro de carte *</label>
                                <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" maxlength="19">
                            </div>
                            <div class="checkout-form__group">
                                <label for="card_expiry">Date d'expiration *</label>
                                <input type="text" id="card_expiry" name="card_expiry" placeholder="MM/AA" maxlength="5">
                            </div>
                            <div class="checkout-form__group">
                                <label for="card_cvv">CVV *</label>
                                <input type="text" id="card_cvv" name="card_cvv" placeholder="123" maxlength="4">
                            </div>
                            <div class="checkout-form__group checkout-form__group--full">
                                <label for="card_name">Nom sur la carte *</label>
                                <input type="text" id="card_name" name="card_name" placeholder="JEAN DUPONT">
                            </div>
                        </div>
                    </div>

                    <!-- Billing Address -->
                    <div class="checkout-section">
                        <div class="checkout-checkbox">
                            <input type="checkbox" id="same_address" name="same_address" checked>
                            <label for="same_address">Utiliser la même adresse pour la facturation</label>
                        </div>
                    </div>

                    <div class="checkout-actions">
                        <a href="{{ route('cart.shipping') }}" class="checkout-btn checkout-btn--secondary">
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" fill="currentColor"/></svg>
                            Retour
                        </a>
                        <button type="submit" class="checkout-btn checkout-btn--primary">
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z" fill="currentColor"/></svg>
                            Payer {{ number_format($total, 0, ',', '.') }}F
                        </button>
                    </div>
                </form>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="cart-sidebar">
                <div class="cart-summary">
                    <h2 class="cart-summary__title">Récapitulatif</h2>

                    <div class="order-items-mini">
                        @foreach($cartItems as $item)
                        <div class="order-item-mini">
                            <div class="order-item-mini__image">
                                <img src="{{ $item->image }}" alt="{{ $item->name }}">
                                <span class="order-item-mini__qty">{{ $item->quantity }}</span>
                            </div>
                            <div class="order-item-mini__info">
                                <span class="order-item-mini__name">{{ $item->name }}</span>
                                <span class="order-item-mini__price">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}F</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

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
                </div>

                <!-- Security Badge -->
                <div class="security-badge">
                    <div class="security-badge__icon">
                        <svg viewBox="0 0 24 24" width="32" height="32"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z" fill="currentColor"/></svg>
                    </div>
                    <div class="security-badge__content">
                        <strong>Paiement 100% sécurisé</strong>
                        <p>Vos données sont protégées par un cryptage SSL 256-bit</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Checkout Form Styles */
.checkout-section{background:#fff;border:1px solid #e2e8f0;border-radius:20px;padding:24px;margin-bottom:20px;box-shadow:0 4px 20px rgba(0,0,0,.04)}
.checkout-section__title{display:flex;align-items:center;gap:12px;font-size:17px;font-weight:700;color:#1e293b;margin:0 0 20px;padding-bottom:16px;border-bottom:1px solid #f1f5f9}
.checkout-section__title svg{color:#ec4899}
.checkout-form__grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px}
.checkout-form__group{display:flex;flex-direction:column;gap:6px}
.checkout-form__group--full{grid-column:1/-1}
.checkout-form__group label{font-size:13px;font-weight:600;color:#334155}
.checkout-form__group input{padding:14px 16px;border:1px solid #e2e8f0;border-radius:10px;font-size:14px;transition:all .2s;font-family:inherit}
.checkout-form__group input:focus{outline:none;border-color:#ec4899;box-shadow:0 0 0 3px rgba(236,72,153,.1)}
.checkout-form__group input::placeholder{color:#94a3b8}

/* Payment Methods */
.payment-methods{display:flex;flex-direction:column;gap:12px}
.payment-method{display:flex;align-items:center;gap:14px;padding:18px 20px;border:2px solid #e2e8f0;border-radius:14px;cursor:pointer;transition:all .2s}
.payment-method:hover{border-color:#cbd5e1}
.payment-method--selected,.payment-method:has(input:checked){border-color:#ec4899;background:#fdf2f8}
.payment-method input{width:20px;height:20px;accent-color:#ec4899;flex-shrink:0}
.payment-method__content{flex:1;display:flex;align-items:center;gap:16px}
.payment-method__icon{width:48px;height:48px;background:#f1f5f9;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#64748b}
.payment-method__icon--orange{background:#ff6600;color:#fff;font-weight:700;font-size:14px}
.payment-method__icon--wave{background:#1dc8f2;color:#fff;font-weight:700;font-size:11px}
.payment-method__icon--cash{background:#10b981;color:#fff}
.payment-method__info{flex:1}
.payment-method__info strong{display:block;font-size:15px;color:#1e293b;margin-bottom:2px}
.payment-method__info span{font-size:13px;color:#64748b}
.payment-method__logos{display:flex;gap:8px}

/* Checkout Actions */
.checkout-actions{display:flex;gap:16px;margin-top:24px}
.checkout-btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;padding:16px 28px;border-radius:12px;font-size:15px;font-weight:600;cursor:pointer;transition:all .3s;text-decoration:none;border:none}
.checkout-btn--primary{flex:1;background:linear-gradient(135deg,#10b981,#059669);color:#fff;box-shadow:0 8px 20px rgba(16,185,129,.3)}
.checkout-btn--primary:hover{transform:translateY(-2px);box-shadow:0 12px 30px rgba(16,185,129,.4)}
.checkout-btn--secondary{background:#f1f5f9;color:#64748b}
.checkout-btn--secondary:hover{background:#e2e8f0;color:#334155}

/* Order Items Mini */
.order-items-mini{display:flex;flex-direction:column;gap:12px;margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid #f1f5f9}
.order-item-mini{display:flex;align-items:center;gap:12px}
.order-item-mini__image{position:relative;width:50px;height:50px;border-radius:8px;overflow:hidden;background:#f8fafc;flex-shrink:0}
.order-item-mini__image img{width:100%;height:100%;object-fit:cover}
.order-item-mini__qty{position:absolute;top:-4px;right:-4px;width:20px;height:20px;background:#ec4899;color:#fff;font-size:11px;font-weight:700;border-radius:50%;display:flex;align-items:center;justify-content:center}
.order-item-mini__info{flex:1;display:flex;flex-direction:column;gap:2px}
.order-item-mini__name{font-size:13px;color:#334155;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.order-item-mini__price{font-size:13px;font-weight:600;color:#1e293b}

/* Checkbox */
.checkout-checkbox{display:flex;align-items:center;gap:12px}
.checkout-checkbox input{width:20px;height:20px;accent-color:#ec4899}
.checkout-checkbox label{font-size:14px;color:#334155;cursor:pointer}

/* Security Badge */
.security-badge{background:linear-gradient(135deg,#10b981,#059669);border-radius:16px;padding:20px;display:flex;align-items:center;gap:16px;color:#fff}
.security-badge__icon svg{color:#fff}
.security-badge__content strong{display:block;font-size:14px;margin-bottom:4px}
.security-badge__content p{font-size:12px;opacity:.9;margin:0}

/* Progress completed state */
.cart-progress__step--completed{color:#10b981}
.cart-progress__step--completed .cart-progress__icon{background:#10b981;color:#fff}
.cart-progress__line--completed{background:#10b981}

@media(max-width:768px){
    .checkout-form__grid{grid-template-columns:1fr}
    .checkout-form__group--full{grid-column:1}
    .checkout-actions{flex-direction:column-reverse}
    .payment-method__logos{display:none}
}
</style>
@endpush
