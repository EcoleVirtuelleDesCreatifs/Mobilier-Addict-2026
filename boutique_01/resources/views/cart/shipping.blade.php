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

                        <form action="{{ route('cart.shipping.store') }}" method="POST" class="mp-form-checkout">
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
                    <aside class="mp-panel mp-summary" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                        <h3 class="mp-panel-title mp-summary-title">Récapitulatif</h3>
                        <ul class="mp-summary-items">
                            @foreach($cartItems as $item)
                                <li class="mp-summary-item">
                                    <span class="mp-summary-name">{{ $item->name }} <em>× {{ $item->quantity }}</em></span>
                                    <span class="mp-summary-price">{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mp-summary-rows">
                            <div class="mp-summary-row">
                                <span>Sous-total</span>
                                <strong>{{ number_format($subtotal, 0, ',', ' ') }} FCFA</strong>
                            </div>
                            <div class="mp-summary-row">
                                <span>Livraison</span>
                                <strong>{{ $shipping > 0 ? number_format($shipping, 0, ',', ' ') . ' FCFA' : 'À calculer' }}</strong>
                            </div>
                            <div class="mp-summary-row mp-summary-total">
                                <span>Total</span>
                                <strong>{{ number_format($total, 0, ',', ' ') }} FCFA</strong>
                            </div>
                        </div>
                        <div class="mp-summary-note">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                            Commande sécurisée — vos données restent confidentielles.
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
