@php
    $cartItems = session('cart', []);
    $cartCount = is_array($cartItems) ? array_sum(array_map(fn ($item) => is_array($item) ? (int) ($item['quantity'] ?? 0) : 0, $cartItems)) : 0;
@endphp
<header class="ma27 ma27-header">
    <div class="wrap ma27-head-row">
        <a class="ma27-logo" href="{{ route('home') }}" aria-label="Mobilier Addict, accueil"><img src="{{ asset('assets/logo/desktop/logo-480.webp') }}" alt="Mobilier Addict" width="155" height="60"></a>
        <nav class="ma27-links" aria-label="Navigation principale">@include('maquette.includes.menu', ['headerMenus' => ($headerMenus ?? collect())->reject(fn ($entry) => in_array($entry->slug, ['accueil', 'home', '/']))])</nav>
        <a class="ma27-surmesure-link" href="{{ route('devis.create') }}" aria-label="Demander un devis sur-mesure">Sur-mesure</a>
        <div class="ma27-acts">
            <a href="{{ route('search.index') }}" aria-label="Rechercher"><svg class="ico" width="22" height="22" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg></a>
            <a href="{{ route('favorites.index') }}" aria-label="Mes favoris"><svg class="ico" width="22" height="22" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 20.5S3.5 15.6 3.5 9.4A4.4 4.4 0 0 1 12 7.6a4.4 4.4 0 0 1 8.5 1.8c0 6.2-8.5 11.1-8.5 11.1z"/></svg></a>
            <a href="#drawer-cart" data-bs-toggle="offcanvas" aria-label="Votre panier, {{ $cartCount }} articles"><svg class="ico" width="22" height="22" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 8h14l-1 12.5H6zM9 8V6.5a3 3 0 0 1 6 0V8"/></svg><span class="ma27-count header-cart-count" data-empty="{{ $cartCount ? 'false' : 'true' }}">{{ $cartCount ?: '' }}</span></a>
            <a class="ma27-burger" href="#drawer-menu" data-bs-toggle="offcanvas" aria-label="Ouvrir le menu"><svg class="ico" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 8h16M4 16h16"/></svg></a>
        </div>
    </div>
</header>
