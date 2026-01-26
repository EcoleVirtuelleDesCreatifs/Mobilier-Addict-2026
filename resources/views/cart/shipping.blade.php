@extends('layouts.front')

@section('title', 'Livraison')
@section('meta_description', 'Choisissez votre adresse de livraison sur Mobilier Addict.')

@section('content')
<div style="position:fixed;left:10px;bottom:10px;z-index:99999;background:#0b1220;color:#fff;padding:8px 10px;border-radius:10px;font-weight:900;font-size:12px;box-shadow:0 18px 40px rgba(0,0,0,.25)">SHIP-VIEW-MARKER v1</div>
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
                <div class="cart-progress__step cart-progress__step--active">
                    <div class="cart-progress__icon">
                        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="currentColor"/></svg>
                    </div>
                    <span>Livraison</span>
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
        <div class="checkout-hero">
            <div class="checkout-hero__top">
                <div>
                    <h1 class="checkout-hero__title">Adresse de livraison</h1>
                    <p class="checkout-hero__subtitle">Finalisez votre commande en moins de 1 minute. <span style="color:var(--m-muted);font-size:11px">(v-ship-0125)</span></p>
                </div>
                <a href="{{ route('cart.index') }}" class="checkout-hero__back">
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" fill="currentColor"/></svg>
                    Retour au panier
                </a>
            </div>
            <div class="checkout-hero__pills">
                <div class="trust-pill">
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z" fill="currentColor"/></svg>
                    Paiement 100% sécurisé
                </div>
                <div class="trust-pill">
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M20 8l3 4v5h-2a3 3 0 1 1-6 0H9a3 3 0 1 1-6 0H1V6a2 2 0 0 1 2-2h14v4h3zm-3 4h3.46L19 9.5H17V12z" fill="currentColor"/></svg>
                    Livraison rapide 24-48h
                </div>
                <div class="trust-pill trust-pill--accent">
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M20 15.5c-1.25 0-2.45-.2-3.57-.57-.35-.11-.74-.03-1.02.24l-2.2 2.2c-2.83-1.44-5.15-3.75-6.59-6.59l2.2-2.21c.28-.26.36-.65.25-1C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1zM19 12h2c0-4.97-4.03-9-9-9v2c3.87 0 7 3.13 7 7zm-4 0h2c0-2.76-2.24-5-5-5v2c1.66 0 3 1.34 3 3z" fill="currentColor"/></svg>
                    Assistance WhatsApp
                </div>
            </div>
        </div>

        <div class="cart-layout">
            <!-- Shipping Form -->
            <div class="cart-main">
                <form class="checkout-form" action="{{ route('cart.shipping.store') }}" method="POST">
                    @csrf
                    <!-- Shipping Fields -->
                    <div class="checkout-section">
                        <h2 class="checkout-section__title">
                            <svg viewBox="0 0 24 24" width="22" height="22"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="currentColor"/></svg>
                            Informations de livraison
                        </h2>
                        <div class="checkout-form__grid">
                            <div class="checkout-form__group">
                                <label for="lastname">Nom *</label>
                                <input type="text" id="lastname" name="lastname" required placeholder="Votre nom">
                            </div>
                            <div class="checkout-form__group">
                                <label for="firstnames">Prénoms *</label>
                                <input type="text" id="firstnames" name="firstnames" required placeholder="Vos prénoms">
                            </div>
                            <div class="checkout-form__group">
                                <label for="whatsapp">Numéro WhatsApp *</label>
                                <input type="tel" id="whatsapp" name="whatsapp" required placeholder="+225 07 00 00 00 00">
                                <small class="field-help">Nous confirmons votre commande et votre livraison via WhatsApp.</small>
                            </div>
                            <div class="checkout-form__group">
                                <label for="phone">Numéro Téléphone</label>
                                <input type="tel" id="phone" name="phone" placeholder="+225 07 00 00 00 00">
                                <small class="field-help">Optionnel (si différent de WhatsApp).</small>
                            </div>
                            <div class="checkout-form__group checkout-form__group--full">
                                <label for="delivery_place">Lieu de livraison *</label>
                                <input type="text" id="delivery_place" name="delivery_place" required placeholder="Ex: Cocody Angré, Abidjan">
                            </div>
                            <div class="checkout-form__group checkout-form__group--full">
                                <label for="delivery_day">Jour de livraison souhaité</label>
                                <div class="date-field">
                                    <input type="date" id="delivery_day" name="delivery_day" class="date-field__input">
                                    <span class="date-field__icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z" fill="currentColor"/></svg>
                                    </span>
                                </div>
                            </div>
                            <div class="checkout-form__group checkout-form__group--full">
                                <label for="details">Détails supplémentaires</label>
                                <textarea id="details" name="details" rows="4" placeholder="Précisions sur la commande, couleur, taille, etc."></textarea>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="shipping_method" value="standard">

                    <div class="checkout-actions">
                        <a href="{{ route('cart.index') }}" class="checkout-btn checkout-btn--secondary">
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" fill="currentColor"/></svg>
                            Retour
                        </a>
                        <button type="submit" class="checkout-btn checkout-btn--primary">
                            Continuer vers le paiement
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" fill="currentColor"/></svg>
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
                            <span id="shippingCost" data-base-shipping="{{ $shipping }}">{{ $shipping > 0 ? number_format($shipping, 0, ',', '.') . 'F' : 'Gratuite' }}</span>
                        </div>
                    </div>

                    <div class="cart-summary__total">
                        <span>Total</span>
                        <span id="orderTotal" data-base-total="{{ $total }}" data-subtotal="{{ $subtotal }}">{{ number_format($total, 0, ',', '.') }}F</span>
                    </div>

                    <div class="sidebar-cta">
                        <button type="button" class="sidebar-cta__btn" id="sidebarContinue">
                            Continuer vers le paiement
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" fill="currentColor"/></svg>
                        </button>
                        <div class="sidebar-cta__hint">En cliquant, vous passez à l'étape de paiement.</div>
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
                </div>

                <div class="cart-support">
                    <div class="cart-support__icon">
                        <svg viewBox="0 0 24 24" width="32" height="32"><path d="M20 15.5c-1.25 0-2.45-.2-3.57-.57-.35-.11-.74-.03-1.02.24l-2.2 2.2c-2.83-1.44-5.15-3.75-6.59-6.59l2.2-2.21c.28-.26.36-.65.25-1C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1zM19 12h2c0-4.97-4.03-9-9-9v2c3.87 0 7 3.13 7 7zm-4 0h2c0-2.76-2.24-5-5-5v2c1.66 0 3 1.34 3 3z" fill="currentColor"/></svg>
                    </div>
                    <div class="cart-support__content">
                        <strong>Besoin d'aide ?</strong>
                        <p>Notre équipe répond rapidement sur WhatsApp</p>
                        <a href="tel:+2250799140356" class="cart-support__phone">📞 +225 0799140356</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mobile-cta" aria-hidden="false">
    <div class="mobile-cta__inner">
        <div class="mobile-cta__total">
            <span>Total</span>
            <strong id="mobileOrderTotal">{{ number_format($total, 0, ',', '.') }}F</strong>
        </div>
        <button type="button" class="mobile-cta__btn" id="mobileContinue">
            Continuer
            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" fill="currentColor"/></svg>
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.checkout-form');
    const sidebarBtn = document.getElementById('sidebarContinue');
    const mobileBtn = document.getElementById('mobileContinue');
    const shippingCostEl = document.getElementById('shippingCost');
    const totalEl = document.getElementById('orderTotal');
    const mobileTotalEl = document.getElementById('mobileOrderTotal');
    const deliveryDay = document.getElementById('delivery_day');

    const fmt = (amount) => {
        if (amount === 0) return 'Gratuite';
        return new Intl.NumberFormat('fr-FR').format(amount) + 'F';
    };

    const setMinDateToday = () => {
        if (!deliveryDay) return;
        const d = new Date();
        const yyyy = d.getFullYear();
        const mm = String(d.getMonth() + 1).padStart(2, '0');
        const dd = String(d.getDate()).padStart(2, '0');
        deliveryDay.min = `${yyyy}-${mm}-${dd}`;
    };

    const updateTotals = () => {
        if (!shippingCostEl || !totalEl || !mobileTotalEl) return;

        const baseShipping = Number(shippingCostEl.dataset.baseShipping || 0);
        const subtotal = Number(totalEl.dataset.subtotal || 0);

        const selected = document.querySelector('input[name="shipping_method"]:checked');
        const method = selected ? selected.value : 'standard';

        let shipping = baseShipping;
        if (method === 'pickup') shipping = 0;
        if (method === 'express') shipping = 5000;
        if (method === 'standard') shipping = baseShipping;

        const total = subtotal + shipping;

        shippingCostEl.textContent = fmt(shipping);
        totalEl.textContent = new Intl.NumberFormat('fr-FR').format(total) + 'F';
        mobileTotalEl.textContent = new Intl.NumberFormat('fr-FR').format(total) + 'F';
    };

    const submitForm = () => {
        if (!form) return;
        if (typeof form.requestSubmit === 'function') {
            form.requestSubmit();
        } else {
            form.submit();
        }
    };

    sidebarBtn?.addEventListener('click', submitForm);
    mobileBtn?.addEventListener('click', submitForm);

    document.querySelectorAll('input[name="shipping_method"]').forEach((el) => {
        el.addEventListener('change', updateTotals);
    });

    setMinDateToday();
    updateTotals();
});
</script>
@endpush

