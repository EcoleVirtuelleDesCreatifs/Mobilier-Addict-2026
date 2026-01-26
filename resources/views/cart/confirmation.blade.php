@extends('layouts.front')

@section('title', 'Commande confirmée')
@section('meta_description', 'Votre commande a été confirmée. Merci pour votre achat sur Mobilier Addict.')

@section('content')
<div class="cart-page">
    <div class="container">
        <!-- Success Message -->
        <div class="confirmation-hero">
            <div class="confirmation-hero__content">
                <div class="confirmation-hero__badge" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="34" height="34"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" fill="currentColor"/></svg>
                </div>
                <div class="confirmation-hero__text">
                    <h1 class="confirmation-hero__title">Commande confirmée</h1>
                    <p class="confirmation-hero__subtitle">Merci pour votre commande. Notre équipe vous contactera sur WhatsApp pour la livraison.</p>
                    <div class="confirmation-hero__meta">
                        <div class="confirmation-meta">
                            <span>Numéro de commande</span>
                            <strong>#CMD-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong>
                        </div>
                        <div class="confirmation-meta">
                            <span>Total</span>
                            <strong>{{ number_format($total, 0, ',', '.') }}F</strong>
                        </div>
                        <div class="confirmation-meta">
                            <span>Livraison</span>
                            <strong>{{ $shipping > 0 ? number_format($shipping, 0, ',', '.') . 'F' : 'Gratuite' }}</strong>
                        </div>
                    </div>
                    <div class="confirmation-hero__actions">
                        <a href="{{ route('home') }}" class="confirmation-action confirmation-action--primary">
                            Continuer mes achats
                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" fill="currentColor"/></svg>
                        </a>
                        <a href="{{ route('cart.index') }}" class="confirmation-action confirmation-action--secondary">
                            Retour au panier
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="confirmation-layout">
            <!-- Order Details -->
            <div class="confirmation-main">
                <!-- Order Summary -->
                <div class="confirmation-section">
                    <h2 class="confirmation-section__title">
                        <svg viewBox="0 0 24 24" width="22" height="22"><path d="M17 18c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm0-3l1.1-2h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1v2h2l3.6 7.59L3.62 17H19v-2H7z" fill="currentColor"/></svg>
                        Articles commandés
                    </h2>
                    <div class="confirmation-items">
                        @foreach($cartItems as $item)
                        <div class="confirmation-item">
                            <div class="confirmation-item__image">
                                @if($item->image)
                                <img src="{{ $item->image }}" alt="{{ $item->name }}">
                                @endif
                            </div>
                            <div class="confirmation-item__details">
                                <h3 class="confirmation-item__name">{{ $item->name }}</h3>
                                @if($item->options)
                                <p class="confirmation-item__options">{{ $item->options }}</p>
                                @endif
                                <span class="confirmation-item__qty">Quantité : {{ $item->quantity }}</span>
                            </div>
                            <div class="confirmation-item__price">
                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }}F
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Shipping Info -->
                <div class="confirmation-section">
                    <h2 class="confirmation-section__title">
                        <svg viewBox="0 0 24 24" width="22" height="22"><path d="M18 18.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM19.5 9.5l1.96 2.5H17V9.5h2.5zM6 18.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM20 8l3 4v5h-2c0 1.66-1.34 3-3 3s-3-1.34-3-3H9c0 1.66-1.34 3-3 3s-3-1.34-3-3H1V6c0-1.11.89-2 2-2h14v4h3z" fill="currentColor"/></svg>
                        Livraison
                    </h2>
                    <div class="confirmation-info-grid">
                        <div class="confirmation-info-card">
                            <strong>Adresse de livraison</strong>
                            <p>
                                {{ $order->firstnames }} {{ $order->lastname }}<br>
                                {{ $order->delivery_place }}
                            </p>
                        </div>
                        <div class="confirmation-info-card">
                            <strong>Délai estimé</strong>
                            @if($order->delivery_day)
                            <p>Livraison souhaitée le <strong>{{ $order->delivery_day->format('d/m/Y') }}</strong></p>
                            @else
                            <p>Livraison prévue entre le<br><strong>{{ date('d/m/Y', strtotime('+3 days')) }}</strong> et le <strong>{{ date('d/m/Y', strtotime('+5 days')) }}</strong></p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- What's Next -->
                <div class="confirmation-section">
                    <h2 class="confirmation-section__title">
                        <svg viewBox="0 0 24 24" width="22" height="22"><path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.28 2.54.72-1.21-3.5-2.08V8H12z" fill="currentColor"/></svg>
                        Prochaines étapes
                    </h2>
                    <div class="confirmation-steps">
                        <div class="confirmation-step">
                            <div class="confirmation-step__icon">
                                <svg viewBox="0 0 24 24" width="24" height="24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" fill="currentColor"/></svg>
                            </div>
                            <div class="confirmation-step__content">
                                <strong>Email de confirmation</strong>
                                <span>Vous recevrez un email avec les détails de votre commande</span>
                            </div>
                        </div>
                        <div class="confirmation-step">
                            <div class="confirmation-step__icon">
                                <svg viewBox="0 0 24 24" width="24" height="24"><path d="M19 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z" fill="currentColor"/></svg>
                            </div>
                            <div class="confirmation-step__content">
                                <strong>Préparation de votre commande</strong>
                                <span>Notre équipe prépare soigneusement vos articles</span>
                            </div>
                        </div>
                        <div class="confirmation-step">
                            <div class="confirmation-step__icon">
                                <svg viewBox="0 0 24 24" width="24" height="24"><path d="M18 18.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM19.5 9.5l1.96 2.5H17V9.5h2.5zM6 18.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM20 8l3 4v5h-2c0 1.66-1.34 3-3 3s-3-1.34-3-3H9c0 1.66-1.34 3-3 3s-3-1.34-3-3H1V6c0-1.11.89-2 2-2h14v4h3z" fill="currentColor"/></svg>
                            </div>
                            <div class="confirmation-step__content">
                                <strong>Expédition</strong>
                                <span>Vous recevrez un SMS avec le lien de suivi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Confirmation Success */
