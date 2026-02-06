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
        .matelas-hero{padding:76px 0 40px;background:linear-gradient(180deg, rgba(11,27,58,.96), rgba(11,27,58,.86)), radial-gradient(900px 520px at 70% 10%, rgba(255,58,127,.18), rgba(255,58,127,0));color:#fff;}
        .matelas-hero__inner{text-align:center;max-width:920px;margin:0 auto;}
        .matelas-hero__title{font-size:44px;line-height:1.05;margin:0 0 10px;color:#fff;letter-spacing:-.03em;font-weight:1000;}
        .matelas-hero__subtitle{font-size:14px;color:rgba(241,245,249,.84);max-width:72ch;margin:0 auto;font-weight:700;}
        .matelas-hero__cta{display:flex;gap:12px;flex-wrap:wrap;justify-content:center;margin-top:18px;}

        .matelas-btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;border-radius:999px;padding:12px 16px;font-weight:900;text-decoration:none;}
        .matelas-btn--primary{background:linear-gradient(135deg,var(--ma-rose),#ff6a3a);color:#fff;box-shadow:0 22px 48px rgba(255,58,127,.28);}
        .matelas-btn--ghost{background:rgba(255,255,255,.75);backdrop-filter: blur(10px);color:var(--ma-navy);border:1px solid var(--ma-border);}

        .matelas-btn--navy{background:#0a1733;color:#fff;border:1px solid rgba(255,255,255,.14);box-shadow:0 18px 40px rgba(0,0,0,.22);}
        .matelas-btn--navy:hover{filter:brightness(1.06);}

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

        .matelas-block{padding:22px 0;}
        .matelas-block__pill{display:inline-flex;align-items:center;justify-content:center;padding:10px 18px;border-radius:999px;background:var(--ma-rose);color:#fff;font-weight:1000;text-transform:uppercase;letter-spacing:.05em;font-size:11px;}
        .matelas-block__head{text-align:center;margin-bottom:16px;}
        .matelas-quick{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:10px 12px;border-radius:999px;background:#0a1733;color:#fff;font-weight:950;border:0;cursor:pointer;}
        .matelas-quick:hover{filter:brightness(1.06);}

        .matelas-banner{padding:34px 0;background:linear-gradient(180deg, rgba(11,27,58,.94), rgba(11,27,58,.90));color:#fff;}
        .matelas-banner__inner{text-align:center;max-width:980px;margin:0 auto;}
        .matelas-banner__title{margin:0;font-weight:1000;letter-spacing:-.03em;line-height:1.05;font-size:22px;}
        .matelas-banner__desc{margin:10px auto 0;max-width:78ch;color:rgba(241,245,249,.84);font-weight:700;font-size:13px;}

        .matelas-tabs{padding:30px 0 10px;}
        .matelas-tabs__wrap{background:#fff;border:1px solid var(--ma-border);border-radius:22px;padding:18px;box-shadow:0 18px 50px rgba(2,6,23,.06);}
        .matelas-tabs__title{text-align:center;margin:0;font-weight:1000;color:var(--ma-rose);letter-spacing:-.02em;font-size:16px;}
        .matelas-tabs__bar{display:flex;gap:10px;justify-content:center;flex-wrap:wrap;margin-top:12px;}
        .matelas-tab{border:0;background:#eef2ff;color:var(--ma-navy);font-weight:1000;border-radius:999px;padding:10px 14px;cursor:pointer;}
        .matelas-tab.is-active{background:var(--ma-rose);color:#fff;}
        .matelas-tabs__grid{margin-top:16px;display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;}
        .matelas-tabs__panel{display:none;}
        .matelas-tabs__panel.is-active{display:block;}

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
            .matelas-hero__title{font-size:34px;}
            .matelas-section__grid{grid-template-columns:1fr;}
            .matelas-all__grid{grid-template-columns:repeat(2,minmax(0,1fr));}
            .matelas-modal__content{grid-template-columns:1fr;}
            .matelas-tabs__grid{grid-template-columns:repeat(2,minmax(0,1fr));}
        }
        @media (max-width: 520px){
            .matelas-hero{padding-top:56px;}
            .matelas-hero__title{font-size:30px;}
            .matelas-all__grid{grid-template-columns:1fr;}
            .matelas-tabs__grid{grid-template-columns:1fr;}
        }
    </style>

    <div class="matelas-page">
        <section class="matelas-hero" aria-label="{{ $pageTitle }}">
            <div class="container">
                <div class="matelas-hero__inner">
                    <h1 class="matelas-hero__title">Quatre Modèles,<br>Un sommeil meilleur</h1>
                    <p class="matelas-hero__subtitle">Choisis le niveau de fermeté qui te correspond. Puis sélectionne l’épaisseur et le nombre de places pour commander.</p>

                    <div class="matelas-hero__cta">
                        <a class="matelas-btn matelas-btn--primary" href="#petit-prix">Nos matelas à petit prix</a>
                        <a class="matelas-btn matelas-btn--navy" href="#differents">Nos différents matelas</a>
                    </div>
                </div>
            </div>
        </section>

        @php
            $allMatelas = collect($matelasCategoryGroups ?? [])->flatMap(function ($g) {
                return $g['products'] ?? [];
            })->filter()->unique('id')->values();

            $priceFor = function ($p) {
                $v = $p?->variants?->sortBy('price')->first();
                return $v?->price ?? $p?->price;
            };

            $cheapMatelas = $allMatelas->sortBy(function ($p) use ($priceFor) {
                return (float) ($priceFor($p) ?? 0);
            })->take(6)->values();
        @endphp

        <section class="matelas-block" id="petit-prix" aria-label="Nos matelas à petit prix">
            <div class="container">
                <div class="matelas-block__head">
                    <span class="matelas-block__pill">Nos matelas à petit prix</span>
                </div>

                <section class="best-modern" aria-label="Nos matelas à petit prix">
                    <div class="best-modern__grid">
                        @foreach($cheapMatelas as $product)
                            @php
                                $img = !empty($product->image) ? asset($product->image) : 'https://via.placeholder.com/400x400?text=Produit';
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

                            <article class="product-card" aria-label="{{ $product->name }}">
                                @if(!empty($product->discount_percent) && (int) $product->discount_percent > 0)
                                    <div class="product-card__badge">-{{ (int) $product->discount_percent }}%</div>
                                @elseif(!empty($product->badge_type) && $product->badge_type === 'new')
                                    <div class="product-card__badge product-card__badge--new">NEW</div>
                                @elseif(!empty($product->badge_type) && $product->badge_type === 'hot')
                                    <div class="product-card__badge product-card__badge--hot">HOT</div>
                                @endif

                                <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                    <div class="product-card__media">
                                        <img src="{{ $img }}" alt="{{ $product->name }}" loading="lazy" />
                                    </div>
                                </a>

                                <div class="product-card__body">
                                    <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                        <h3 class="product-card__name">{{ $product->name }}</h3>
                                    </a>
                                    <div class="product-card__footer">
                                        <div class="product-card__prices">
                                            <span class="product-card__price">{{ $price !== null ? number_format((float) $price, 0, ',', '.') . 'F' : '' }}</span>
                                            @if(!empty($product->formatted_old_price))
                                                <span class="product-card__old">{{ $product->formatted_old_price }}</span>
                                            @endif
                                        </div>
                                        <button
                                            class="product-card__btn"
                                            type="button"
                                            data-quick-add
                                            data-product-id="{{ $product->id }}"
                                            data-product-name="{{ e($product->name) }}"
                                            data-product-image="{{ $img }}"
                                            data-product-slug="{{ $product->slug }}"
                                            data-default-variant-id="{{ $defaultVariant?->id }}"
                                            data-variants='@json($variantsData)'
                                            aria-label="Ajouter au panier"
                                        >
                                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <div style="display:flex;justify-content:center;margin-top:14px;">
                    <a class="matelas-btn matelas-btn--navy" href="#tous">Charger</a>
                </div>
            </div>
        </section>

        <section class="matelas-banner" aria-label="Bandeau soutien">
            <div class="container">
                <div class="matelas-banner__inner">
                    <h2 class="matelas-banner__title">Le soutien qui prend soin de votre dos</h2>
                    <p class="matelas-banner__desc">Le matelas Medicosoins PH6 Extra Ferme assure un maintien optimal du dos. Idéal pour soulager les tensions, améliorer la posture et retrouver un sommeil réparateur.</p>
                </div>
            </div>
        </section>

        @php
            $tabDefs = [
                ['key' => 'medicosoins', 'label' => 'MEDICOSOINS', 'tokens' => ['medicosoins']],
                ['key' => 'confort_soft', 'label' => 'CONFORT SOFT', 'tokens' => ['confort', 'soft']],
                ['key' => 'addict', 'label' => 'ADDICT', 'tokens' => ['addict']],
                ['key' => 'luxury', 'label' => 'LUXURY', 'tokens' => ['luxury']],
            ];
        @endphp

        <section class="matelas-tabs" id="differents" aria-label="Nos différents matelas">
            <div class="container">
                <div class="matelas-tabs__wrap">
                    <h2 class="matelas-tabs__title">Nos différents Matelas</h2>
                    <div class="matelas-tabs__bar" role="tablist">
                        @foreach($tabDefs as $idx => $tab)
                            <button class="matelas-tab{{ $idx === 0 ? ' is-active' : '' }}" type="button" data-tab="{{ $tab['key'] }}" role="tab">{{ $tab['label'] }}</button>
                        @endforeach
                    </div>

                    @foreach($tabDefs as $idx => $tab)
                        @php
                            $items = $allMatelas->filter(function ($p) use ($tab) {
                                $name = \Illuminate\Support\Str::lower((string) ($p->name ?? ''));
                                foreach (($tab['tokens'] ?? []) as $t) {
                                    if (!str_contains($name, \Illuminate\Support\Str::lower($t))) return false;
                                }
                                return true;
                            })->take(6)->values();
                        @endphp

                        <div class="matelas-tabs__panel{{ $idx === 0 ? ' is-active' : '' }}" data-tab-panel="{{ $tab['key'] }}" role="tabpanel">
                            <section class="best-modern" aria-label="{{ $tab['label'] }}">
                                <div class="best-modern__grid">
                                @foreach($items as $product)
                                    @php
                                        $img = !empty($product->image) ? asset($product->image) : 'https://via.placeholder.com/400x400?text=Produit';
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

                                    <article class="product-card" aria-label="{{ $product->name }}">
                                        @if(!empty($product->discount_percent) && (int) $product->discount_percent > 0)
                                            <div class="product-card__badge">-{{ (int) $product->discount_percent }}%</div>
                                        @elseif(!empty($product->badge_type) && $product->badge_type === 'new')
                                            <div class="product-card__badge product-card__badge--new">NEW</div>
                                        @elseif(!empty($product->badge_type) && $product->badge_type === 'hot')
                                            <div class="product-card__badge product-card__badge--hot">HOT</div>
                                        @endif

                                        <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                            <div class="product-card__media">
                                                <img src="{{ $img }}" alt="{{ $product->name }}" loading="lazy" />
                                            </div>
                                        </a>

                                        <div class="product-card__body">
                                            <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                                <h3 class="product-card__name">{{ $product->name }}</h3>
                                            </a>
                                            <div class="product-card__footer">
                                                <div class="product-card__prices">
                                                    <span class="product-card__price">{{ $price !== null ? number_format((float) $price, 0, ',', '.') . 'F' : '' }}</span>
                                                    @if(!empty($product->formatted_old_price))
                                                        <span class="product-card__old">{{ $product->formatted_old_price }}</span>
                                                    @endif
                                                </div>
                                                <button
                                                    class="product-card__btn"
                                                    type="button"
                                                    data-quick-add
                                                    data-product-id="{{ $product->id }}"
                                                    data-product-name="{{ e($product->name) }}"
                                                    data-product-image="{{ $img }}"
                                                    data-product-slug="{{ $product->slug }}"
                                                    data-default-variant-id="{{ $defaultVariant?->id }}"
                                                    data-variants='@json($variantsData)'
                                                    aria-label="Ajouter au panier"
                                                >
                                                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                                </div>
                            </section>

                            <div style="display:flex;justify-content:center;margin-top:14px;">
                                <a class="matelas-btn matelas-btn--navy" href="#tous">Charger</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

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
            const tabButtons = Array.from(document.querySelectorAll('[data-tab]'));
            const tabPanels = Array.from(document.querySelectorAll('[data-tab-panel]'));
            tabButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const key = btn.getAttribute('data-tab');
                    tabButtons.forEach(b => b.classList.toggle('is-active', b === btn));
                    tabPanels.forEach(p => p.classList.toggle('is-active', p.getAttribute('data-tab-panel') === key));
                });
            });

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
