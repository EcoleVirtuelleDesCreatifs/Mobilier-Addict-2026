@extends('admin.layout')

@section('content')
    <div class="admin-card admin-card-soft admin-hero p-4 p-md-5 mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-4">
            <div>
                <div class="admin-pill">
                    <span class="admin-dot" style="background: var(--admin-blue);"></span>
                    Administration
                </div>
                <h1 class="display-6 fw-bold mt-3 mb-2">Tableau de bord</h1>
                <div style="color: var(--admin-muted);" class="fs-6">Gère ta boutique, ton contenu et tes mises en avant depuis un seul endroit.</div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="#" class="btn btn-admin-primary">Ajouter un produit</a>
                <a href="#" class="btn btn-admin-ghost">Voir les commandes</a>
            </div>
        </div>
    </div>

    <div class="row g-3 g-md-4 mb-2">
        <div class="col-12 col-lg-8">
            <div class="admin-card p-4 h-100">
                <div class="fw-bold">Raccourcis Home (sections)</div>
                <div class="small mt-1" style="color: var(--admin-muted);">Gère les blocs qui apparaissent sur la page d’accueil publique.</div>

                <div class="row g-2 mt-3">
                    <div class="col-12 col-md-6">
                        <div class="admin-card p-3" style="box-shadow:none;">
                            <div class="fw-semibold">Trouvez Votre Bonheur</div>
                            <div class="small" style="color: var(--admin-muted);">Section “Nos univers” (categories).</div>
                            <div class="d-flex gap-2 mt-3">
                                @if(isset($homeSections['categories']))
                                    <a class="btn btn-sm btn-admin-primary" href="{{ route('admin.home_sections.edit', $homeSections['categories']) }}">Gérer</a>
                                @else
                                    <a class="btn btn-sm btn-admin-primary" href="{{ route('admin.home_sections.index') }}">Créer / gérer</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="admin-card p-3" style="box-shadow:none;">
                            <div class="fw-semibold">Équipez Votre Maison</div>
                            <div class="small" style="color: var(--admin-muted);">Section “Électroménager & Meubles” (electro).</div>
                            <div class="d-flex gap-2 mt-3">
                                @if(isset($homeSections['electro']))
                                    <a class="btn btn-sm btn-admin-primary" href="{{ route('admin.home_sections.edit', $homeSections['electro']) }}">Gérer</a>
                                @else
                                    <a class="btn btn-sm btn-admin-primary" href="{{ route('admin.home_sections.index') }}">Créer / gérer</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="admin-card p-4 h-100">
                <div class="fw-bold">Gestion Home</div>
                <div class="small mt-1" style="color: var(--admin-muted);">Accès rapide aux réglages.</div>

                <div class="d-grid gap-2 mt-3">
                    <a href="{{ route('admin.home_sections.index') }}" class="btn btn-admin-ghost text-start">Sections Home</a>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-admin-ghost text-start">Catégories (images/ordre)</a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-admin-ghost text-start">Produits (stock/prix)</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 g-md-4">
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="admin-card p-4 h-100">
                <div class="d-flex align-items-start justify-content-between gap-3">
                    <div>
                        <div class="text-uppercase small" style="color: var(--admin-muted); letter-spacing: .14em;">Produits</div>
                        <div class="display-6 fw-bold mt-2 mb-0">{{ $stats['products'] }}</div>
                        <div class="small mt-2" style="color: var(--admin-muted);">Catalogue & mises en avant</div>
                    </div>
                    <div class="admin-icon"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="admin-card p-4 h-100">
                <div class="d-flex align-items-start justify-content-between gap-3">
                    <div>
                        <div class="text-uppercase small" style="color: var(--admin-muted); letter-spacing: .14em;">Catégories</div>
                        <div class="display-6 fw-bold mt-2 mb-0">{{ $stats['categories'] }}</div>
                        <div class="small mt-2" style="color: var(--admin-muted);">Organisation & navigation</div>
                    </div>
                    <div class="admin-icon cyan"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="admin-card p-4 h-100">
                <div class="d-flex align-items-start justify-content-between gap-3">
                    <div>
                        <div class="text-uppercase small" style="color: var(--admin-muted); letter-spacing: .14em;">Articles</div>
                        <div class="display-6 fw-bold mt-2 mb-0">{{ $stats['posts'] }}</div>
                        <div class="small mt-2" style="color: var(--admin-muted);">Contenu & SEO</div>
                    </div>
                    <div class="admin-icon indigo"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="admin-card p-4 h-100">
                <div class="d-flex align-items-start justify-content-between gap-3">
                    <div>
                        <div class="text-uppercase small" style="color: var(--admin-muted); letter-spacing: .14em;">Slides</div>
                        <div class="display-6 fw-bold mt-2 mb-0">{{ $stats['slides'] }}</div>
                        <div class="small mt-2" style="color: var(--admin-muted);">Hero & promotions</div>
                    </div>
                    <div class="admin-icon"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="admin-card p-4 h-100">
                <div class="d-flex align-items-start justify-content-between gap-3">
                    <div>
                        <div class="text-uppercase small" style="color: var(--admin-muted); letter-spacing: .14em;">Newsletter</div>
                        <div class="display-6 fw-bold mt-2 mb-0">{{ $stats['newsletter'] }}</div>
                        <div class="small mt-2" style="color: var(--admin-muted);">Communauté & conversions</div>
                    </div>
                    <div class="admin-icon cyan"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 g-md-4 mt-1">
        <div class="col-12 col-lg-6">
            <div class="admin-card p-4">
                <div class="fw-bold">Actions rapides</div>
                <div class="small mt-1" style="color: var(--admin-muted);">Raccourcis pour gérer plus vite.</div>

                <div class="row g-2 mt-3">
                    <div class="col-12 col-sm-6">
                        <a href="#" class="d-block text-decoration-none admin-card p-3" style="box-shadow:none;">
                            <div class="fw-semibold">Nouveau produit</div>
                            <div class="small" style="color: var(--admin-muted);">Ajouter au catalogue</div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6">
                        <a href="#" class="d-block text-decoration-none admin-card p-3" style="box-shadow:none;">
                            <div class="fw-semibold">Nouvel article</div>
                            <div class="small" style="color: var(--admin-muted);">Publier du contenu</div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6">
                        <a href="#" class="d-block text-decoration-none admin-card p-3" style="box-shadow:none;">
                            <div class="fw-semibold">Gérer le slider</div>
                            <div class="small" style="color: var(--admin-muted);">Mettre en avant</div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6">
                        <a href="#" class="d-block text-decoration-none admin-card p-3" style="box-shadow:none;">
                            <div class="fw-semibold">Exporter la newsletter</div>
                            <div class="small" style="color: var(--admin-muted);">Récupérer les inscrits</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="admin-card p-4">
                <div class="fw-bold">Conseil du jour</div>
                <div class="small mt-1" style="color: var(--admin-muted);">Une action simple pour booster les conversions.</div>

                <div class="admin-card p-4 mt-3" style="box-shadow:none;background:linear-gradient(180deg,rgba(59,130,246,.16) 0%,rgba(255,255,255,.03) 100%);border-color:rgba(59,130,246,.22);">
                    <div class="fw-semibold">Mets en avant 3 produits “Best Sellers”</div>
                    <div class="small mt-2" style="color: var(--admin-muted);">Ajoute-les sur la home et le slider pour créer un effet de preuve sociale et augmenter le taux de conversion.</div>
                </div>
            </div>
        </div>
    </div>
@endsection
