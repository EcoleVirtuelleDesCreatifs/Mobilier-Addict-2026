<header class="header-new">
    <div class="header-new__top">
        <div class="container header-new__top-inner">
            <div class="header-new__promo" aria-label="Promotion">
                <div class="header-new__promo-swap" aria-hidden="true">
                    <span class="header-new__promo-msg header-new__promo-msg--a">🎁 Livraison <strong>GRATUITE</strong> dès <strong>50.000F</strong></span>
                    <span class="header-new__promo-msg header-new__promo-msg--b">Commandez en 30 secondes, c’est simple</span>
                </div>
                <span class="header-new__promo-fallback">🎁 Livraison GRATUITE dès 50.000F • Passez une commande rapidement</span>
            </div>
            <div class="header-new__links">
                <a href="#">Aide</a>
                <a href="#">Suivre commande</a>
                <a href="#">Blog</a>
                <a href="{{ route('b2b.index') }}" style="font-weight: 600; color: #3b82f6;">B2B</a>
            </div>
        </div>
    </div>
    <div class="header-new__main">
        <div class="container header-new__main-inner">
            <a class="logo" href="{{ route('home') }}" aria-label="Accueil">
                <img class="logo__img" src="{{ asset('assets/logo/desktop/logo.png') }}" alt="Mobilier Addict" />
            </a>

            <form class="searchbar" action="{{ route('search.index') }}" method="get" role="search" data-searchbar>
                <input class="searchbar__input" type="search" name="q" placeholder="Rechercher matelas, oreillers, draps..." autocomplete="off" data-search-input />
                <button class="searchbar__btn" type="submit" aria-label="Rechercher">
                    <svg viewBox="0 0 24 24" width="20" height="20"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                </button>
                <button class="searchbar__clear" type="button" aria-label="Effacer" data-search-clear>×</button>
                <div class="searchbar__suggest" data-search-suggest aria-label="Suggestions" role="listbox"></div>
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
                <a class="mobile-nav__logo" href="{{ route('home') }}" aria-label="Accueil">
                    <img class="mobile-nav__logo-img" src="{{ asset('assets/logo/mobile/logo.png') }}" alt="Mobilier Addict" loading="eager" />
                </a>
            </div>
            @forelse(($headerMenus ?? collect()) as $menu)
                @php
                    $menuSlug = strtolower((string) ($menu->slug ?? ''));
                    $menuUrl = $menu->url ?: (in_array($menuSlug, ['accueil', 'home'], true) ? route('home') : route('menu.show', $menu->slug));
                    $resolvedUrl = preg_match('#^https?://#', $menuUrl) ? $menuUrl : url($menuUrl);
                    $bedroomSlugs = ['matelas', 'oreillers-et-taies', 'drap-et-couettes'];
                    $isActive = $menuUrl !== '#' && rtrim($resolvedUrl, '/') === rtrim(url()->current(), '/');
                    if ($menuSlug === 'chambre' && request()->routeIs('menu.show') && in_array((string) request()->route('slug'), $bedroomSlugs, true)) {
                        $isActive = true;
                    }
                    $targetAttr = $menu->open_new_tab ? ' target="_blank" rel="noopener"' : '';

                    $matelasSubmenu = [
                        ['label' => 'Matelas Addict PH10 ultra', 'model' => 'matelas-addict-ph10-ultra'],
                        ['label' => 'LUXURY LITERIE', 'model' => 'luxury-literie'],
                        ['label' => 'MEDICOSOINS PH8', 'model' => 'medicosoins-ph8'],
                        ['label' => 'MEDICOSOINS PH10', 'model' => 'medicosoins-ph10'],
                        ['label' => 'CONFORT SOFT', 'model' => 'confort-soft'],
                        ['label' => 'BEN- PH6', 'model' => 'ben-ph6'],
                        ['label' => 'SUR MESURE', 'model' => 'sur-mesure'],
                    ];
                @endphp
                @php
                    $hasChildren = $menu->children && $menu->children->count() > 0;
                @endphp

                <div class="nav-item {{ $hasChildren ? 'nav-item--has-children' : '' }}" {{ $hasChildren ? 'data-submenu' : '' }}>
                    @if($hasChildren)
                        <div class="nav-link-row">
                            <a class="nav-link {{ $isActive ? 'nav-link--active' : '' }}" href="{{ $menuUrl === '#' ? '#' : $resolvedUrl }}"{!! $targetAttr !!}>
                                <span class="nav-link__icon">
                                    @if($menu->icon)
                                        <i class="{{ $menu->icon }}"></i>
                                    @else
                                        <i class="fa-solid fa-circle"></i>
                                    @endif
                                </span>
                                {{ $menu->name }}
                            </a>
                            <button class="nav-submenu-toggle" type="button" aria-label="Sous-menu {{ $menu->name }}" aria-expanded="false" data-submenu-trigger>
                                <span class="nav-link__caret"><i class="fa-solid fa-chevron-down"></i></span>
                            </button>
                        </div>
                        <div class="nav-submenu" data-submenu-panel>
                            @foreach($menu->children as $child)
                                @php
                                    $childSlug = strtolower((string) ($child->slug ?? ''));
                                    $childUrl = $child->url ?: (in_array($childSlug, ['accueil', 'home'], true) ? route('home') : route('menu.show', $child->slug));
                                    $childResolvedUrl = preg_match('#^https?://#', $childUrl) ? $childUrl : url($childUrl);
                                    $childIsActive = $childUrl !== '#' && rtrim($childResolvedUrl, '/') === rtrim(url()->current(), '/');
                                    $childTargetAttr = $child->open_new_tab ? ' target="_blank" rel="noopener"' : '';
                                @endphp
                                <a class="nav-submenu__link {{ $childIsActive ? 'is-active' : '' }}" href="{{ $childUrl === '#' ? '#' : $childResolvedUrl }}"{!! $childTargetAttr !!}>
                                    {{ $child->name }}
                                </a>
                            @endforeach
                        </div>
                    @else
                        <a class="nav-link {{ $isActive ? 'nav-link--active' : '' }}" href="{{ $menuUrl === '#' ? '#' : $resolvedUrl }}"{!! $targetAttr !!}>
                            <span class="nav-link__icon">
                                @if($menu->icon)
                                    <i class="{{ $menu->icon }}"></i>
                                @else
                                    <i class="fa-solid fa-circle"></i>
                                @endif
                            </span>
                            {{ $menu->name }}
                        </a>
                    @endif
                </div>
            @empty
                <a class="nav-link nav-link--active" href="{{ route('home') }}">
                    <span class="nav-link__icon"><i class="fa-solid fa-house"></i></span>
                    Accueil
                </a>
            @endforelse
            <div class="mobile-nav__footer">
                <a class="mobile-nav__cta" href="#">Explorer la collection <i class="fa-solid fa-arrow-right"></i></a>
                <a class="mobile-nav__cta" href="{{ route('b2b.index') }}" style="margin-top: 8px; background: #3b82f6;">Espace B2B <i class="fa-solid fa-briefcase"></i></a>
                <p style="color:rgba(255,255,255,.6);font-size:13px;margin:12px 0">Besoin d'aide ? Contactez-nous</p>
                <div class="mobile-nav__contact">
                    <a href="tel:+{{ whatsapp_number() }}" aria-label="Téléphone"><i class="fa-solid fa-phone"></i></a>
                    <a href="https://wa.me/{{ whatsapp_number() }}" aria-label="WhatsApp" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="mailto:contact@mobilier-addict.com" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <nav class="mobile-bottom-bar" aria-label="Navigation mobile">
        <a class="mobile-bottom-bar__item {{ request()->routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}">
            <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path d="M3 10.5 12 3l9 7.5V21a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1V10.5z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
            <span>Accueil</span>
        </a>
        <a class="mobile-bottom-bar__item {{ request()->routeIs('menu.show') && request()->route('slug') === 'matelas' ? 'is-active' : '' }}" href="{{ route('menu.show', 'matelas') }}">
            <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><rect x="4" y="7" width="16" height="11" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M6 7V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M4 16h16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            <span>Matelas</span>
        </a>
        <a class="mobile-bottom-bar__item {{ request()->routeIs('menu.show') && request()->route('slug') === 'oreillers-et-taies' ? 'is-active' : '' }}" href="{{ route('menu.show', 'oreillers-et-taies') }}">
            <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path d="M6 9a3 3 0 0 1 3-3h8a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H9a3 3 0 0 1-3-3V9z" fill="none" stroke="currentColor" stroke-width="2"/><path d="M6 10H5a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M20 10h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            <span>Oreillers</span>
        </a>
        <a class="mobile-bottom-bar__item {{ request()->routeIs('menu.show') && request()->route('slug') === 'drap-et-couettes' ? 'is-active' : '' }}" href="{{ route('menu.show', 'drap-et-couettes') }}">
            <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path d="M6 5h12a2 2 0 0 1 2 2v12H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2z" fill="none" stroke="currentColor" stroke-width="2"/><path d="M8 9h10" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M8 13h10" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            <span>Draps</span>
        </a>
    </nav>
</header>
