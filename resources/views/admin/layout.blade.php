<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Mobilier Addict') }}</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
        @stack('styles')
    </head>
    <body class="admin-body">
        @php
            $openProducts = request()->routeIs('admin.products.*') || request()->routeIs('admin.categories.*');
            $openSales = request()->routeIs('admin.orders.*');
            $openHome = request()->routeIs('admin.featured_categories.*');
            $openContent = request()->routeIs('admin.home_sections.*') || request()->routeIs('admin.space_sections.*');
        @endphp
        <div class="container-fluid px-0">
            <div class="d-flex min-vh-100">
                <aside class="admin-sidebar d-none d-lg-flex flex-column" style="width: 288px;">
                    <div class="p-4 border-bottom" style="border-color: var(--admin-border) !important;">
                        <div class="admin-brand">Mobilier Addict</div>
                        <div class="small" style="color: var(--admin-muted);">Dashboard Admin</div>
                    </div>

                    <div class="p-3">
                        <nav class="nav flex-column admin-nav gap-1">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <span class="admin-dot"></span>
                                Dashboard
                            </a>

                            <a class="nav-link {{ $openHome ? 'active' : '' }}" data-bs-toggle="collapse" href="#adminMenuHome" role="button" aria-expanded="{{ $openHome ? 'true' : 'false' }}" aria-controls="adminMenuHome">
                                <span class="admin-dot"></span>
                                Home
                            </a>
                            <div class="collapse {{ $openHome ? 'show' : '' }}" id="adminMenuHome">
                                <div class="ps-3 ms-2 mt-1 d-grid gap-1">
                                    <a class="nav-link {{ request()->routeIs('admin.featured_categories.*') ? 'active' : '' }}" href="{{ route('admin.featured_categories.index') }}"><span class="admin-dot"></span> Catégories Phares</a>
                                </div>
                            </div>

                            <a class="nav-link {{ $openProducts ? 'active' : '' }}" data-bs-toggle="collapse" href="#adminMenuProducts" role="button" aria-expanded="{{ $openProducts ? 'true' : 'false' }}" aria-controls="adminMenuProducts">
                                <span class="admin-dot"></span>
                                Gestion des produits
                            </a>
                            <div class="collapse {{ $openProducts ? 'show' : '' }}" id="adminMenuProducts">
                                <div class="ps-3 ms-2 mt-1 d-grid gap-1">
                                    <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}"><span class="admin-dot"></span> Produits</a>
                                    <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}"><span class="admin-dot"></span> Catégories</a>
                                </div>
                            </div>

                            <a class="nav-link {{ $openSales ? 'active' : '' }}" data-bs-toggle="collapse" href="#adminMenuSales" role="button" aria-expanded="{{ $openSales ? 'true' : 'false' }}" aria-controls="adminMenuSales">
                                <span class="admin-dot"></span>
                                Ventes
                            </a>
                            <div class="collapse {{ $openSales ? 'show' : '' }}" id="adminMenuSales">
                                <div class="ps-3 ms-2 mt-1 d-grid gap-1">
                                    <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}"><span class="admin-dot"></span> Gestion des commandes</a>
                                    <a class="nav-link disabled" href="#" aria-disabled="true" tabindex="-1"><span class="admin-dot"></span> Gestion des paniers <span class="ms-2 badge rounded-pill" style="background: rgba(255,255,255,.08); color: var(--admin-muted);">Bientôt</span></a>
                                    <a class="nav-link disabled" href="#" aria-disabled="true" tabindex="-1"><span class="admin-dot"></span> Gestion des factures <span class="ms-2 badge rounded-pill" style="background: rgba(255,255,255,.08); color: var(--admin-muted);">Bientôt</span></a>
                                </div>
                            </div>

                            <a class="nav-link" data-bs-toggle="collapse" href="#adminMenuCustomers" role="button" aria-expanded="false" aria-controls="adminMenuCustomers">
                                <span class="admin-dot"></span>
                                Clients
                            </a>
                            <div class="collapse" id="adminMenuCustomers">
                                <div class="ps-3 ms-2 mt-1 d-grid gap-1">
                                    <a class="nav-link disabled" href="#" aria-disabled="true" tabindex="-1"><span class="admin-dot"></span> Gestion des clients <span class="ms-2 badge rounded-pill" style="background: rgba(255,255,255,.08); color: var(--admin-muted);">Bientôt</span></a>
                                </div>
                            </div>

                            <a class="nav-link {{ $openContent ? 'active' : '' }}" data-bs-toggle="collapse" href="#adminMenuContent" role="button" aria-expanded="{{ $openContent ? 'true' : 'false' }}" aria-controls="adminMenuContent">
                                <span class="admin-dot"></span>
                                Contenu
                            </a>
                            <div class="collapse {{ $openContent ? 'show' : '' }}" id="adminMenuContent">
                                <div class="ps-3 ms-2 mt-1 d-grid gap-1">
                                    <a class="nav-link disabled" href="#" aria-disabled="true" tabindex="-1"><span class="admin-dot"></span> Blogs <span class="ms-2 badge rounded-pill" style="background: rgba(255,255,255,.08); color: var(--admin-muted);">Bientôt</span></a>
                                    <a class="nav-link {{ request()->routeIs('admin.home_sections.*') ? 'active' : '' }}" href="{{ route('admin.home_sections.index') }}"><span class="admin-dot"></span> Gestion des sections</a>
                                    <a class="nav-link {{ request()->routeIs('admin.space_sections.*') ? 'active' : '' }}" href="{{ route('admin.space_sections.index') }}"><span class="admin-dot"></span> Section Espaces</a>
                                    <a class="nav-link disabled" href="#" aria-disabled="true" tabindex="-1"><span class="admin-dot"></span> Slider <span class="ms-2 badge rounded-pill" style="background: rgba(255,255,255,.08); color: var(--admin-muted);">Bientôt</span></a>
                                    <a class="nav-link disabled" href="#" aria-disabled="true" tabindex="-1"><span class="admin-dot"></span> Gestion des menus <span class="ms-2 badge rounded-pill" style="background: rgba(255,255,255,.08); color: var(--admin-muted);">Bientôt</span></a>
                                </div>
                            </div>

                            <a class="nav-link" data-bs-toggle="collapse" href="#adminMenuMarketing" role="button" aria-expanded="false" aria-controls="adminMenuMarketing">
                                <span class="admin-dot"></span>
                                Marketing
                            </a>
                            <div class="collapse" id="adminMenuMarketing">
                                <div class="ps-3 ms-2 mt-1 d-grid gap-1">
                                    <a class="nav-link disabled" href="#" aria-disabled="true" tabindex="-1"><span class="admin-dot"></span> Newsletters <span class="ms-2 badge rounded-pill" style="background: rgba(255,255,255,.08); color: var(--admin-muted);">Bientôt</span></a>
                                </div>
                            </div>
                        </nav>
                    </div>

                    <div class="mt-auto p-3 border-top" style="border-color: var(--admin-border) !important;">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-admin-ghost w-100 text-start">Se déconnecter</button>
                        </form>
                    </div>
                </aside>

                <div class="flex-grow-1 min-w-0">
                    <header class="admin-topbar">
                        <div class="d-flex align-items-center justify-content-between gap-3 px-3 px-md-4 py-3">
                            <div class="d-flex align-items-center gap-3">
                                <button class="btn btn-admin-ghost d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar" aria-controls="adminSidebar">
                                    Menu
                                </button>
                                <div>
                                    <div class="small" style="color: var(--admin-muted);">Connecté</div>
                                    <div class="fw-semibold">{{ auth()->user()->name }}</div>
                                </div>
                            </div>

                            <a href="{{ route('home') }}" class="btn btn-admin-ghost">Voir le site</a>
                        </div>
                    </header>

                    <main class="py-4 py-md-5">
                        <div class="container">
                            @yield('content')
                        </div>
                    </main>
                </div>
            </div>
        </div>

        <div class="offcanvas offcanvas-start admin-offcanvas d-lg-none" tabindex="-1" id="adminSidebar" aria-labelledby="adminSidebarLabel">
            <div class="offcanvas-header border-bottom" style="border-color: var(--admin-border) !important;">
                <div>
                    <div class="admin-brand" id="adminSidebarLabel">Mobilier Addict</div>
                    <div class="small" style="color: var(--admin-muted);">Dashboard Admin</div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-3">
                <nav class="nav flex-column admin-nav gap-1">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <span class="admin-dot"></span>
                        Dashboard
                    </a>

                    <a class="nav-link {{ $openHome ? 'active' : '' }}" data-bs-toggle="collapse" href="#adminMenuHomeMobile" role="button" aria-expanded="{{ $openHome ? 'true' : 'false' }}" aria-controls="adminMenuHomeMobile">
                        <span class="admin-dot"></span>
                        Home
                    </a>
                    <div class="collapse {{ $openHome ? 'show' : '' }}" id="adminMenuHomeMobile">
                        <div class="ps-3 ms-2 mt-1 d-grid gap-1">
                            <a class="nav-link {{ request()->routeIs('admin.featured_categories.*') ? 'active' : '' }}" href="{{ route('admin.featured_categories.index') }}"><span class="admin-dot"></span> Catégories Phares</a>
                        </div>
                    </div>

                    <a class="nav-link {{ $openProducts ? 'active' : '' }}" data-bs-toggle="collapse" href="#adminMenuProductsMobile" role="button" aria-expanded="{{ $openProducts ? 'true' : 'false' }}" aria-controls="adminMenuProductsMobile">
                        <span class="admin-dot"></span>
                        Gestion des produits
                    </a>
                    <div class="collapse {{ $openProducts ? 'show' : '' }}" id="adminMenuProductsMobile">
                        <div class="ps-3 ms-2 mt-1 d-grid gap-1">
                            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}"><span class="admin-dot"></span> Produits</a>
                            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}"><span class="admin-dot"></span> Catégories</a>
                        </div>
                    </div>

                    <a class="nav-link {{ $openSales ? 'active' : '' }}" data-bs-toggle="collapse" href="#adminMenuSalesMobile" role="button" aria-expanded="{{ $openSales ? 'true' : 'false' }}" aria-controls="adminMenuSalesMobile">
                        <span class="admin-dot"></span>
                        Ventes
                    </a>
                    <div class="collapse {{ $openSales ? 'show' : '' }}" id="adminMenuSalesMobile">
                        <div class="ps-3 ms-2 mt-1 d-grid gap-1">
                            <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}"><span class="admin-dot"></span> Gestion des commandes</a>
                            <a class="nav-link disabled" href="#" aria-disabled="true" tabindex="-1"><span class="admin-dot"></span> Gestion des paniers <span class="ms-2 badge rounded-pill" style="background: rgba(255,255,255,.08); color: var(--admin-muted);">Bientôt</span></a>
                            <a class="nav-link disabled" href="#" aria-disabled="true" tabindex="-1"><span class="admin-dot"></span> Gestion des factures <span class="ms-2 badge rounded-pill" style="background: rgba(255,255,255,.08); color: var(--admin-muted);">Bientôt</span></a>
                        </div>
                    </div>

                    <a class="nav-link" data-bs-toggle="collapse" href="#adminMenuCustomersMobile" role="button" aria-expanded="false" aria-controls="adminMenuCustomersMobile">
                        <span class="admin-dot"></span>
                        Clients
                    </a>
                    <div class="collapse" id="adminMenuCustomersMobile">
                        <div class="ps-3 ms-2 mt-1 d-grid gap-1">
                            <a class="nav-link disabled" href="#" aria-disabled="true" tabindex="-1"><span class="admin-dot"></span> Gestion des clients <span class="ms-2 badge rounded-pill" style="background: rgba(255,255,255,.08); color: var(--admin-muted);">Bientôt</span></a>
                        </div>
                    </div>

                    <a class="nav-link {{ $openContent ? 'active' : '' }}" data-bs-toggle="collapse" href="#adminMenuContentMobile" role="button" aria-expanded="{{ $openContent ? 'true' : 'false' }}" aria-controls="adminMenuContentMobile">
                        <span class="admin-dot"></span>
                        Contenu
                    </a>
                    <div class="collapse {{ $openContent ? 'show' : '' }}" id="adminMenuContentMobile">
                        <div class="ps-3 ms-2 mt-1 d-grid gap-1">
                            <a class="nav-link disabled" href="#" aria-disabled="true" tabindex="-1"><span class="admin-dot"></span> Blogs <span class="ms-2 badge rounded-pill" style="background: rgba(255,255,255,.08); color: var(--admin-muted);">Bientôt</span></a>
                            <a class="nav-link {{ request()->routeIs('admin.home_sections.*') ? 'active' : '' }}" href="{{ route('admin.home_sections.index') }}"><span class="admin-dot"></span> Gestion des sections</a>
                            <a class="nav-link {{ request()->routeIs('admin.space_sections.*') ? 'active' : '' }}" href="{{ route('admin.space_sections.index') }}"><span class="admin-dot"></span> Section Espaces</a>
                            <a class="nav-link disabled" href="#" aria-disabled="true" tabindex="-1"><span class="admin-dot"></span> Slider <span class="ms-2 badge rounded-pill" style="background: rgba(255,255,255,.08); color: var(--admin-muted);">Bientôt</span></a>
                            <a class="nav-link disabled" href="#" aria-disabled="true" tabindex="-1"><span class="admin-dot"></span> Gestion des menus <span class="ms-2 badge rounded-pill" style="background: rgba(255,255,255,.08); color: var(--admin-muted);">Bientôt</span></a>
                        </div>
                    </div>

                    <a class="nav-link" data-bs-toggle="collapse" href="#adminMenuMarketingMobile" role="button" aria-expanded="false" aria-controls="adminMenuMarketingMobile">
                        <span class="admin-dot"></span>
                        Marketing
                    </a>
                    <div class="collapse" id="adminMenuMarketingMobile">
                        <div class="ps-3 ms-2 mt-1 d-grid gap-1">
                            <a class="nav-link disabled" href="#" aria-disabled="true" tabindex="-1"><span class="admin-dot"></span> Newsletters <span class="ms-2 badge rounded-pill" style="background: rgba(255,255,255,.08); color: var(--admin-muted);">Bientôt</span></a>
                        </div>
                    </div>
                </nav>

                <div class="mt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-admin-ghost w-100 text-start">Se déconnecter</button>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        @stack('scripts')
    </body>
</html>