.confirmation-hero{margin:18px 0 26px;padding:18px 20px;border-radius:24px;background:radial-gradient(900px 260px at 10% 0%, rgba(16,185,129,.18), transparent 55%),radial-gradient(900px 260px at 70% 10%, rgba(236,72,153,.16), transparent 55%),rgba(255,255,255,.92);backdrop-filter:blur(12px);border:1px solid rgba(15,23,42,.10);box-shadow:0 24px 60px rgba(2,6,23,.10);position:relative;overflow:hidden}
.confirmation-hero::after{content:'';position:absolute;inset:-2px;border-radius:26px;padding:1px;background:linear-gradient(135deg, rgba(16,185,129,.28), rgba(236,72,153,.22), rgba(30,58,95,.18));-webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);-webkit-mask-composite:xor;mask-composite:exclude;pointer-events:none;opacity:.9}
.confirmation-hero__content{display:flex;gap:16px;align-items:flex-start}
.confirmation-hero__badge{width:74px;height:74px;border-radius:20px;display:flex;align-items:center;justify-content:center;flex:0 0 auto;background:linear-gradient(135deg,#10b981,#059669);color:#fff;box-shadow:0 20px 50px rgba(16,185,129,.28);position:relative}
.confirmation-hero__badge::after{content:'';position:absolute;inset:-10px;background:radial-gradient(circle, rgba(16,185,129,.26), transparent 60%);filter:blur(6px);opacity:.9;z-index:-1}
.confirmation-hero__text{flex:1;min-width:0}
.confirmation-hero__title{font-size:26px;font-weight:900;color:#0b1220;margin:2px 0 6px}
.confirmation-hero__subtitle{margin:0 0 14px;color:#5b6b82;font-size:13px;line-height:1.45}
.confirmation-hero__meta{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px;margin-bottom:14px}
.confirmation-meta{padding:12px 14px;border-radius:16px;background:rgba(255,255,255,.82);border:1px solid rgba(15,23,42,.10);box-shadow:0 10px 22px rgba(2,6,23,.06);position:relative;overflow:hidden}
.confirmation-meta::before{content:'';position:absolute;left:0;top:0;bottom:0;width:4px;background:linear-gradient(180deg,#ec4899,#be185d)}
.confirmation-meta:nth-child(1)::before{background:linear-gradient(180deg,#1e3a5f,#0b1220)}
.confirmation-meta:nth-child(2)::before{background:linear-gradient(180deg,#ec4899,#be185d)}
.confirmation-meta:nth-child(3)::before{background:linear-gradient(180deg,#10b981,#059669)}
.confirmation-meta span{display:block;font-size:11px;color:#64748b;font-weight:800;letter-spacing:.2px;text-transform:uppercase}
.confirmation-meta strong{display:block;margin-top:4px;font-size:14px;color:#0b1220;font-weight:900;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.confirmation-hero__actions{display:flex;gap:12px;flex-wrap:wrap}
.confirmation-action{display:inline-flex;align-items:center;justify-content:center;gap:10px;border-radius:14px;padding:12px 14px;font-weight:900;text-decoration:none;transition:transform .2s ease, box-shadow .2s ease}
.confirmation-action--primary{border:none;color:#fff;background:linear-gradient(135deg,#ec4899,#be185d);box-shadow:0 18px 44px rgba(236,72,153,.28);padding:12px 18px}
.confirmation-action--primary:hover{transform:translateY(-1px);box-shadow:0 24px 60px rgba(236,72,153,.36)}
.confirmation-action--secondary{background:rgba(255,255,255,.88);color:#0b1220;border:1px solid rgba(15,23,42,.14);padding:12px 18px}
.confirmation-action--secondary:hover{transform:translateY(-1px);box-shadow:0 14px 30px rgba(2,6,23,.10)}

/* Confirmation Layout */
.confirmation-layout{display:grid;grid-template-columns:1fr;gap:24px;align-items:start}

/* Confirmation Section */
.confirmation-section{background:rgba(255,255,255,.92);backdrop-filter:blur(10px);border:1px solid rgba(15,23,42,.10);border-radius:20px;padding:22px;margin-bottom:16px;box-shadow:0 16px 40px rgba(2,6,23,.06)}
.confirmation-section__title{display:flex;align-items:center;gap:12px;font-size:15px;font-weight:900;color:#0b1220;margin:0 0 16px;padding-bottom:12px;border-bottom:1px solid rgba(15,23,42,.06)}
.confirmation-section__title svg{color:#1e3a5f}

/* Confirmation Items */
.confirmation-items{display:flex;flex-direction:column;gap:16px}
.confirmation-item{display:flex;align-items:center;gap:16px;padding:12px;background:#f8fafc;border-radius:14px}
.confirmation-item__image{width:70px;height:70px;border-radius:10px;overflow:hidden;flex-shrink:0}
.confirmation-item__image img{width:100%;height:100%;object-fit:cover}
.confirmation-item__details{flex:1}
.confirmation-item__name{font-size:14px;font-weight:800;color:#0b1220;margin:0 0 4px}
.confirmation-item__options{font-size:12px;color:#64748b;margin:0 0 4px}
.confirmation-item__qty{font-size:12px;color:#94a3b8}
.confirmation-item__price{font-size:15px;font-weight:900;color:#be185d}

/* Info Grid */
.confirmation-info-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px}
.confirmation-info-card{padding:16px;background:#f8fafc;border-radius:14px}
.confirmation-info-card strong{display:block;font-size:13px;color:#64748b;margin-bottom:8px;text-transform:uppercase;letter-spacing:.5px}
.confirmation-info-card p{font-size:14px;color:#0b1220;margin:0;line-height:1.6}

/* Confirmation Steps */
.confirmation-steps{display:flex;flex-direction:column;gap:16px}
.confirmation-step{display:flex;align-items:flex-start;gap:16px;padding:16px;background:#f8fafc;border-radius:14px}
.confirmation-step__icon{width:44px;height:44px;background:linear-gradient(135deg, rgba(236,72,153,.14), rgba(190,24,93,.10));border-radius:12px;display:flex;align-items:center;justify-content:center;color:#be185d;flex-shrink:0}
.confirmation-step__content{flex:1}
.confirmation-step__content strong{display:block;font-size:14px;color:#0b1220;margin-bottom:4px;font-weight:900}
.confirmation-step__content span{font-size:13px;color:#64748b}

/* Progress completed state */
.cart-progress__step--completed{color:#0b1220}
.cart-progress__step--completed .cart-progress__icon{background:linear-gradient(135deg,#1e3a5f,#0b1220);color:#fff}
.cart-progress__line--completed{background:linear-gradient(90deg,#1e3a5f,#0b1220)}

/* Support */
.cart-support{background:linear-gradient(135deg,#0f172a,#1e3a5f);border-radius:16px;padding:20px;display:flex;align-items:center;gap:16px;color:#fff}
.cart-support__icon{width:56px;height:56px;background:rgba(255,255,255,.1);border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.cart-support__icon svg{color:#fff}
.cart-support__content strong{display:block;font-size:14px;margin-bottom:4px}
.cart-support__content p{font-size:12px;opacity:.8;margin:0 0 8px}
.cart-support__phone{color:#ec4899;font-size:15px;font-weight:600;text-decoration:none}

@media(max-width:768px){
    .confirmation-info-grid{grid-template-columns:1fr}
    .confirmation-hero__content{flex-direction:column}
    .confirmation-hero__meta{grid-template-columns:1fr}
    .confirmation-hero__title{font-size:22px}
}
</style>
@endpush
