{{--
|--------------------------------------------------------------------------
| MENU PRINCIPAL COMPLET - InCotedivoire V3
|--------------------------------------------------------------------------
| Menu de navigation complet avec :
| - Accueil
| - Catégories avec mega menu
| - Actualités
| - Sport
| - Culture
| - Opinions
| - Contact
| - Spécial (dropdown)
| - Sections (dropdown)
| - Recherche
|--------------------------------------------------------------------------
--}}

<nav class="main-nav-complete">
    <div class="container">
        <div class="nav-wrapper">
            {{-- Menu Mobile Toggle --}}
            <button class="mobile-menu-toggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            {{-- Navigation principale --}}
            <ul class="nav-menu-complete">
                {{-- 1. ACCUEIL --}}
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="ti-home"></i>
                        <span>Accueil</span>
                    </a>
                </li>

                {{-- 2. CATÉGORIES avec Mega Menu --}}
                @if(isset($categories) && $categories->count() > 0)
                <li class="nav-item has-mega-menu">
                    <a href="#" class="nav-link">
                        <i class="ti-layout-grid2"></i>
                        <span>Catégories</span>
                        <i class="ti-angle-down dropdown-icon"></i>
                    </a>
                    <div class="mega-menu">
                        <div class="mega-menu-content">
                            <div class="mega-menu-grid">
                                @foreach($categories->take(8) as $category)
                                <div class="mega-menu-item">
                                    <a href="{{ route('menus.show', $category->slug) }}" class="mega-menu-link">
                                        <div class="mega-menu-icon">
                                            <i class="ti-folder"></i>
                                        </div>
                                        <div class="mega-menu-text">
                                            <h4>{{ $category->title }}</h4>
                                            <span class="article-count">{{ $category->articles_count ?? 0 }} articles</span>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            @if($categories->count() > 8)
                            <div class="mega-menu-footer">
                                <a href="{{ route('menus.index') }}" class="view-all-btn">
                                    Voir toutes les catégories
                                    <i class="ti-arrow-right"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </li>
                @endif

                {{-- 3. ACCUEIL (lien direct) --}}
                <li class="nav-item {{ Request::is('accueil') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">
                        <span>Accueil</span>
                    </a>
                </li>

                {{-- 4. ACTUALITÉS avec dropdown --}}
                <li class="nav-item has-dropdown {{ Request::is('actualites*') ? 'active' : '' }}">
                    <a href="#" class="nav-link">
                        <span>Actualités</span>
                        <i class="ti-angle-down dropdown-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-world"></i>
                                Actualités Nationales
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-flag-alt"></i>
                                Actualités Internationales
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-bolt"></i>
                                Flash News
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-video-camera"></i>
                                Reportages
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- 5. SPORT avec dropdown --}}
                <li class="nav-item has-dropdown {{ Request::is('sport*') || Request::is('sections/sport*') ? 'active' : '' }}">
                    <a href="{{ route('sections.sport') }}" class="nav-link">
                        <span>Sport</span>
                        <i class="ti-angle-down dropdown-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <a href="{{ route('sections.sport') }}">
                                <i class="ti-basketball"></i>
                                Tous les sports
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-medall"></i>
                                Football
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-cup"></i>
                                Basketball
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-flag"></i>
                                Athlétisme
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-star"></i>
                                Autres sports
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- 6. CULTURE avec dropdown --}}
                <li class="nav-item has-dropdown {{ Request::is('culture*') ? 'active' : '' }}">
                    <a href="#" class="nav-link">
                        <span>Culture</span>
                        <i class="ti-angle-down dropdown-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-music-alt"></i>
                                Musique
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-video-clapper"></i>
                                Cinéma
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-book"></i>
                                Littérature
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-paint-bucket"></i>
                                Arts
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-microphone"></i>
                                Spectacles
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- 7. OPINIONS --}}
                <li class="nav-item {{ Request::is('opinions*') ? 'active' : '' }}">
                    <a href="#" class="nav-link">
                        <span>Opinions</span>
                    </a>
                </li>

                {{-- 8. CONTACT --}}
                <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                    <a href="/contact" class="nav-link">
                        <span>Contact</span>
                    </a>
                </li>

                {{-- 9. SPÉCIAL avec dropdown --}}
                <li class="nav-item has-dropdown special-menu">
                    <a href="#" class="nav-link">
                        <i class="ti-star"></i>
                        <span>Spécial</span>
                        <i class="ti-angle-down dropdown-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <a href="{{ route('english_tips.index') }}">
                                <i class="ti-book"></i>
                                English Tips
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{ route('person.week') }}">
                                <i class="ti-user"></i>
                                Person of the Week
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{ route('event.index') }}">
                                <i class="ti-calendar"></i>
                                Save The Date
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{ route('entrepreneurship.index') }}">
                                <i class="ti-briefcase"></i>
                                Entrepreneurship
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-heart"></i>
                                Coups de cœur
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- 10. SECTIONS avec dropdown --}}
                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link">
                        <i class="ti-layout-media-overlay"></i>
                        <span>Sections</span>
                        <i class="ti-angle-down dropdown-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-money"></i>
                                Économie
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-crown"></i>
                                Politique
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-pulse"></i>
                                Santé
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-blackboard"></i>
                                Éducation
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <i class="ti-rocket"></i>
                                Tech & Innovation
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- 11. RECHERCHE --}}
                <li class="nav-item nav-search">
                    <button class="nav-link search-toggle" aria-label="Rechercher">
                        <i class="ti-search"></i>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Barre de recherche déroulante --}}
<div class="search-dropdown">
    <div class="container">
        <form action="/search" method="GET" class="search-form-dropdown">
            <div class="search-input-wrapper">
                <i class="ti-search search-icon"></i>
                <input type="text" name="q" placeholder="Rechercher des articles, catégories..." class="search-input-main" autocomplete="off">
                <button type="button" class="search-close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <button type="submit" class="search-submit-btn">
                <i class="ti-search"></i>
                <span>Rechercher</span>
            </button>
        </form>
    </div>
</div>

{{-- Menu Mobile Overlay --}}
<div class="mobile-menu-overlay"></div>
<div class="mobile-menu-sidebar">
    <div class="mobile-menu-header">
        <img src="{{ asset('assets/imgs/logo-2.png') }}" alt="InCotedivoire" class="mobile-logo">
        <button class="mobile-menu-close" aria-label="Fermer menu">
            <i class="ti-close"></i>
        </button>
    </div>
    <div class="mobile-menu-content">
        {{-- Le contenu sera dupliqué par JavaScript --}}
    </div>
</div>