@push('styles')
<style>
/* Minimal theme (Mobilier Addict accents) */
:root{--m-text:#0b1220;--m-muted:#5b6b82;--m-border:rgba(15,23,42,.10);--m-bg:#ffffff;--m-soft:#f6f7fb;--m-rose:#ec4899;--m-rose-2:#be185d;--m-blue:#1e3a5f;--m-blue-2:#0b1220}

/* Page layout + Progress */
.cart-page{background:radial-gradient(1200px 500px at 50% -10%, rgba(236,72,153,.10), transparent 60%),radial-gradient(900px 500px at 85% 10%, rgba(30,58,95,.10), transparent 60%),var(--m-soft)}
.cart-page .container{max-width:1180px}
.cart-page .container{padding-left:18px;padding-right:18px}
.cart-progress{background:var(--m-bg);border-bottom:1px solid var(--m-border);padding:14px 0;position:sticky;top:0;z-index:20}
.cart-progress__steps{display:flex;align-items:center;justify-content:center;gap:10px;max-width:760px;margin:0 auto}
.cart-progress__step{display:flex;align-items:center;gap:10px;color:var(--m-muted);font-size:13px;font-weight:700;letter-spacing:.2px}
.cart-progress__icon{width:36px;height:36px;border-radius:999px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;color:var(--m-muted)}
.cart-progress__line{flex:1;height:2px;background:#e2e8f0;max-width:70px;border-radius:999px}
.cart-progress__step--active{color:var(--m-text)}
.cart-progress__step--active .cart-progress__icon{background:linear-gradient(135deg,var(--m-rose),var(--m-rose-2));color:#fff}
.cart-progress__step--completed{color:var(--m-text)}
.cart-progress__step--completed .cart-progress__icon{background:linear-gradient(135deg,var(--m-blue),var(--m-blue-2));color:#fff}
.cart-progress__line--completed{background:linear-gradient(90deg,var(--m-blue),var(--m-blue-2))}

/* Main grid */
.cart-page .cart-layout{display:grid !important;grid-template-columns:minmax(0,1fr) 420px !important;gap:32px;align-items:start;margin:16px 0 64px}
.cart-main{min-width:0}
.cart-sidebar{position:sticky;top:92px;display:flex;flex-direction:column;gap:16px}

/* Sidebar cards */
.cart-summary{background:rgba(255,255,255,.92);backdrop-filter:blur(10px);border:1px solid rgba(15,23,42,.10);border-radius:20px;padding:20px;box-shadow:0 16px 40px rgba(2,6,23,.08)}
.cart-summary__title{font-size:15px;font-weight:800;color:var(--m-text);margin:0 0 14px;padding-bottom:12px;border-bottom:1px solid rgba(15,23,42,.06)}
.cart-summary__rows{display:flex;flex-direction:column;gap:12px;margin-top:12px}
.cart-summary__row{display:flex;justify-content:space-between;font-size:13px;color:var(--m-muted)}
.cart-summary__row span:last-child{font-weight:700;color:var(--m-text)}
.cart-summary__row--savings{color:#10b981}
.cart-summary__row--savings span:last-child{color:#10b981}
.cart-summary__total{display:flex;justify-content:space-between;align-items:center;padding:14px 0 0;margin-top:10px;border-top:1px solid rgba(15,23,42,.08);font-size:14px;font-weight:900;color:var(--m-text)}
.cart-summary__total span:last-child{font-size:18px;color:var(--m-rose)}

.sidebar-cta{margin-top:16px}
.sidebar-cta__btn{width:100%;border:none;border-radius:14px;padding:14px 16px;font-weight:900;color:#fff;background:linear-gradient(135deg,var(--m-rose),var(--m-rose-2));box-shadow:0 14px 34px rgba(236,72,153,.28);display:flex;align-items:center;justify-content:center;gap:10px;transition:transform .2s ease, box-shadow .2s ease}
.sidebar-cta__btn:hover{transform:translateY(-1px);box-shadow:0 18px 44px rgba(236,72,153,.38)}
.sidebar-cta__hint{margin-top:10px;font-size:12px;color:var(--m-muted);text-align:center}

.cart-trust{background:rgba(255,255,255,.92);backdrop-filter:blur(10px);border:1px solid rgba(15,23,42,.10);border-radius:20px;padding:18px;display:flex;flex-direction:column;gap:14px;box-shadow:0 16px 40px rgba(2,6,23,.06)}
.cart-trust__item{display:flex;align-items:center;gap:12px;padding:12px 12px;background:#f8fafc;border-radius:14px}
.cart-trust__item svg{color:#ec4899;flex-shrink:0;width:20px;height:20px}
.cart-trust__item strong{display:block;font-size:13px;color:#0f172a;margin-bottom:2px}
.cart-trust__item span{font-size:11px;color:#64748b}

/* Responsive */
@media(max-width:992px){
  .cart-page .cart-layout{grid-template-columns:1fr !important}
  .cart-sidebar{position:static}
}
@media(max-width:768px){
  .cart-layout{grid-template-columns:1fr}
  .cart-sidebar{position:static}
  .cart-progress{position:relative;top:auto}
  .cart-progress__step span{display:none}
  .cart-progress__line{max-width:40px}
}

/* Checkout Form Styles */
.checkout-section{background:rgba(255,255,255,.92);backdrop-filter:blur(10px);border:1px solid rgba(15,23,42,.10);border-radius:20px;padding:22px;margin-bottom:16px;box-shadow:0 16px 40px rgba(2,6,23,.06);opacity:1;position:relative;overflow:hidden}
.checkout-section:nth-child(1){animation-delay:.1s}
.checkout-section:nth-child(2){animation-delay:.2s}
.checkout-section:nth-child(3){animation-delay:.3s}
.checkout-section::before{content:none}
.checkout-section:hover::before{opacity:0}
.checkout-section__title{display:flex;align-items:center;gap:12px;font-size:15px;font-weight:900;color:var(--m-text);margin:0 0 16px;padding-bottom:12px;border-bottom:1px solid rgba(15,23,42,.06)}
.checkout-section__title svg{color:var(--m-blue);padding:0;background:none;border-radius:0;width:22px;height:22px}
.checkout-form__grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px}
.checkout-form__group{display:flex;flex-direction:column;gap:8px;position:relative}
.checkout-form__group--full{grid-column:1/-1}
.checkout-form__group label{font-size:13px;font-weight:800;color:var(--m-text);display:flex;align-items:center;gap:6px}
.checkout-form__group label::before{content:'';width:6px;height:6px;background:#ec4899;border-radius:50%;opacity:.5}
.field-help{font-size:12px;color:#64748b;margin-top:2px}
.checkout-form__group input,.checkout-form__group textarea{padding:14px 16px;border:1px solid rgba(15,23,42,.14);border-radius:14px;font-size:14px;transition:border-color .2s ease, box-shadow .2s ease;font-family:inherit;background:#fff}
.checkout-form__group input:hover,.checkout-form__group textarea:hover{border-color:rgba(15,23,42,.22)}
.checkout-form__group input:focus,.checkout-form__group textarea:focus{outline:none;border-color:rgba(236,72,153,.55);box-shadow:0 0 0 4px rgba(236,72,153,.10);background:#fff;transform:none}
.checkout-form__group input::placeholder,.checkout-form__group textarea::placeholder{color:#94a3b8}
.checkout-form__group input:valid:not(:placeholder-shown){border-color:#10b981;background:linear-gradient(135deg,#f0fdf4,#dcfce7)}

/* Actions */
.checkout-actions{display:flex;gap:12px;justify-content:space-between;align-items:center;margin-top:18px}
.checkout-btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;border-radius:14px;padding:14px 16px;font-weight:900;text-decoration:none;border:1px solid rgba(15,23,42,.10);transition:transform .2s ease, box-shadow .2s ease}
.checkout-btn--secondary{background:#fff;color:var(--m-text)}
.checkout-btn--secondary:hover{transform:translateY(-1px);box-shadow:0 10px 24px rgba(2,6,23,.08)}
.checkout-btn--primary{border:none;color:#fff;background:linear-gradient(135deg,var(--m-rose),var(--m-rose-2));box-shadow:0 14px 34px rgba(236,72,153,.28)}
.checkout-btn--primary:hover{transform:translateY(-1px);box-shadow:0 18px 44px rgba(236,72,153,.38)}

/* Date field */
.date-field{position:relative}
.date-field__input{width:100%;padding-right:48px}
.date-field__icon{position:absolute;right:16px;top:50%;transform:translateY(-50%);color:#94a3b8;pointer-events:none}
.date-field__input::-webkit-calendar-picker-indicator{opacity:0;position:absolute;right:0;top:0;bottom:0;width:48px;cursor:pointer}

/* Hero */
.checkout-hero{margin:18px 0 18px;padding:18px 20px;border-radius:22px;background:rgba(255,255,255,.92);backdrop-filter:blur(10px);border:1px solid rgba(15,23,42,.10);box-shadow:0 16px 40px rgba(2,6,23,.06)}
.checkout-hero__top{display:flex;align-items:flex-start;justify-content:space-between;gap:16px}
.checkout-hero__title{font-size:26px;font-weight:800;color:var(--m-text);margin:0}
.checkout-hero__subtitle{margin:6px 0 0;color:var(--m-muted);font-size:13px}
.checkout-hero__back{display:inline-flex;align-items:center;gap:10px;padding:12px 14px;border-radius:14px;background:#fff;border:1px solid rgba(15,23,42,.10);color:#334155;text-decoration:none;transition:all .25s}
.checkout-hero__back:hover{transform:none;box-shadow:none;border-color:rgba(30,58,95,.35)}
.checkout-hero__pills{margin-top:14px;display:flex;flex-wrap:wrap;gap:10px}
.trust-pill{display:inline-flex;align-items:center;gap:8px;padding:8px 10px;border-radius:999px;background:#fff;border:1px solid rgba(15,23,42,.10);color:var(--m-text);font-size:12px;font-weight:700}
.trust-pill svg{color:var(--m-blue)}
.trust-pill--accent{background:#fff;border-color:rgba(15,23,42,.10);color:var(--m-text)}
.trust-pill--accent svg{color:var(--m-muted)}

/* Support */
.cart-support{margin-top:16px;background:rgba(255,255,255,.92);backdrop-filter:blur(10px);border:1px solid rgba(15,23,42,.10);border-radius:20px;padding:16px;display:flex;align-items:center;gap:14px;color:var(--m-text);box-shadow:0 16px 40px rgba(2,6,23,.06)}
.cart-support__icon{width:52px;height:52px;background:linear-gradient(135deg, rgba(236,72,153,.14), rgba(190,24,93,.10));border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.cart-support__icon svg{color:var(--m-rose-2)}
.cart-support__content strong{display:block;font-size:14px;margin-bottom:4px;font-weight:900}
.cart-support__content p{font-size:12px;color:var(--m-muted);margin:0 0 8px}
.cart-support__phone{color:var(--m-rose);font-size:14px;font-weight:900;text-decoration:none}

/* Mobile CTA */
.mobile-cta{position:fixed;left:0;right:0;bottom:0;background:rgba(255,255,255,.86);backdrop-filter:saturate(180%) blur(14px);border-top:1px solid rgba(15,23,42,.10);padding:12px 14px;z-index:50;display:none}
.mobile-cta__inner{max-width:980px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:12px}
.mobile-cta__total span{display:block;font-size:12px;color:#64748b}
.mobile-cta__total strong{display:block;font-size:16px;color:#0f172a}
.mobile-cta__btn{flex-shrink:0;border:none;border-radius:14px;padding:14px 16px;background:linear-gradient(135deg,var(--m-rose),var(--m-rose-2));color:#fff;font-weight:800;display:inline-flex;align-items:center;gap:10px;box-shadow:none}

@media(max-width:1024px){
  .mobile-cta{display:block}
  body{padding-bottom:84px}
}

@media(max-width:1024px){
  .checkout-hero__top{flex-direction:column}
  .checkout-hero__back{width:fit-content}
}

@media(min-width:993px){
  .cart-main{padding-right:2px}
  .cart-sidebar{padding-left:2px}
}

/* Shipping Options (minimal) */
.shipping-options{display:flex;flex-direction:column;gap:12px}
.shipping-option{display:flex;align-items:center;gap:14px;padding:16px;border:1px solid rgba(15,23,42,.14);border-radius:16px;cursor:pointer;transition:border-color .2s ease, background-color .2s ease;position:relative;background:#fff}
.shipping-option:hover{border-color:rgba(15,23,42,.24);background:#fff}
.shipping-option:has(input:checked){border-color:rgba(15,23,42,.45);background:#fff}
.shipping-option input{width:20px;height:20px;accent-color:var(--m-rose)}
.shipping-option__icon{width:44px;height:44px;background:#f1f5f9;border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--m-text);flex-shrink:0}
.shipping-option__content{flex:1;display:flex;align-items:center;justify-content:space-between}
.shipping-option__info strong{display:block;font-size:14px;color:var(--m-text);margin-bottom:2px;font-weight:800}
.shipping-option__info span{font-size:12px;color:var(--m-muted)}
.shipping-option__price{font-size:14px;font-weight:800;color:var(--m-text);padding:6px 10px;background:#f8fafc;border-radius:10px}
.shipping-option__price--free{color:var(--m-text);background:#f8fafc}

/* Checkout Actions */
.checkout-actions{display:flex;gap:16px;margin-top:24px;opacity:1}
.checkout-btn{display:inline-flex;align-items:center;justify-content:center;gap:12px;padding:18px 32px;border-radius:16px;font-size:16px;font-weight:700;cursor:pointer;transition:all .3s cubic-bezier(.4,0,.2,1);text-decoration:none;border:none;position:relative;overflow:hidden}
.checkout-btn--primary{flex:1;background:linear-gradient(135deg,var(--m-rose),var(--m-rose-2));color:#fff;box-shadow:none}
.checkout-btn--primary::before{content:none}
.checkout-btn--primary:hover{transform:translateY(-1px);box-shadow:none;opacity:.92}
.checkout-btn--primary:hover::before{left:0}
.checkout-btn--secondary{background:#fff;color:var(--m-text);border:1px solid rgba(15,23,42,.14)}
.checkout-btn--secondary:hover{background:#fff;color:var(--m-text);border-color:rgba(15,23,42,.22);transform:none}

/* Order Items Mini */
.order-items-mini{display:flex;flex-direction:column;gap:12px;margin-bottom:18px;padding-bottom:16px;border-bottom:1px solid rgba(15,23,42,.08)}
.order-item-mini{display:flex;align-items:center;gap:12px;padding:10px;background:#f8fafc;border-radius:14px}
.order-item-mini:hover{background:#f8fafc;transform:none}
.order-item-mini__image{position:relative;width:56px;height:56px;border-radius:12px;overflow:hidden;background:#fff;flex-shrink:0;box-shadow:0 4px 12px rgba(0,0,0,.08)}
.order-item-mini__image img{width:100%;height:100%;object-fit:cover}
.order-item-mini__qty{position:absolute;top:-6px;right:-6px;width:22px;height:22px;background:var(--m-text);color:#fff;font-size:11px;font-weight:800;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:none}
.order-item-mini__info{flex:1;display:flex;align-items:center;justify-content:space-between;gap:12px}
.order-item-mini__name{font-size:14px;color:#334155;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;min-width:0}
.order-item-mini__price{font-size:13px;font-weight:800;color:var(--m-text)}

/* Remove legacy non-minimal blocks */
.delivery-estimate{animation:none}

@media(max-width:768px){
    .checkout-form__grid{grid-template-columns:1fr}
    .checkout-form__group--full{grid-column:1}
    .checkout-actions{flex-direction:column-reverse}
    .shipping-option{padding:16px}
    .checkout-section{padding:20px}
}
</style>
@endpush
