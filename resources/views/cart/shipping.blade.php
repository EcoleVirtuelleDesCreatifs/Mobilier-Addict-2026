@extends('maquette.layout')

@section('content')
    <div class="checkout-page mt-100 mp-checkout">
        <div class="container">

            <div class="mp-checkout-head" data-aos="fade-up" data-aos-duration="600">
                <p class="featured-kicker">Commande</p>
                <h1 class="section-heading">Vos informations de <span class="featured-title-accent">livraison</span></h1>
            </div>

            <div class="mp-steps" data-aos="fade-up" data-aos-duration="600">
                <a class="mp-step is-done" href="{{ route('cart.index') }}">
                    <span class="mp-step-num"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></span>
                    <span class="mp-step-label">Panier</span>
                </a>
                <span class="mp-step-line is-done"></span>
                <span class="mp-step is-active">
                    <span class="mp-step-num">2</span>
                    <span class="mp-step-label">Livraison</span>
                </span>
                <span class="mp-step-line"></span>
                <span class="mp-step">
                    <span class="mp-step-num">3</span>
                    <span class="mp-step-label">Confirmation</span>
                </span>
            </div>

            <div class="row mp-checkout-grid">
                <div class="col-lg-8 col-12">
                    <div class="mp-panel" data-aos="fade-up" data-aos-duration="700">
                        <div class="mp-panel-head">
                            <span class="mp-panel-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.62l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                            </span>
                            <div>
                                <h2 class="mp-panel-title">Où livrer votre commande&nbsp;?</h2>
                                <p class="mp-panel-sub">Ces informations serviront à la préparation et à la livraison.</p>
                            </div>
                        </div>

                        <form action="{{ route('cart.shipping.store') }}" method="POST" class="mp-form-checkout" id="shippingForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="mp-label">Prénom(s) <em>*</em></label>
                                    <input type="text" name="firstnames" class="mp-input @error('firstnames') is-invalid @enderror" value="{{ old('firstnames') }}" placeholder="Ex. Awa" required />
                                    @error('firstnames')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="mp-label">Nom <em>*</em></label>
                                    <input type="text" name="lastname" class="mp-input @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" placeholder="Ex. Ndiaye" required />
                                    @error('lastname')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="mp-label">Numéro WhatsApp <em>*</em></label>
                                    <input type="tel" name="whatsapp" class="mp-input @error('whatsapp') is-invalid @enderror" value="{{ old('whatsapp') }}" placeholder="+225 07 00 00 00 00" required />
                                    @error('whatsapp')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="mp-label">Téléphone <small>(optionnel)</small></label>
                                    <input type="tel" name="phone" class="mp-input @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Second numéro" />
                                    @error('phone')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="mp-label">Lieu de livraison <em>*</em></label>
                                    <input type="text" name="delivery_place" class="mp-input @error('delivery_place') is-invalid @enderror" value="{{ old('delivery_place') }}" placeholder="Ville, commune, quartier" required />
                                    @error('delivery_place')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="mp-label">Jour de livraison souhaité</label>
                                    <input type="date" name="delivery_day" class="mp-input @error('delivery_day') is-invalid @enderror" value="{{ old('delivery_day') }}" />
                                    @error('delivery_day')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="mp-label">Détails complémentaires</label>
                                    <textarea name="details" rows="3" class="mp-input" placeholder="Point de repère, étage, instructions…">{{ old('details') }}</textarea>
                                    @error('details')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="mp-label">Méthode de livraison <em>*</em></label>
                                    <div class="mp-ship-opts @error('shipping_method') is-invalid @enderror">
                                        <label class="mp-ship-opt">
                                            <input type="radio" name="shipping_method" value="standard" {{ old('shipping_method', 'standard') === 'standard' ? 'checked' : '' }} required>
                                            <span class="mp-ship-card">
                                                <span class="mp-ship-icon">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.62l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                                                </span>
                                                <span class="mp-ship-name">Livraison standard</span>
                                                <span class="mp-ship-desc">2 à 5 jours ouvrés</span>
                                            </span>
                                        </label>
                                        <label class="mp-ship-opt">
                                            <input type="radio" name="shipping_method" value="express" {{ old('shipping_method') === 'express' ? 'checked' : '' }}>
                                            <span class="mp-ship-card">
                                                <span class="mp-ship-icon">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 4.5 13.5H11L10 22l8.5-11.5H13L13 2z"/></svg>
                                                </span>
                                                <span class="mp-ship-name">Livraison express</span>
                                                <span class="mp-ship-desc">Sous 24 à 48 h</span>
                                            </span>
                                        </label>
                                    </div>
                                    @error('shipping_method')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="mp-checkout-actions">
                                <a href="{{ route('cart.index') }}" class="mp-back-link">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m11 18-6-6 6-6"/></svg>
                                    Retour au panier
                                </a>
                                <button type="submit" class="mp-buy mp-checkout-submit">
                                    Finaliser la commande
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <aside class="mp-panel mp-summary mp-summary-pro" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                        <div class="mp-summary-pro__head">
                            <div>
                                <span class="mp-summary-pro__kicker">Votre commande</span>
                                <h3 class="mp-panel-title mp-summary-title">Récapitulatif</h3>
                            </div>
                            <span class="mp-summary-pro__count">{{ number_format($cartItems->sum('quantity'), 0, ',', ' ') }} article{{ $cartItems->sum('quantity') > 1 ? 's' : '' }}</span>
                        </div>

                        <ul class="mp-summary-items mp-summary-pro__items">
                            @foreach($cartItems as $item)
                                <li class="mp-summary-item mp-summary-pro__item">
                                    <a href="{{ $item->slug ? route('product.show', $item->slug) : '#' }}" class="mp-summary-pro__media" @if(!$item->slug) aria-disabled="true" @endif>
                                        @if($item->image)
                                            <img src="{{ $item->image }}" alt="{{ $item->name }}" loading="lazy" decoding="async">
                                        @else
                                            <span>{{ mb_strtoupper(mb_substr($item->name, 0, 1)) }}</span>
                                        @endif
                                        <em>{{ $item->quantity }}</em>
                                    </a>
                                    <div class="mp-summary-pro__details">
                                        <a href="{{ $item->slug ? route('product.show', $item->slug) : '#' }}" class="mp-summary-name">{{ $item->name }}</a>
                                        @if($item->options)
                                            <small>{{ $item->options }}</small>
                                        @endif
                                        <span>{{ number_format($item->price, 0, ',', ' ') }} FCFA × {{ $item->quantity }}</span>
                                    </div>
                                    <strong class="mp-summary-price">{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} F</strong>
                                </li>
                            @endforeach
                        </ul>

                        <div class="mp-summary-rows mp-summary-pro__rows">
                            <div class="mp-summary-row">
                                <span>Sous-total</span>
                                <strong>{{ number_format($subtotal, 0, ',', ' ') }} FCFA</strong>
                            </div>
                            <div class="mp-summary-row">
                                <span>Livraison</span>
                                <strong>{{ $shipping > 0 ? number_format($shipping, 0, ',', ' ') . ' FCFA' : 'À confirmer' }}</strong>
                            </div>
                            <div class="mp-summary-row mp-summary-total">
                                <span>Total estimé</span>
                                <strong>{{ number_format($total, 0, ',', ' ') }} FCFA</strong>
                            </div>
                        </div>

                        <button type="submit" form="shippingForm" class="mp-summary-pro__submit">
                            Finaliser la commande
                            <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                        </button>

                        <div class="mp-summary-pro__assurances">
                            <div>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                                <span>Données confidentielles</span>
                            </div>
                            <div>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15.46v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.07-8.67A2 2 0 0 1 3.11.54h3a2 2 0 0 1 2 1.72"/><path d="M7 8.5a16 16 0 0 0 8.5 8.5"/></svg>
                                <span>Validation par WhatsApp</span>
                            </div>
                        </div>
                        <p class="mp-summary-pro__notice">Le montant et la disponibilité sont confirmés par notre équipe avant la préparation.</p>
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
.mp-summary-pro{padding:0!important;overflow:hidden;border:1px solid rgba(0,35,77,.1);box-shadow:0 20px 50px rgba(0,35,77,.1)}
.mp-summary-pro__head{display:flex;align-items:center;justify-content:space-between;gap:16px;padding:22px 22px 18px;background:#00234D;color:#fff}
.mp-summary-pro__kicker{display:block;color:#ec4899;font-size:10px;font-weight:800;letter-spacing:.13em;text-transform:uppercase;margin-bottom:4px}
.mp-summary-pro .mp-summary-title{color:#fff;margin:0;font-size:20px}
.mp-summary-pro__count{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.16);border-radius:999px;padding:7px 11px;font-size:11px;font-weight:700;white-space:nowrap}
.mp-summary-pro__items{padding:18px!important;margin:0!important;gap:0!important;max-height:390px!important;border-bottom:1px solid #edf0f4!important}
.mp-summary-pro__item{display:grid!important;grid-template-columns:62px minmax(0,1fr) auto;align-items:center;gap:12px!important;padding:12px 0;border-bottom:1px solid #f0f2f5;font-size:inherit!important}
.mp-summary-pro__item:first-child{padding-top:0}.mp-summary-pro__item:last-child{padding-bottom:0;border-bottom:0}
.mp-summary-pro__media{width:62px;height:68px;border-radius:12px;overflow:visible;background:#f4f5f7;position:relative;display:flex;align-items:center;justify-content:center;text-decoration:none;color:#ec4899;font-size:22px;font-weight:800}
.mp-summary-pro__media img{width:100%;height:100%;object-fit:cover;border-radius:12px}
.mp-summary-pro__media em{position:absolute;right:-7px;top:-7px;width:22px;height:22px;border-radius:50%;background:#ec4899;color:#fff;display:flex;align-items:center;justify-content:center;font-size:10px;font-style:normal;font-weight:800;border:2px solid #fff}
.mp-summary-pro__details{min-width:0}.mp-summary-pro__details .mp-summary-name{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;color:#00234D;text-decoration:none;font-weight:800;font-size:12.5px;line-height:1.35}
.mp-summary-pro__details small{display:block;color:#64748b;font-size:10.5px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-top:3px}
.mp-summary-pro__details>span{display:block;color:#98a2b3;font-size:10.5px;margin-top:4px}
.mp-summary-pro__item>.mp-summary-price{font-size:12px;color:#00234D;font-weight:800;white-space:nowrap}
.mp-summary-pro__rows{padding:18px 22px!important;gap:11px!important}.mp-summary-pro__rows .mp-summary-row{font-size:13px}.mp-summary-pro__rows .mp-summary-total{margin-top:5px;padding-top:15px}.mp-summary-pro__rows .mp-summary-total strong{font-size:20px;color:#ec4899}
.mp-summary-pro__submit{width:calc(100% - 44px);margin:0 22px;border:0;border-radius:999px;background:#ec4899;color:#fff;padding:15px 20px;display:flex;align-items:center;justify-content:center;gap:10px;font-size:13px;font-weight:800;text-transform:uppercase;letter-spacing:.04em;transition:.2s;box-shadow:0 12px 28px rgba(236,72,153,.28)}
.mp-summary-pro__submit:hover{background:#d1357f;transform:translateY(-2px);box-shadow:0 16px 34px rgba(236,72,153,.36)}
.mp-summary-pro__assurances{display:grid;grid-template-columns:1fr 1fr;gap:8px;padding:17px 22px 0}.mp-summary-pro__assurances>div{display:flex;align-items:center;gap:6px;color:#4b5563;font-size:10.5px}.mp-summary-pro__assurances svg{width:16px;height:16px;color:#16a34a;flex:0 0 16px}
.mp-summary-pro__notice{margin:14px 22px 20px;padding:11px 12px;border-radius:10px;background:#f7f9fc;color:#64748b;font-size:10.5px;line-height:1.5;text-align:center}
@media(max-width:991.98px){.mp-checkout-grid>.col-lg-4{order:-1}.mp-summary-pro{position:static}.mp-summary-pro__items{max-height:260px!important}}
@media(max-width:575.98px){.mp-summary-pro__head{padding:18px}.mp-summary-pro__items{padding:15px!important}.mp-summary-pro__item{grid-template-columns:54px minmax(0,1fr)}.mp-summary-pro__media{width:54px;height:60px}.mp-summary-pro__item>.mp-summary-price{grid-column:2;text-align:left}.mp-summary-pro__rows{padding:16px 18px!important}.mp-summary-pro__submit{width:calc(100% - 36px);margin:0 18px}.mp-summary-pro__assurances{grid-template-columns:1fr;padding:15px 18px 0}.mp-summary-pro__notice{margin:12px 18px 18px}}
</style>
@endpush
