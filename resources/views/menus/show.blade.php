@extends('layouts.front')

@section('title', $pageTitle)
@section('meta_description', 'Découvrez nos produits pour ' . $pageTitle . ' sur Mobilier Addict.')

@section('content')
@php $isMatelasMenu = strtolower(trim((string) ($menu->slug ?? ''))) === 'matelas'; @endphp

@if($isMatelasMenu)
    <style>
        .matelas-page{background:linear-gradient(180deg,#fff,#f8fafc);}
        .matelas-hero{padding:64px 0 18px;background:radial-gradient(1000px 420px at 20% 10%, rgba(2,6,23,.06), rgba(2,6,23,0)), radial-gradient(900px 420px at 90% 0%, rgba(255,58,127,.10), rgba(255,58,127,0));}
        .matelas-kicker{font-weight:900;color:#0f172a;letter-spacing:.08em;text-transform:uppercase;font-size:12px;}
        .matelas-hero__title{font-size:54px;line-height:1.02;margin:12px 0 10px;color:#0b1220;letter-spacing:-.03em;}
        .matelas-hero__subtitle{font-size:18px;color:#475569;max-width:72ch;margin:0;}
        .matelas-hero__cta{display:flex;gap:12px;flex-wrap:wrap;margin-top:20px;}

        .matelas-btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;border-radius:999px;padding:12px 16px;font-weight:900;text-decoration:none;}
        .matelas-btn--primary{background:#0b1220;color:#fff;box-shadow:0 20px 44px rgba(2,6,23,.18);}
        .matelas-btn--ghost{background:rgba(255,255,255,.75);backdrop-filter: blur(10px);color:#0b1220;border:1px solid #e2e8f0;}

        .matelas-subnav{position:sticky;top:0;z-index:20;background:rgba(255,255,255,.75);backdrop-filter: blur(10px);border-top:1px solid #f1f5f9;border-bottom:1px solid #e2e8f0;}
        .matelas-subnav__inner{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:12px 0;}
        .matelas-subnav__title{font-weight:950;color:#0b1220;font-size:13px;letter-spacing:-.01em;}
        .matelas-subnav__links{display:flex;gap:8px;overflow:auto;scrollbar-width:none;}
        .matelas-subnav__links::-webkit-scrollbar{display:none;}
        .matelas-chip{display:inline-flex;align-items:center;gap:8px;padding:10px 12px;border-radius:999px;border:1px solid #e2e8f0;background:#fff;color:#0b1220;font-weight:900;font-size:12px;text-decoration:none;white-space:nowrap;}
        .matelas-chip:hover{border-color:#cbd5e1;}

        .matelas-section{padding:54px 0;}
        .matelas-section--alt{background:#0b1220;}
        .matelas-section__grid{display:grid;grid-template-columns:1fr 1fr;gap:22px;align-items:center;}
        .matelas-section__eyebrow{font-weight:950;color:#64748b;text-transform:uppercase;letter-spacing:.08em;font-size:12px;}
        .matelas-section__name{font-weight:1000;color:#0b1220;font-size:34px;line-height:1.05;letter-spacing:-.02em;margin:10px 0 10px;}
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
        .matelas-link{display:inline-flex;align-items:center;gap:8px;font-weight:950;text-decoration:none;color:#ff3a7f;}
        .matelas-section--alt .matelas-link{color:#9ff0ff;}

        .matelas-all{padding:40px 0 58px;}
        .matelas-all__title{font-size:22px;font-weight:1000;letter-spacing:-.02em;color:#0b1220;margin:0;}
        .matelas-all__desc{color:#64748b;font-weight:700;margin:8px 0 0;}
        .matelas-all__grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;margin-top:18px;}
        .matelas-mini{background:#fff;border:1px solid #e2e8f0;border-radius:22px;overflow:hidden;display:flex;flex-direction:column;min-height:310px;transition:transform .18s ease, box-shadow .18s ease;}
        .matelas-mini:hover{transform:translateY(-2px);box-shadow:0 18px 40px rgba(2,6,23,.08);}
        .matelas-mini__media{aspect-ratio: 1.1 / 1;background:linear-gradient(135deg,#f8fafc,#fff);}
        .matelas-mini__media img{width:100%;height:100%;object-fit:cover;display:block;}
        .matelas-mini__body{padding:14px 14px 16px;display:flex;flex-direction:column;gap:10px;flex:1;}
        .matelas-mini__name{font-weight:1000;color:#0b1220;margin:0;font-size:14px;line-height:1.15;}
        .matelas-mini__meta{color:#64748b;font-weight:700;font-size:12px;line-height:1.25;margin:0;min-height:30px;}
        .matelas-mini__footer{margin-top:auto;display:flex;align-items:center;justify-content:space-between;gap:10px;}
        .matelas-mini__price{font-weight:1000;color:#0b1220;font-size:16px;}

        @media (max-width: 991px){
            .matelas-hero__title{font-size:44px;}
            .matelas-section__grid{grid-template-columns:1fr;}
            .matelas-all__grid{grid-template-columns:repeat(2,minmax(0,1fr));}
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

        <nav class="matelas-subnav" aria-label="Navigation modèles">
            <div class="container">
                <div class="matelas-subnav__inner">
                    <div class="matelas-subnav__title">Modèles</div>
                    <div class="matelas-subnav__links">
                        @foreach(($matelasModels ?? collect()) as $i => $row)
                            @php $label = (string) ($row['label'] ?? 'Matelas'); @endphp
                            <a class="matelas-chip" href="#modele-{{ $i }}">{{ $label }}</a>
                        @endforeach
                        <a class="matelas-chip" href="#tous">Tous les matelas</a>
                    </div>
                </div>
            </div>
        </nav>

        <div id="decouvrir"></div>

        @foreach(($matelasModels ?? collect()) as $i => $row)
            @php
                $p = $row['product'] ?? null;
                $label = (string) ($row['label'] ?? 'Matelas');
                $img = $p && $p->image ? asset($p->image) : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1200&h=900&fit=crop';
                $slug = $p?->slug;
                $price = $p?->price;
                $desc = $p?->short_description ?: 'Soutien du dos • Confort durable • Livraison rapide';
                $isAlt = $i % 2 === 1;
                $benefits = [
                    'Soutien précis' => 'Réduit la pression et améliore la posture.',
                    'Confort durable' => 'Conçu pour garder sa tenue dans le temps.',
                    'Variantes disponibles' => 'Choisis l’épaisseur et le nombre de places.',
                ];
            @endphp
            <section class="matelas-section{{ $isAlt ? ' matelas-section--alt' : '' }}" id="modele-{{ $i }}" aria-label="{{ $label }}">
                <div class="container">
                    <div class="matelas-section__grid">
                        <div>
                            <div class="matelas-section__eyebrow">{{ $isAlt ? 'Série signature' : 'Série confort' }}</div>
                            <h2 class="matelas-section__name">{{ $label }}</h2>
                            <p class="matelas-section__desc">{{ $desc }}</p>

                            <ul class="matelas-bullets">
                                @foreach($benefits as $t => $sub)
                                    <li>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <div>
                                            {{ $t }}
                                            <span>{{ $sub }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="matelas-actions">
                                @if($slug)
                                    <a class="matelas-btn matelas-btn--primary" href="{{ route('product.show', $slug) }}">Voir le produit</a>
                                @endif
                                <a class="matelas-btn matelas-btn--ghost" href="https://wa.me/2250700000000?text=Bonjour%2C%20je%20veux%20commander%20{{ urlencode($label) }}." target="_blank" rel="noopener">Commander via WhatsApp</a>
                                @if($price !== null)
                                    <a class="matelas-link" href="{{ $slug ? route('product.show', $slug) : '#' }}">À partir de {{ number_format((float) $price, 0, ',', '.') }}F <span aria-hidden="true">→</span></a>
                                @endif
                            </div>
                        </div>

                        <div class="matelas-media">
                            <img src="{{ $img }}" alt="{{ $label }}" loading="lazy" />
                        </div>
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
                                    <div class="matelas-mini__price">{{ number_format((float) $product->price, 0, ',', '.') }}F</div>
                                    <a class="matelas-link" href="{{ route('product.show', $product->slug) }}">Voir <span aria-hidden="true">→</span></a>
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
    </div>
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
