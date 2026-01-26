<header class="header-new">
    <div class="header-new__top">
        <div class="container header-new__top-inner">
            <span class="header-new__promo">🎁 Livraison GRATUITE dès 50.000F</span>
            <div class="header-new__links">
                <a href="#">Aide</a>
                <a href="#">Suivre commande</a>
                <a href="#">Blog</a>
            </div>
        </div>
    </div>
    <div class="header-new__main">
        <div class="container header-new__main-inner">
            <a class="logo" href="{{ route('home') }}" aria-label="Accueil">
                <img class="logo__img" src="{{ asset('assets/logo/desktop/logo.png') }}" alt="Mobilier Addict" />
            </a>

            <form class="searchbar" action="#" method="get" role="search">
                <input class="searchbar__input" type="search" name="q" placeholder="Rechercher matelas, oreillers, draps..." />
                <button class="searchbar__btn" type="submit" aria-label="Rechercher">
                    <svg viewBox="0 0 24 24" width="20" height="20"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                </button>
            </form>

            <div class="header-new__actions">
                <a class="header-new__action header-new__action--desktop" href="#">
                    <svg viewBox="0 0 24 24" width="22" height="22"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" stroke="currentColor" stroke-width="2" fill="none"/></svg>
                    <span class="header-new__action-label">Favoris</span>
                </a>
                <a class="header-new__action header-new__action--desktop" href="#">
                    <svg viewBox="0 0 24 24" width="22" height="22"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                    <span class="header-new__action-label">Compte</span>
                </a>
                <a class="header-new__cart" href="{{ route('cart.index') }}">
                    <svg viewBox="0 0 24 24" width="22" height="22"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4zM3 6h18M16 10a4 4 0 0 1-8 0" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                    <span class="header-new__cart-count">{{ is_array(session('cart')) ? array_sum(array_map(fn($i) => (int)($i['quantity'] ?? 0), session('cart'))) : 0 }}</span>
                    <span class="header-new__action-label">Panier</span>
                </a>
                <button class="hamburger" id="hamburger" aria-label="Menu" aria-expanded="false">
                    <span class="hamburger__line"></span>
                    <span class="hamburger__line"></span>
                    <span class="hamburger__line"></span>
                </button>
            </div>
        </div>
    </div>
    <nav class="header-new__nav" id="mobile-nav">
        <button class="mobile-nav__close" id="nav-close"><i class="fa-solid fa-xmark"></i></button>
        <div class="container header-new__nav-inner">
            <div class="mobile-nav__header">
                <h3 class="mobile-nav__title"><i class="fa-solid fa-bed"></i> Mobilier Addict</h3>
                <p class="mobile-nav__subtitle">Votre partenaire sommeil premium</p>
            </div>
            <a class="nav-link nav-link--active" href="{{ route('home') }}">
                <span class="nav-link__icon"><i class="fa-solid fa-house"></i></span>
                Accueil
            </a>
            <a class="nav-link" href="{{ route('univers.show', 'matelas') }}">
                <span class="nav-link__icon"><i class="fa-solid fa-bed"></i></span>
                Matelas
            </a>
            <a class="nav-link" href="{{ route('univers.show', 'oreillers') }}">
                <span class="nav-link__icon"><i class="fa-solid fa-cloud"></i></span>
                Oreillers
            </a>
            <a class="nav-link" href="{{ route('univers.show', 'draps-couettes') }}">
                <span class="nav-link__icon"><i class="fa-solid fa-sheet-plastic"></i></span>
                Draps & Couettes
            </a>
            <a class="nav-link" href="#">
                <span class="nav-link__icon"><i class="fa-solid fa-plug"></i></span>
                Électroménager & Meubles
            </a>
            <a class="nav-link" href="{{ route('univers.show', 'lits-sommiers') }}">
                <span class="nav-link__icon"><i class="fa-solid fa-couch"></i></span>
                Lits
            </a>
            <div class="mobile-nav__footer">
                <a class="mobile-nav__cta" href="#">Explorer la collection <i class="fa-solid fa-arrow-right"></i></a>
                <p style="color:rgba(255,255,255,.6);font-size:13px;margin:12px 0">Besoin d'aide ? Contactez-nous</p>
                <div class="mobile-nav__contact">
                    <a href="tel:+221771234567" aria-label="Téléphone"><i class="fa-solid fa-phone"></i></a>
                    <a href="#" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
                </div>
            </div>
        </div>
    </nav>
</header>
