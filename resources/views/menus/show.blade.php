@extends('layouts.front')

@section('title', $pageTitle)
@section('meta_description', 'Découvrez nos produits pour ' . $pageTitle . ' sur Mobilier Addict.')

@section('content')
@php $isMatelasMenu = strtolower(trim((string) ($menu->slug ?? ''))) === 'matelas'; @endphp

@if($isMatelasMenu)
    <style>
        .matelas-hero{padding:44px 0 26px;background:radial-gradient(1000px 420px at 20% 10%, rgba(255,58,127,.12), rgba(255,58,127,0)), radial-gradient(900px 420px at 90% 0%, rgba(17,24,39,.09), rgba(17,24,39,0));}
        .matelas-hero__grid{display:grid;grid-template-columns:1.25fr .75fr;gap:24px;align-items:center;}
        .matelas-hero__badge{display:inline-flex;align-items:center;gap:8px;padding:8px 12px;border-radius:999px;background:#fff;border:1px solid #f1f5f9;font-weight:700;color:#111827;}
        .matelas-hero__title{font-size:44px;line-height:1.05;margin:14px 0 10px;color:#0f172a;letter-spacing:-.02em;}
        .matelas-hero__subtitle{font-size:16px;color:#475569;max-width:60ch;}
        .matelas-hero__cta{display:flex;gap:12px;flex-wrap:wrap;margin-top:18px;}
        .matelas-btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;border-radius:14px;padding:12px 16px;font-weight:800;text-decoration:none;}
        .matelas-btn--primary{background:linear-gradient(135deg,#ff3a7f,#ff6a3a);color:#fff;box-shadow:0 18px 36px rgba(255,58,127,.25);}
        .matelas-btn--ghost{background:#fff;color:#111827;border:1px solid #e2e8f0;}
        .matelas-proof{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px;margin-top:18px;}
        .matelas-proof__item{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:12px 12px;display:flex;gap:10px;align-items:flex-start;}
        .matelas-proof__icon{width:34px;height:34px;border-radius:12px;background:#111827;color:#fff;display:flex;align-items:center;justify-content:center;flex:0 0 auto;}
        .matelas-proof__txt{color:#0f172a;font-weight:800;font-size:13px;line-height:1.25;}
        .matelas-proof__sub{display:block;color:#64748b;font-weight:600;font-size:12px;margin-top:2px;}
        .matelas-panel{background:#fff;border:1px solid #e2e8f0;border-radius:22px;padding:18px;}
        .matelas-panel__title{font-weight:900;color:#0f172a;font-size:14px;margin:0 0 10px;}
        .matelas-panel__list{display:grid;gap:10px;margin:0;padding:0;list-style:none;}
        .matelas-panel__li{display:flex;gap:10px;align-items:flex-start;color:#475569;font-weight:700;font-size:13px;}
        .matelas-panel__li svg{flex:0 0 auto;margin-top:2px;}
        .matelas-models{padding:26px 0 44px;}
        .matelas-models__header{display:flex;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:14px;}
        .matelas-models__title{font-size:22px;line-height:1.1;margin:0;color:#0f172a;font-weight:950;}
        .matelas-models__desc{color:#64748b;font-weight:700;margin:6px 0 0;font-size:13px;}
        .matelas-models__grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;}
        .matelas-card{background:#fff;border:1px solid #e2e8f0;border-radius:22px;overflow:hidden;display:flex;flex-direction:column;min-height:320px;transition:transform .18s ease, box-shadow .18s ease;}
        .matelas-card:hover{transform:translateY(-2px);box-shadow:0 18px 40px rgba(2,6,23,.08);}
        .matelas-card__media{aspect-ratio:1.2/1;position:relative;background:linear-gradient(135deg,#f8fafc,#fff);}
        .matelas-card__media img{width:100%;height:100%;object-fit:cover;display:block;}
        .matelas-card__pill{position:absolute;top:12px;left:12px;padding:8px 10px;border-radius:999px;background:rgba(15,23,42,.85);color:#fff;font-weight:900;font-size:11px;}
        .matelas-card__body{padding:14px 14px 16px;display:flex;flex-direction:column;gap:10px;flex:1;}
        .matelas-card__name{font-weight:950;color:#0f172a;margin:0;font-size:14px;line-height:1.15;}
        .matelas-card__meta{color:#64748b;font-weight:700;font-size:12px;line-height:1.25;margin:0;min-height:30px;}
        .matelas-card__footer{margin-top:auto;display:flex;align-items:center;justify-content:space-between;gap:10px;}
        .matelas-card__price{font-weight:950;color:#0f172a;font-size:16px;}
        .matelas-card__link{display:inline-flex;align-items:center;gap:8px;font-weight:900;text-decoration:none;color:#ff3a7f;}
        @media (max-width: 991px){
            .matelas-hero__grid{grid-template-columns:1fr;}
            .matelas-models__grid{grid-template-columns:repeat(2,minmax(0,1fr));}
        }
        @media (max-width: 520px){
            .matelas-hero__title{font-size:34px;}
            .matelas-proof{grid-template-columns:1fr;}
            .matelas-models__grid{grid-template-columns:1fr;}
        }
    </style>

    <section class="matelas-hero" aria-label="{{ $pageTitle }}">
        <div class="container">
            <div class="matelas-hero__grid">
                <div>
                    <span class="matelas-hero__badge">Matelas premium</span>
                    <h1 class="matelas-hero__title">Trouvez le matelas parfait pour un sommeil profond.</h1>
                    <p class="matelas-hero__subtitle">Extra-ferme, soft, équilibré ou luxury. Choisis ton niveau de soutien et profite d’un confort durable, conçu pour le dos.</p>

                    <div class="matelas-hero__cta">
                        <a class="matelas-btn matelas-btn--primary" href="#modeles">Voir les modèles</a>
                        <a class="matelas-btn matelas-btn--ghost" href="https://wa.me/2250700000000?text=Bonjour%2C%20je%20veux%20un%20conseil%20pour%20choisir%20mon%20matelas." target="_blank" rel="noopener">Conseil WhatsApp</a>
                    </div>

                    <div class="matelas-proof">
                        <div class="matelas-proof__item">
                            <div class="matelas-proof__icon">✓</div>
                            <div class="matelas-proof__txt">Soutien du dos
                                <span class="matelas-proof__sub">posture & confort</span>
                            </div>
                        </div>
                        <div class="matelas-proof__item">
                            <div class="matelas-proof__icon">⚡</div>
                            <div class="matelas-proof__txt">Livraison rapide
                                <span class="matelas-proof__sub">Côte d’Ivoire</span>
                            </div>
                        </div>
                        <div class="matelas-proof__item">
                            <div class="matelas-proof__icon">★</div>
                            <div class="matelas-proof__txt">Best-sellers
                                <span class="matelas-proof__sub">modèles éprouvés</span>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="matelas-panel" aria-label="Guide express">
                    <div class="matelas-panel__title">Guide express : quel modèle choisir ?</div>
                    <ul class="matelas-panel__list">
                        <li class="matelas-panel__li">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="#0f172a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Extra ferme : idéal dos sensible
                        </li>
                        <li class="matelas-panel__li">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="#0f172a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Soft : accueil moelleux, confort cocoon
                        </li>
                        <li class="matelas-panel__li">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="#0f172a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Addict : équilibre soutien / confort
                        </li>
                        <li class="matelas-panel__li">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="#0f172a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Luxury : finition premium & sensations haut de gamme
                        </li>
                    </ul>
                </aside>
            </div>
        </div>
    </section>

    <section class="matelas-models" id="modeles" aria-label="Modèles de matelas">
        <div class="container">
            <div class="matelas-models__header">
                <div>
                    <h2 class="matelas-models__title">Nos modèles phares</h2>
                    <p class="matelas-models__desc">Sélectionne un modèle pour voir les prix, les variantes (épaisseur/places) et commander.</p>
                </div>
            </div>

            <div class="matelas-models__grid">
                @foreach(($matelasModels ?? collect()) as $row)
                    @php
                        $p = $row['product'] ?? null;
                        $label = (string) ($row['label'] ?? 'Matelas');
                        $img = $p && $p->image ? asset($p->image) : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=900&h=700&fit=crop';
                        $slug = $p?->slug;
                        $price = $p?->price;
                        $spec = $p?->short_description ?: ($p?->material ?: 'Confort & soutien du dos');
                    @endphp
                    <article class="matelas-card">
                        <div class="matelas-card__media">
                            <img src="{{ $img }}" alt="{{ $label }}" loading="lazy" />
                            <span class="matelas-card__pill">{{ $label }}</span>
                        </div>
                        <div class="matelas-card__body">
                            <h3 class="matelas-card__name">{{ $label }}</h3>
                            <p class="matelas-card__meta">{{ $spec }}</p>
                            <div class="matelas-card__footer">
                                <div class="matelas-card__price">{{ $price !== null ? number_format((float) $price, 0, ',', '.') . 'F' : '' }}</div>
                                @if($slug)
                                    <a class="matelas-card__link" href="{{ route('product.show', $slug) }}">Voir <span aria-hidden="true">→</span></a>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div style="margin-top:18px;display:flex;gap:12px;flex-wrap:wrap;">
                <a class="matelas-btn matelas-btn--primary" href="{{ route('menu.show', 'matelas') }}">Voir tous les matelas</a>
                <a class="matelas-btn matelas-btn--ghost" href="https://wa.me/2250700000000?text=Bonjour%2C%20je%20veux%20commander%20un%20matelas.%20Pouvez-vous%20me%20conseiller%20un%20mod%C3%A8le%20%3F" target="_blank" rel="noopener">Commander via WhatsApp</a>
            </div>
        </div>
    </section>
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
