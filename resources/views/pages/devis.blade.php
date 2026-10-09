@extends('maquette.layout')

@section('title', 'Devis sur-mesure — Mobilier Addict')
@section('meta_description', 'Demandez un devis sur-mesure pour votre entreprise, hôtel, institution ou projet d’aménagement en Côte d’Ivoire.')

@section('content')
    <div class="devis-page mp-checkout">
        <div class="container">

            <div class="mp-cat-hero" data-aos="fade-up" data-aos-duration="700">
                <div class="mp-cat-hero-content">
                    <p class="mp-cat-hero-kicker">
                        <a href="{{ route('home') }}">Accueil</a>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        <span>Entreprises · Institutions · Hôtellerie</span>
                    </p>
                    <h1 class="mp-cat-hero-title">Devis sur-mesure</h1>
                    <p class="mp-cat-hero-sub">Un projet d'aménagement, un équipement en quantité ou du mobilier aux dimensions spécifiques&nbsp;? Décrivez votre besoin, notre équipe prépare une proposition chiffrée adaptée à votre structure.</p>
                </div>
            </div>

            <div class="row mp-checkout-grid mb-100">
                <div class="col-lg-8 col-12">
                    <div class="mp-panel" data-aos="fade-up" data-aos-duration="700">
                        <div class="mp-panel-head">
                            <span class="mp-panel-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M9 13h6"/><path d="M9 17h6"/></svg>
                            </span>
                            <div>
                                <h2 class="mp-panel-title">Décrivez votre projet</h2>
                                <p class="mp-panel-sub">Réponse sous 24–48h ouvrées via WhatsApp ou e-mail.</p>
                            </div>
                        </div>

                        <form action="{{ route('devis.store') }}" method="POST" class="mp-form-checkout">
                            @csrf
                            <div class="d-none" aria-hidden="true">
                                <label>Site web<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="mp-label" for="organization_type">Type de structure <em>*</em></label>
                                    <select id="organization_type" name="organization_type" class="mp-input" required>
                                        <option value="">Sélectionnez…</option>
                                        @foreach($organizationTypes as $key => $label)
                                            <option value="{{ $key }}" @selected(old('organization_type') === $key)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('organization_type')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="mp-label" for="company_name">Nom de la structure <em>*</em></label>
                                    <input id="company_name" name="company_name" type="text" autocomplete="organization" class="mp-input" value="{{ old('company_name') }}" placeholder="Ex : Hôtel Ivoire, SODECI, ONG Espoir…" required>
                                    @error('company_name')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="mp-label" for="lastname">Nom du contact <em>*</em></label>
                                    <input id="lastname" name="lastname" type="text" class="mp-input" value="{{ old('lastname') }}" placeholder="Nom" autocomplete="family-name" required>
                                    @error('lastname')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="mp-label" for="firstnames">Prénom(s)</label>
                                    <input id="firstnames" name="firstnames" type="text" class="mp-input" value="{{ old('firstnames') }}" placeholder="Prénom(s)" autocomplete="given-name">
                                    @error('firstnames')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="mp-label" for="whatsapp">WhatsApp <em>*</em></label>
                                    <input id="whatsapp" name="whatsapp" type="tel" inputmode="tel" autocomplete="tel" class="mp-input" value="{{ old('whatsapp') }}" placeholder="+225 …" required>
                                    @error('whatsapp')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="mp-label" for="phone">Téléphone secondaire</label>
                                    <input id="phone" name="phone" type="tel" inputmode="tel" autocomplete="tel-national" class="mp-input" value="{{ old('phone') }}" placeholder="Optionnel">
                                    @error('phone')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="mp-label" for="email">E-mail professionnel</label>
                                    <input id="email" name="email" type="email" autocomplete="email" class="mp-input" value="{{ old('email') }}" placeholder="contact@structure.com">
                                    @error('email')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="mp-label" for="budget_range">Budget estimé</label>
                                    <select id="budget_range" name="budget_range" class="mp-input">
                                        <option value="">Sélectionnez…</option>
                                        @foreach($budgetRanges as $key => $label)
                                            <option value="{{ $key }}" @selected(old('budget_range') === $key)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('budget_range')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="mp-label" for="delivery_place">Lieu de livraison</label>
                                    <input id="delivery_place" name="delivery_place" type="text" class="mp-input" value="{{ old('delivery_place') }}" placeholder="Commune / ville">
                                    @error('delivery_place')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="mp-label" for="delivery_day">Date de livraison souhaitée</label>
                                    <input id="delivery_day" name="delivery_day" type="date" min="{{ now()->toDateString() }}" class="mp-input" value="{{ old('delivery_day') }}">
                                    @error('delivery_day')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="mp-label" for="details">Votre besoin <em>*</em></label>
                                    <textarea id="details" name="details" class="mp-input" rows="6" required placeholder="Articles souhaités, quantités, dimensions ou tissus particuliers, contraintes d'accès ou de livraison…">{{ old('details') }}</textarea>
                                    @error('details')<p class="mp-field-error">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="mp-checkout-actions">
                                <span class="mp-devis-note">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                                    Réponse sous 24–48h ouvrées
                                </span>
                                <button type="submit" class="mp-buy mp-checkout-submit">
                                    Envoyer ma demande de devis
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <aside class="devis-aside" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                        <h2>Comment ça marche&nbsp;?</h2>
                        <div class="devis-step">
                            <span class="devis-step-num">1</span>
                            <div>
                                <strong>Décrivez votre projet</strong>
                                <span>Articles, quantités, budget et lieu de livraison.</span>
                            </div>
                        </div>
                        <div class="devis-step">
                            <span class="devis-step-num">2</span>
                            <div>
                                <strong>Échange avec notre équipe</strong>
                                <span>Nous précisons ensemble les références, finitions et délais.</span>
                            </div>
                        </div>
                        <div class="devis-step">
                            <span class="devis-step-num">3</span>
                            <div>
                                <strong>Proposition chiffrée</strong>
                                <span>Devis détaillé avec tarifs dégressifs selon les quantités.</span>
                            </div>
                        </div>
                        <div class="devis-aside-contact">
                            <p class="mb-2">Besoin d'en parler directement&nbsp;?</p>
                            <a href="tel:+2250799140356">+225 07 99 14 03 56</a><br>
                            <a href="mailto:contact@mobilier-addict.com">contact@mobilier-addict.com</a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
