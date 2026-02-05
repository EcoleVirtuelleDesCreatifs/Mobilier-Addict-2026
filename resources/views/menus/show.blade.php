@extends('layouts.front')

@section('title', $pageTitle)
@section('meta_description', 'Découvrez nos produits pour ' . $pageTitle . ' sur Mobilier Addict.')

@section('content')
@php $isMatelasMenu = strtolower(trim((string) ($menu->slug ?? ''))) === 'matelas'; @endphp

@if($isMatelasMenu)
    <style>
        .matelas-page{
            --ma-rose:#ff3a7f;
            --ma-navy:#0b1b3a;
            --ma-ink:#071126;
            --ma-sky:#6ee7ff;
            --ma-border:#e2e8f0;
            --ma-muted:#64748b;
            background:linear-gradient(180deg,#fff,#f8fafc);
        }
        .matelas-hero{padding:64px 0 18px;background:radial-gradient(1000px 420px at 18% 10%, rgba(11,27,58,.10), rgba(11,27,58,0)), radial-gradient(900px 420px at 92% 0%, rgba(255,58,127,.16), rgba(255,58,127,0));}
        .matelas-kicker{font-weight:950;color:var(--ma-navy);letter-spacing:.10em;text-transform:uppercase;font-size:12px;}
        .matelas-hero__title{font-size:54px;line-height:1.02;margin:12px 0 10px;color:var(--ma-ink);letter-spacing:-.03em;}
        .matelas-hero__subtitle{font-size:18px;color:#334155;max-width:72ch;margin:0;}
        .matelas-hero__cta{display:flex;gap:12px;flex-wrap:wrap;margin-top:20px;}

        .matelas-btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;border-radius:999px;padding:12px 16px;font-weight:900;text-decoration:none;}
        .matelas-btn--primary{background:linear-gradient(135deg,var(--ma-rose),#ff6a3a);color:#fff;box-shadow:0 22px 48px rgba(255,58,127,.28);}
        .matelas-btn--ghost{background:rgba(255,255,255,.75);backdrop-filter: blur(10px);color:var(--ma-navy);border:1px solid var(--ma-border);}

        .matelas-subnav{position:sticky;top:0;z-index:20;background:rgba(255,255,255,.75);backdrop-filter: blur(10px);border-top:1px solid #f1f5f9;border-bottom:1px solid #e2e8f0;}
        .matelas-subnav__inner{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:12px 0;}
        .matelas-subnav__title{font-weight:950;color:var(--ma-navy);font-size:13px;letter-spacing:-.01em;}
        .matelas-subnav__links{display:flex;gap:8px;overflow:auto;scrollbar-width:none;}
        .matelas-subnav__links::-webkit-scrollbar{display:none;}
        .matelas-chip{display:inline-flex;align-items:center;gap:8px;padding:10px 12px;border-radius:999px;border:1px solid var(--ma-border);background:#fff;color:var(--ma-navy);font-weight:900;font-size:12px;text-decoration:none;white-space:nowrap;}
        .matelas-chip:hover{border-color:#cbd5e1;}

        .matelas-section{padding:54px 0;}
        .matelas-section--alt{background:linear-gradient(180deg,var(--ma-navy),#050b18);}
        .matelas-section__grid{display:grid;grid-template-columns:1fr 1fr;gap:22px;align-items:center;}
        .matelas-section__eyebrow{font-weight:950;color:var(--ma-muted);text-transform:uppercase;letter-spacing:.10em;font-size:12px;}
        .matelas-section__name{font-weight:1000;color:var(--ma-ink);font-size:34px;line-height:1.05;letter-spacing:-.02em;margin:10px 0 10px;}
        .matelas-section--alt .matelas-section__name{color:#fff;}
        .matelas-section__desc{color:#475569;font-weight:700;max-width:60ch;margin:0;}
        .matelas-section--alt .matelas-section__desc{color:rgba(241,245,249,.82);}
        .matelas-bullets{display:grid;gap:10px;margin:18px 0 0;padding:0;list-style:none;}
        .matelas-bullets li{display:flex;gap:10px;align-items:flex-start;font-weight:800;color:#0b1220;}
        .matelas-section--alt .matelas-bullets li{color:#fff;}
        .matelas-bullets li span{color:#64748b;font-weight:700;display:block;margin-top:2px;}
        .matelas-section--alt .matelas-bullets li span{color:rgba(241,245,249,.72);}
        .matelas-media{border-radius:28px;overflow:hidden;border:1px solid #e2e8f0;background:linear-gradient(135deg,#f8fafc,#fff);box-shadow:0 30px 70px rgba(2,6,23,.08);}
        .matelas-section--alt .matelas-media{border-color:rgba(148,163,184,.2);box-shadow:0 30px 70px rgba(0,0,0,.35);}
        .matelas-media img{width:100%;height:100%;object-fit:cover;display:block;aspect-ratio: 4 / 3;}
        .matelas-actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:18px;}
        .matelas-link{display:inline-flex;align-items:center;gap:8px;font-weight:950;text-decoration:none;color:var(--ma-rose);}
        .matelas-section--alt .matelas-link{color:var(--ma-sky);}
        .matelas-actions form{margin:0;}
        .matelas-cartbtn{border:0;cursor:pointer;}

        .matelas-cat{padding:34px 0 14px;}
        .matelas-cat__head{display:flex;align-items:flex-end;justify-content:space-between;gap:14px;margin-bottom:12px;}
        .matelas-cat__title{margin:0;font-weight:1000;letter-spacing:-.02em;color:var(--ma-ink);font-size:22px;}
        .matelas-cat__meta{color:var(--ma-muted);font-weight:800;font-size:13px;margin:6px 0 0;}
        .matelas-cat__rail{display:flex;gap:12px;overflow:auto;padding:6px 2px 18px;scroll-snap-type:x mandatory;scrollbar-width:none;}
        .matelas-cat__rail::-webkit-scrollbar{display:none;}
        .matelas-cat__card{flex:0 0 340px;scroll-snap-align:start;background:#fff;border:1px solid var(--ma-border);border-radius:26px;overflow:hidden;box-shadow:0 16px 40px rgba(2,6,23,.06);transition:transform .18s ease, box-shadow .18s ease;}
        .matelas-cat__card:hover{transform:translateY(-2px);box-shadow:0 22px 54px rgba(2,6,23,.10);}
        .matelas-cat__media{aspect-ratio: 4 / 3;background:linear-gradient(135deg,#f8fafc,#fff);}
        .matelas-cat__media img{width:100%;height:100%;object-fit:cover;display:block;}
        .matelas-cat__body{padding:14px 14px 16px;display:flex;flex-direction:column;gap:10px;}
        .matelas-cat__name{margin:0;font-weight:1000;color:var(--ma-ink);font-size:15px;line-height:1.15;}
        .matelas-cat__desc{margin:0;color:#475569;font-weight:700;font-size:12px;min-height:34px;}
        .matelas-cat__foot{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-top:2px;}
        .matelas-cat__price{font-weight:1000;color:var(--ma-ink);}
        .matelas-quick{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:10px 12px;border-radius:999px;background:var(--ma-navy);color:#fff;font-weight:950;border:0;cursor:pointer;}
        .matelas-quick:hover{filter:brightness(1.06);}

        .matelas-modal{position:fixed;inset:0;display:none;align-items:flex-end;justify-content:center;z-index:60;}
        .matelas-modal.is-open{display:flex;}
        .matelas-modal__backdrop{position:absolute;inset:0;background:rgba(2,6,23,.55);backdrop-filter: blur(6px);}
        .matelas-modal__panel{position:relative;width:min(860px, calc(100% - 24px));margin:12px 12px 18px;border-radius:24px;overflow:hidden;background:#fff;border:1px solid var(--ma-border);box-shadow:0 30px 90px rgba(0,0,0,.28);}
        .matelas-modal__bar{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:14px 16px;background:linear-gradient(135deg,rgba(255,58,127,.10),rgba(11,27,58,.10));border-bottom:1px solid var(--ma-border);}
        .matelas-modal__title{font-weight:1000;color:var(--ma-ink);margin:0;font-size:14px;}
        .matelas-modal__close{border:0;background:#fff;color:var(--ma-navy);font-weight:1000;border-radius:999px;padding:10px 12px;cursor:pointer;border:1px solid var(--ma-border);}
        .matelas-modal__content{display:grid;grid-template-columns:1fr 1fr;gap:14px;padding:16px;}
        .matelas-modal__media{border-radius:18px;overflow:hidden;border:1px solid var(--ma-border);background:linear-gradient(135deg,#f8fafc,#fff);}
        .matelas-modal__media img{width:100%;height:100%;object-fit:cover;display:block;aspect-ratio: 4 / 3;}
        .matelas-modal__form{display:grid;gap:10px;align-content:start;}
        .matelas-field label{display:block;font-weight:950;color:var(--ma-navy);font-size:12px;margin-bottom:6px;}
        .matelas-select{width:100%;border:1px solid var(--ma-border);border-radius:14px;padding:12px 12px;font-weight:800;color:var(--ma-ink);background:#fff;}
        .matelas-modal__cta{display:flex;gap:10px;flex-wrap:wrap;margin-top:4px;}
        .matelas-modal__hint{color:#64748b;font-weight:800;font-size:12px;margin:0;}
        .matelas-modal__price{font-weight:1000;color:var(--ma-ink);font-size:18px;}

        .matelas-chip.is-active{border-color:rgba(255,58,127,.45);box-shadow:0 12px 24px rgba(255,58,127,.14);}

        .matelas-all{padding:40px 0 58px;}
        .matelas-all__title{font-size:22px;font-weight:1000;letter-spacing:-.02em;color:var(--ma-ink);margin:0;}
        .matelas-all__desc{color:var(--ma-muted);font-weight:700;margin:8px 0 0;}
        .matelas-all__grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;margin-top:18px;}
        .matelas-mini{background:#fff;border:1px solid #e2e8f0;border-radius:22px;overflow:hidden;display:flex;flex-direction:column;min-height:310px;transition:transform .18s ease, box-shadow .18s ease;}
        .matelas-mini:hover{transform:translateY(-2px);box-shadow:0 18px 40px rgba(2,6,23,.08);}
        .matelas-mini__media{aspect-ratio: 1.1 / 1;background:linear-gradient(135deg,#f8fafc,#fff);}
        .matelas-mini__media img{width:100%;height:100%;object-fit:cover;display:block;}
        .matelas-mini__body{padding:14px 14px 16px;display:flex;flex-direction:column;gap:10px;flex:1;}
        .matelas-mini__name{font-weight:1000;color:#0b1220;margin:0;font-size:14px;line-height:1.15;}
        .matelas-mini__meta{color:#64748b;font-weight:700;font-size:12px;line-height:1.25;margin:0;min-height:30px;}
        .matelas-mini__footer{margin-top:auto;display:flex;align-items:center;justify-content:space-between;gap:10px;}
        .matelas-mini__price{font-weight:1000;color:var(--ma-ink);font-size:16px;}
        .matelas-mini__footer form{margin:0;}
        .matelas-mini__add{padding:10px 12px;border-radius:999px;background:var(--ma-navy);color:#fff;font-weight:950;border:0;cursor:pointer;}
        .matelas-mini__add:hover{filter:brightness(1.06);}

        @media (max-width: 991px){
            .matelas-hero__title{font-size:44px;}
            .matelas-section__grid{grid-template-columns:1fr;}
            .matelas-all__grid{grid-template-columns:repeat(2,minmax(0,1fr));}
            .matelas-modal__content{grid-template-columns:1fr;}
        }
        @media (max-width: 520px){
            .matelas-hero{padding-top:46px;}
            .matelas-hero__title{font-size:36px;}
            .matelas-all__grid{grid-template-columns:1fr;}
        }
    </style>

    <div class="matelas-page">
        <section class="matelas-hero" aria-label="{{ $pageTitle }}">
            <div class="container">
                <div class="matelas-kicker">Matelas</div>
                <h1 class="matelas-hero__title">Quatre modèles. Un sommeil meilleur.</h1>
                <p class="matelas-hero__subtitle">Choisis le niveau de soutien qui te correspond. Ensuite, sélectionne l’épaisseur et le nombre de places sur chaque fiche produit.</p>

                <div class="matelas-hero__cta">
                    <a class="matelas-btn matelas-btn--primary" href="#decouvrir">Découvrir les modèles</a>
                    <a class="matelas-btn matelas-btn--ghost" href="https://wa.me/2250700000000?text=Bonjour%2C%20je%20veux%20un%20conseil%20pour%20choisir%20mon%20matelas." target="_blank" rel="noopener">Conseil WhatsApp</a>
                </div>
            </div>
        </section>

        <nav class="matelas-subnav" aria-label="Navigation catégories">
            <div class="container">
                <div class="matelas-subnav__inner">
                    <div class="matelas-subnav__title">Catégories</div>
                    <div class="matelas-subnav__links">
                        @foreach(($matelasCategories ?? collect()) as $cat)
                            @php
                                $catKey = (string) ($cat['key'] ?? 'confort');
                                $catLabel = (string) ($cat['label'] ?? 'Confort');
                            @endphp
                            <a class="matelas-chip" href="#cat-{{ $catKey }}">{{ $catLabel }}</a>
                        @endforeach
                        <a class="matelas-chip" href="#tous">Tous les matelas</a>
                    </div>
                </div>
            </div>
        </nav>

        <div id="decouvrir"></div>

        @foreach(($matelasCategoryGroups ?? collect()) as $g)
            @php
                $catKey = (string) ($g['key'] ?? 'confort');
                $catLabel = (string) ($g['label'] ?? 'Confort');
                $catProducts = $g['products'] ?? collect();
            @endphp

            <div id="cat-{{ $catKey }}" data-spy-section="{{ $catKey }}" style="position:relative;top:-84px;height:0;"></div>

            <section class="matelas-cat" aria-label="{{ $catLabel }}">
                <div class="container">
                    <div class="matelas-cat__head">
                        <div>
                            <h2 class="matelas-cat__title">{{ $catLabel }}</h2>
                            <p class="matelas-cat__meta">Fais défiler, compare, puis ajoute au panier sans quitter la page.</p>
                        </div>
                    </div>

                    <div class="matelas-cat__rail" role="list">
                        @foreach(($catProducts ?? collect()) as $product)
                            @php
                                $img = $product && $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1100&h=800&fit=crop';
                                $defaultVariant = $product?->variants?->sortBy('price')->first();
                                $price = $defaultVariant?->price ?? $product?->price;
                                $variantsData = ($product?->variants ?? collect())->map(fn($v) => [
                                    'id' => (int) $v->id,
                                    'thickness_cm' => $v->thickness_cm,
                                    'places' => $v->places,
                                    'price' => (float) $v->price,
                                    'stock' => $v->stock,
                                ])->values();
                            @endphp

                            <article class="matelas-cat__card" role="listitem">
                                <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                    <div class="matelas-cat__media"><img src="{{ $img }}" alt="{{ $product->name }}" loading="lazy"></div>
                                </a>
                                <div class="matelas-cat__body">
                                    <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                        <h3 class="matelas-cat__name">{{ $product->name }}</h3>
                                    </a>
                                    <p class="matelas-cat__desc">{{ $product->short_description ?: ($product->material ?: ' ') }}</p>
                                    <div class="matelas-cat__foot">
                                        <div class="matelas-cat__price">{{ $price !== null ? number_format((float) $price, 0, ',', '.') . 'F' : '' }}</div>
                                        <button
                                            class="matelas-quick"
                                            type="button"
                                            data-quick-add
                                            data-product-id="{{ $product->id }}"
                                            data-product-name="{{ e($product->name) }}"
                                            data-product-image="{{ $img }}"
                                            data-product-slug="{{ $product->slug }}"
                                            data-default-variant-id="{{ $defaultVariant?->id }}"
                                            data-variants='@json($variantsData)'
                                        >Ajouter</button>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endforeach

        <section class="matelas-all" id="tous" aria-label="Tous les matelas">
            <div class="container">
                <h2 class="matelas-all__title">Tous les matelas</h2>
                <p class="matelas-all__desc">Explore l’ensemble des modèles et trouve celui qui correspond à ton confort.</p>

                <div class="matelas-all__grid">
                    @foreach(($products ?? collect()) as $product)
                        @php
                            $specsParts = [];
                            if (!empty($product->size)) $specsParts[] = $product->size;
                            if (!empty($product->thickness)) $specsParts[] = 'Ép. ' . $product->thickness;
                            if (!empty($product->material)) $specsParts[] = $product->material;
                            $specs = implode(' • ', $specsParts);
                            $gridDefaultVariant = $product?->variants?->sortBy('price')->first();
                            $gridPrice = $gridDefaultVariant?->price ?? $product->price;
                        @endphp
                        <article class="matelas-mini">
                            <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                <div class="matelas-mini__media">
                                    <img src="{{ $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=700&h=700&fit=crop' }}" alt="{{ $product->name }}" loading="lazy" />
                                </div>
                            </a>
                            <div class="matelas-mini__body">
                                <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                    <h3 class="matelas-mini__name">{{ $product->name }}</h3>
                                </a>
                                <p class="matelas-mini__meta">{{ $specs ?: ($product->short_description ?: ' ') }}</p>
                                <div class="matelas-mini__footer">
                                    <div class="matelas-mini__price">{{ number_format((float) $gridPrice, 0, ',', '.') }}F</div>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="product_variant_id" value="{{ $gridDefaultVariant?->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="matelas-mini__add" type="submit">Ajouter</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if(method_exists($products, 'links'))
                    <div class="univers-pagination" style="margin-top: 22px">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </section>

        <div class="matelas-modal" id="matelasQuickAdd" aria-hidden="true">
            <div class="matelas-modal__backdrop" data-quick-close></div>
            <div class="matelas-modal__panel" role="dialog" aria-modal="true" aria-label="Ajouter au panier">
                <div class="matelas-modal__bar">
                    <p class="matelas-modal__title" id="quickTitle">Ajouter au panier</p>
                    <button class="matelas-modal__close" type="button" data-quick-close>Fermer</button>
                </div>
                <div class="matelas-modal__content">
                    <div class="matelas-modal__media"><img id="quickImage" alt="" src=""></div>
                    <div>
                        <form class="matelas-modal__form" action="{{ route('cart.add') }}" method="POST" id="quickForm">
                            @csrf
                            <input type="hidden" name="product_id" id="quickProductId" value="">
                            <input type="hidden" name="product_variant_id" id="quickVariantId" value="">
                            <input type="hidden" name="quantity" value="1">

                            <p class="matelas-modal__hint">Sélectionne une épaisseur et le nombre de places. Le prix se met à jour instantanément.</p>

                            <div class="matelas-field">
                                <label for="quickThickness">Épaisseur</label>
                                <select class="matelas-select" id="quickThickness"></select>
                            </div>

                            <div class="matelas-field">
                                <label for="quickPlaces">Places</label>
                                <select class="matelas-select" id="quickPlaces"></select>
                            </div>

                            <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
                                <div class="matelas-modal__price" id="quickPrice"></div>
                                <a class="matelas-link" id="quickLink" href="#">Voir le produit <span aria-hidden="true">→</span></a>
                            </div>

                            <div class="matelas-modal__cta">
                                <button class="matelas-btn matelas-btn--primary matelas-cartbtn" type="submit">Ajouter au panier</button>
                                <a class="matelas-btn matelas-btn--ghost" id="quickWhats" href="#" target="_blank" rel="noopener">Commander via WhatsApp</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function(){
            const chips = Array.from(document.querySelectorAll('.matelas-subnav__links .matelas-chip'))
                .filter(a => (a.getAttribute('href') || '').startsWith('#cat-'));

            const sections = Array.from(document.querySelectorAll('[data-spy-section]'));
            if (chips.length && sections.length && 'IntersectionObserver' in window) {
                const obs = new IntersectionObserver((entries) => {
                    const visible = entries
                        .filter(e => e.isIntersecting)
                        .sort((a,b) => (b.intersectionRatio || 0) - (a.intersectionRatio || 0))[0];
                    if (!visible) return;
                    const key = visible.target.getAttribute('data-spy-section');
                    chips.forEach(c => c.classList.toggle('is-active', (c.getAttribute('href') || '') === '#cat-' + key));
                }, { root: null, threshold: [0.15, 0.25, 0.35], rootMargin: '-20% 0px -60% 0px' });
                sections.forEach(s => obs.observe(s));
            }

            const modal = document.getElementById('matelasQuickAdd');
            const form = document.getElementById('quickForm');
            const title = document.getElementById('quickTitle');
            const img = document.getElementById('quickImage');
            const pid = document.getElementById('quickProductId');
            const vid = document.getElementById('quickVariantId');
            const thick = document.getElementById('quickThickness');
            const places = document.getElementById('quickPlaces');
            const price = document.getElementById('quickPrice');
            const link = document.getElementById('quickLink');
            const whats = document.getElementById('quickWhats');

            let currentVariants = [];

            function money(v){
                try { return (Number(v) || 0).toLocaleString('fr-FR', {maximumFractionDigits:0}) + 'F'; } catch(e) { return v + 'F'; }
            }

            function uniq(arr){
                return Array.from(new Set(arr.filter(v => v !== null && v !== undefined && v !== '')));
            }

            function renderOptions(select, values, fmt){
                select.innerHTML = '';
                values.forEach(v => {
                    const opt = document.createElement('option');
                    opt.value = String(v);
                    opt.textContent = fmt ? fmt(v) : String(v);
                    select.appendChild(opt);
                });
            }

            function findVariant(th, pl){
                const t = th === null ? null : String(th);
                const p = pl === null ? null : String(pl);
                return currentVariants.find(v => String(v.thickness_cm) === t && String(v.places) === p) || null;
            }

            function syncFromSelection(){
                if (!currentVariants.length) {
                    vid.value = '';
                    price.textContent = '';
                    return;
                }

                let v = findVariant(thick.value, places.value);
                if (!v) {
                    const first = currentVariants[0];
                    renderOptions(thick, uniq(currentVariants.map(x => x.thickness_cm)).sort((a,b) => Number(a)-Number(b)), (x) => String(x) + ' cm');
                    renderOptions(places, uniq(currentVariants.map(x => x.places)).sort((a,b) => Number(a)-Number(b)), (x) => String(x) + ' places');
                    thick.value = String(first.thickness_cm);
                    places.value = String(first.places);
                    v = first;
                }

                vid.value = String(v.id);
                price.textContent = money(v.price);
            }

            function openModal(btn){
                const productId = btn.getAttribute('data-product-id');
                const productName = btn.getAttribute('data-product-name') || 'Produit';
                const productImage = btn.getAttribute('data-product-image') || '';
                const productSlug = btn.getAttribute('data-product-slug') || '';
                const variantsRaw = btn.getAttribute('data-variants') || '[]';

                try { currentVariants = JSON.parse(variantsRaw) || []; } catch(e) { currentVariants = []; }

                title.textContent = 'Ajouter — ' + productName;
                img.src = productImage;
                img.alt = productName;
                pid.value = productId || '';
                link.href = productSlug ? (window.location.origin + '/produit/' + productSlug) : '#';
                whats.href = 'https://wa.me/2250700000000?text=' + encodeURIComponent('Bonjour, je veux commander ' + productName + '.');

                if (!currentVariants.length) {
                    thick.innerHTML = '<option value="">—</option>';
                    places.innerHTML = '<option value="">—</option>';
                    vid.value = '';
                    price.textContent = '';
                } else {
                    const thicknesses = uniq(currentVariants.map(v => v.thickness_cm)).sort((a,b) => Number(a)-Number(b));
                    const placesList = uniq(currentVariants.map(v => v.places)).sort((a,b) => Number(a)-Number(b));
                    renderOptions(thick, thicknesses, (v) => String(v) + ' cm');
                    renderOptions(places, placesList, (v) => String(v) + ' places');
                    const cheapest = currentVariants.slice().sort((a,b) => Number(a.price)-Number(b.price))[0];
                    thick.value = String(cheapest.thickness_cm);
                    places.value = String(cheapest.places);
                    syncFromSelection();
                }

                modal.classList.add('is-open');
                modal.setAttribute('aria-hidden','false');
            }

            function closeModal(){
                modal.classList.remove('is-open');
                modal.setAttribute('aria-hidden','true');
            }

            document.addEventListener('click', (e) => {
                const btn = e.target.closest('[data-quick-add]');
                if (btn) {
                    e.preventDefault();
                    openModal(btn);
                    return;
                }
                if (e.target.closest('[data-quick-close]')) {
                    e.preventDefault();
                    closeModal();
                }
            });

            thick && thick.addEventListener('change', syncFromSelection);
            places && places.addEventListener('change', syncFromSelection);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
            });

            if (form) {
                form.addEventListener('submit', (e) => {
                    if (currentVariants.length && !vid.value) {
                        e.preventDefault();
                    }
                });
            }
        })();
    </script>
@else
    <section class="collection" aria-label="{{ $pageTitle }}">
        <div class="container">
            <div class="collection__header">
                <div class="collection__intro">
                    <span class="collection__badge">📌 Menu</span>
                    <h1 class="collection__title">{{ $pageTitle }}</h1>
                    <p class="collection__subtitle">Découvrez tous les produits disponibles pour cette rubrique.</p>
                </div>
            </div>

            @if(($products ?? collect())->isEmpty())
                <div style="padding:24px;border:1px solid #e2e8f0;border-radius:16px;background:#fff">
                    Aucun produit trouvé.
                </div>
            @endif

            <div class="collection__grid">
                @foreach(($products ?? collect()) as $product)
                    @php
                        $isFeatured = (bool) ($product->is_bestseller ?? false);
                        $tag = $product->firmness ? strtoupper(str_replace('_', '-', $product->firmness)) : null;
                        $specsParts = [];
                        if (!empty($product->size)) $specsParts[] = $product->size;
                        if (!empty($product->thickness)) $specsParts[] = 'Ép. ' . $product->thickness;
                        if (!empty($product->material)) $specsParts[] = $product->material;
                        $specs = implode(' • ', $specsParts);
                    @endphp

                    <article class="collection-card{{ $isFeatured ? ' collection-card--featured' : '' }}">
                        @if($isFeatured)
                            <div class="collection-card__badge">Best Seller</div>
                        @endif

                        <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                            <div class="collection-card__media">
                                <img src="{{ $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=500&h=500&fit=crop' }}" alt="{{ $product->name }}" loading="lazy" />
                                @if($tag)
                                    <span class="collection-card__tag">{{ $tag }}</span>
                                @endif
                            </div>
                        </a>

                        <div class="collection-card__body">
                            <div class="collection-card__rating">
                                <span class="collection-card__stars">★★★★★</span>
                                <span class="collection-card__reviews">({{ (int) ($product->reviews_count ?? 0) }} avis)</span>
                            </div>

                            <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                <h2 class="collection-card__name">{{ $product->name }}</h2>
                            </a>

                            @if($specs)
                                <p class="collection-card__specs">{{ $specs }}</p>
                            @else
                                <p class="collection-card__specs">&nbsp;</p>
                            @endif

                            <div class="collection-card__footer">
                                <span class="collection-card__price">{{ number_format((float) $product->price, 0, ',', '.') }}<small>F</small></span>

                                <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button class="collection-card__btn" type="submit" aria-label="Ajouter au panier">
                                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @if(method_exists($products, 'links'))
                <div class="univers-pagination" style="margin-top: 24px">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </section>
@endif
@endsection
