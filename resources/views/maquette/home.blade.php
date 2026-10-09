@extends('maquette.layout')

@push('styles')
<style>
  .new-drop{margin-top:100px;padding:88px 0;background:#f7f4f6;position:relative;overflow:hidden;}
  .new-drop::before{content:"NOUVEAU";position:absolute;top:-38px;right:-18px;font-size:clamp(80px,15vw,210px);font-weight:900;letter-spacing:-.06em;color:rgba(0,35,77,.035);line-height:1;pointer-events:none;}
  .new-drop-head{display:flex;align-items:end;justify-content:space-between;gap:24px;margin-bottom:34px;position:relative;z-index:1;}
  .new-drop-kicker{display:inline-flex;align-items:center;gap:10px;color:#ec4899;font-size:12px;font-weight:800;letter-spacing:.16em;text-transform:uppercase;margin-bottom:10px;}
  .new-drop-kicker::before{content:"";width:38px;height:2px;background:#ec4899;}
  .new-drop-title{font-size:clamp(32px,4vw,56px);font-weight:800;color:#00234D;line-height:1.05;letter-spacing:-.04em;margin:0;}
  .new-drop-title span{color:#ec4899;font-style:italic;}
  .new-drop-all{display:inline-flex;align-items:center;gap:10px;color:#00234D;font-size:13px;font-weight:800;text-decoration:none;text-transform:uppercase;letter-spacing:.08em;border-bottom:2px solid #ec4899;padding-bottom:5px;white-space:nowrap;}
  .new-drop-all:hover{color:#ec4899;}
  .new-drop-layout{display:grid;grid-template-columns:minmax(0,1.2fr) minmax(0,1fr);gap:22px;position:relative;z-index:1;}
  .new-drop-main{position:relative;min-height:610px;border-radius:30px;overflow:hidden;background:#00234D;text-decoration:none;display:block;}
  .new-drop-main img{width:100%;height:100%;position:absolute;inset:0;object-fit:cover;transition:transform .6s ease;}
  .new-drop-main:hover img{transform:scale(1.04);}
  .new-drop-main::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,rgba(0,35,77,.05) 35%,rgba(0,35,77,.94) 100%);}
  .new-drop-main-copy{position:absolute;z-index:2;left:36px;right:36px;bottom:34px;color:#fff;}
  .new-drop-label{display:inline-block;background:#ec4899;color:#fff;border-radius:999px;padding:8px 15px;font-size:11px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;margin-bottom:14px;}
  .new-drop-main h3{font-size:clamp(25px,3vw,38px);font-weight:800;line-height:1.12;color:#fff;margin:0 0 10px;}
  .new-drop-main-price{font-size:19px;font-weight:800;color:#fff;}
  .new-drop-main-price del{font-size:13px;color:rgba(255,255,255,.55);font-weight:500;margin-left:8px;}
  .new-drop-main-arrow{position:absolute;z-index:2;right:28px;top:28px;width:52px;height:52px;border-radius:50%;background:#fff;color:#00234D;display:flex;align-items:center;justify-content:center;transition:.2s;}
  .new-drop-main:hover .new-drop-main-arrow{background:#ec4899;color:#fff;transform:rotate(-10deg);}
  .new-drop-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:22px;}
  .new-drop-card{background:#fff;border-radius:24px;overflow:hidden;text-decoration:none;display:flex;flex-direction:column;position:relative;transition:transform .2s ease,box-shadow .2s ease;}
  .new-drop-card:hover{transform:translateY(-5px);box-shadow:0 18px 40px rgba(0,35,77,.11);}
  .new-drop-card-media{aspect-ratio:1.28/1;overflow:hidden;background:#eee;}
  .new-drop-card-media img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease;}
  .new-drop-card:hover img{transform:scale(1.06);}
  .new-drop-card-num{position:absolute;top:12px;left:12px;width:32px;height:32px;border-radius:50%;background:#00234D;color:#fff;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:800;z-index:1;}
  .new-drop-card-body{padding:16px 18px 18px;}
  .new-drop-card h3{font-size:15px;line-height:1.35;font-weight:800;color:#00234D;margin:0 0 8px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
  .new-drop-card-price{color:#ec4899;font-size:14px;font-weight:800;}
  .new-drop-card-price del{color:#999;font-size:11px;font-weight:500;margin-left:5px;}
  @media(max-width:991.98px){.new-drop-layout{grid-template-columns:1fr}.new-drop-main{min-height:520px}.new-drop-grid{grid-template-columns:repeat(2,minmax(0,1fr));}}
  @media(max-width:575.98px){.new-drop{padding:62px 0}.new-drop-head{align-items:start;flex-direction:column}.new-drop-main{min-height:440px;border-radius:22px}.new-drop-main-copy{left:24px;right:24px;bottom:24px}.new-drop-grid{gap:12px}.new-drop-card{border-radius:18px}.new-drop-card-body{padding:13px}.new-drop-card h3{font-size:13px}.new-drop-card-num{width:28px;height:28px}.new-drop-all{font-size:11px}}
</style>
@endpush

@section('content')

        <!-- slideshow start -->
        <div class="slideshow-section position-relative">
          <div
            class="slideshow-active activate-slider"
            data-slick='{
                            "autoplay": true,
                            "autoplaySpeed": 2000,
                            "speed": 600,
                            "cssEase": "ease",
                            "pauseOnHover": true,
                            "pauseOnFocus": true,
                            "infinite": true,
                            "slidesToShow": 1,
                            "slidesToScroll": 1,
                            "dots": true,
                            "arrows": true,
                            "responsive": [
                                {
                                    "breakpoint": 768,
                                    "settings": {
                                        "arrows": false
                                    }
                                }
                            ],
                            "fade": true
                        }'
          >
            @php
                $defaultSlides = collect([
                    ['img' => 'assets/hero/mobilier-addict-slide-1.png', 'alt' => 'Matelas Mobilier Addict - sommeil parfait', 'badge' => null, 'title' => 'Des matelas pour un sommeil parfait', 'highlight' => null, 'desc' => 'Confort et soutien optimal', 'btn' => 'ACHETER', 'url' => route('category.show', 'matelas')],
                    ['img' => 'assets/hero/mobilier-addict-slide-2.png', 'alt' => 'Literie Mobilier Addict - oreillers, draps et couettes', 'badge' => null, 'title' => 'Oreillers, draps et couettes', 'highlight' => null, 'desc' => 'Tout pour votre literie', 'btn' => 'ACHETER', 'url' => route('category.show', 'oreillers-et-taies')],
                    ['img' => 'assets/hero/mobilier-addict-slide-3.png', 'alt' => 'Mobilier Mobilier Addict - aménagement intérieur', 'badge' => null, 'title' => 'Mobiliers et accessoires', 'highlight' => null, 'desc' => 'Aménagez votre intérieur', 'btn' => 'ACHETER', 'url' => route('category.show', 'mobilier-accessoire')],
                ]);

                $slides = ($heroSlides ?? collect())->isNotEmpty()
                    ? $heroSlides->map(fn ($s) => [
                        'img' => $s->image,
                        'alt' => $s->image_alt ?: ($s->title ?? 'Mobilier Addict'),
                        'badge' => $s->badge,
                        'title' => $s->title,
                        'highlight' => $s->title_highlight,
                        'desc' => $s->description,
                        'btn' => $s->btn_primary_text ?: 'ACHETER',
                        'url' => $s->btn_primary_url ?: route('collection.index'),
                    ])->values()
                    : $defaultSlides;
            @endphp
            @foreach($slides as $i => $s)
            <div class="slide-item slide-item-bag position-relative">
              <img loading="{{ $i === 0 ? 'eager' : 'lazy' }}" {{ $i === 0 ? 'fetchpriority="high"' : '' }} decoding="async" class="slide-img d-none d-md-block"
                src="@image_url($s['img'])"
                alt="{{ $s['alt'] }}"
              />
              <img loading="{{ $i === 0 ? 'eager' : 'lazy' }}" {{ $i === 0 ? 'fetchpriority="high"' : '' }} decoding="async" class="slide-img d-md-none"
                src="@image_url($s['img'])"
                alt="{{ $s['alt'] }}"
              />
              <div class="content-absolute content-slide">
                <div
                  class="container height-inherit d-flex align-items-center justify-content-start"
                >
                  <div class="content-box slide-content slide-content-1 py-4">
                    @if($s['badge'])
                      <span class="slide-badge animate__animated animate__fadeInUp">{{ $s['badge'] }}</span>
                    @endif
                    <h2
                      class="slide-heading heading_72 animate__animated animate__fadeInUp"
                      data-animation="animate__animated animate__fadeInUp"
                    >
                      {{ $s['title'] }}@if($s['highlight']) <span class="featured-title-accent">{{ $s['highlight'] }}</span>@endif
                    </h2>
                    @if($s['desc'])
                    <p
                      class="slide-subheading heading_24 animate__animated animate__fadeInUp"
                      data-animation="animate__animated animate__fadeInUp"
                    >
                      {{ $s['desc'] }}
                    </p>
                    @endif
                    <a
                      class="btn-primary slide-btn animate__animated animate__fadeInUp"
                      href="{{ $s['url'] }}"
                      data-animation="animate__animated animate__fadeInUp"
                      >{{ $s['btn'] }}</a
                    >
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="activate-arrows"></div>
          <div class="activate-dots dot-tools"></div>
        </div>
        <!-- slideshow end -->

        <!-- game space start -->
        @php $gameEndsAt = \App\Http\Controllers\GameController::endsAt(); @endphp
        @if(!\App\Http\Controllers\GameController::isClosed())
        <div class="game-section mt-4 overflow-hidden">
          <style>
            .game-strip{position:relative;overflow:hidden;background:linear-gradient(120deg,#00234D 55%,#0a3a75);border-radius:26px;color:#fff;padding:44px 42px;display:flex;align-items:center;gap:34px;}
            .game-strip::after{content:'';position:absolute;width:360px;height:360px;border-radius:50%;background:radial-gradient(circle,rgba(236,72,153,.28),transparent 65%);top:-120px;right:-60px;}
            .game-strip-icon{flex:0 0 74px;width:74px;height:74px;border-radius:22px;background:#ec4899;display:flex;align-items:center;justify-content:center;box-shadow:0 14px 30px rgba(236,72,153,.4);}
            .game-strip-icon svg{width:36px;height:36px;stroke:#fff;fill:none;stroke-width:1.7;}
            .game-strip-body{flex:1;min-width:0;position:relative;z-index:1;}
            .game-strip-kicker{display:inline-flex;align-items:center;gap:10px;color:#ec4899;font-size:12px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;}
            .game-strip-kicker::before{content:'';width:28px;height:2px;background:#ec4899;}
            .game-strip-title{font-size:clamp(22px,3vw,32px);font-weight:800;margin:8px 0 8px;color:#fff;}
            .game-strip-title .pink{color:#ec4899;}
            .game-strip-text{color:rgba(255,255,255,.78);font-size:14.5px;line-height:1.7;max-width:600px;margin:0;}
            .game-strip-cta{position:relative;z-index:1;flex:0 0 auto;display:inline-flex;align-items:center;gap:10px;background:#ec4899;color:#fff;font-weight:700;font-size:13px;letter-spacing:.05em;text-transform:uppercase;padding:16px 32px;border-radius:999px;text-decoration:none;box-shadow:0 12px 30px rgba(236,72,153,.4);transition:transform .15s ease;}
            .game-strip-cta:hover{transform:translateY(-2px);color:#fff;}
            .game-cd{display:flex;gap:10px;margin-top:16px;}
            .game-cd-box{background:rgba(0,0,0,.38);border:1px solid rgba(236,72,153,.55);border-radius:14px;min-width:74px;padding:10px 8px;text-align:center;box-shadow:0 6px 18px rgba(0,0,0,.25);}
            .game-cd-box b{display:block;font-size:clamp(22px,2.6vw,32px);font-weight:800;color:#fff;line-height:1;font-variant-numeric:tabular-nums;}
            .game-cd-box span{display:block;font-size:10px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#ec4899;margin-top:5px;}
            .game-cd-label{font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.65);display:block;margin-bottom:6px;}
            @media (max-width:767.98px){.game-strip{flex-direction:column;text-align:center;padding:34px 22px;}.game-strip-kicker{justify-content:center;}.game-cd{justify-content:center;}}
          </style>
          <div class="container">
            <div class="game-strip" data-aos="fade-up" data-aos-duration="700">
              <div class="game-strip-icon">
                <svg viewBox="0 0 24 24"><path d="M12 2 4 5v6c0 5 3.4 9.4 8 11 4.6-1.6 8-6 8-11V5l-8-3Z" stroke-linecap="round" stroke-linejoin="round"/><path d="m9 12 2 2 4-4" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </div>
              <div class="game-strip-body">
                <span class="game-strip-kicker">Grand jeu</span>
                <h2 class="game-strip-title">Crée ton badge, partage-le, <span class="pink">gagne ton cadeau.</span></h2>
                <p class="game-strip-text">Génère ton badge personnalisé, partage-le avec #MobilierAddict #MatelasAddict et fais voter tes proches.</p>
                @if($gameEndsAt)
                  <div class="mt-3">
                    <span class="game-cd-label">⏳ Fin du jeu dans</span>
                    <div class="game-cd" data-game-ends="{{ $gameEndsAt->toIso8601String() }}">
                      <div class="game-cd-box"><b data-cd="d">0</b><span>jours</span></div>
                      <div class="game-cd-box"><b data-cd="h">0</b><span>heures</span></div>
                      <div class="game-cd-box"><b data-cd="m">0</b><span>min</span></div>
                      <div class="game-cd-box"><b data-cd="s">0</b><span>sec</span></div>
                    </div>
                  </div>
                @endif
              </div>
              <a href="{{ route('game.index') }}" class="game-strip-cta">
                Je participe
                <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 6h12M8 1.5 13 6l-5 4.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </a>
            </div>
          </div>
        </div>
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              const cd = document.querySelector('[data-game-ends]');
              if (!cd) return;
              const end = new Date(cd.dataset.gameEnds).getTime();
              const set = (k, v) => { const el = cd.querySelector(`[data-cd="${k}"]`); if (el) el.textContent = String(v).padStart(2, '0'); };
              const tick = () => {
                const diff = end - Date.now();
                if (diff <= 0) { location.reload(); return; }
                set('d', Math.floor(diff / 86400000));
                set('h', Math.floor(diff % 86400000 / 3600000));
                set('m', Math.floor(diff % 3600000 / 60000));
                set('s', Math.floor(diff % 60000 / 1000));
              };
              tick();
              setInterval(tick, 1000);
            });
          </script>
        @endif
        <!-- game space end -->

        <!-- trusted badge start -->
        <div class="trusted-section mt-100 overflow-hidden">
          <div class="container">
            <div
              class="trust-strip"
              data-aos="fade-up"
              data-aos-duration="700"
            >
              <div class="trust-item">
                <span class="trust-item-icon" aria-hidden="true">
                  <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"
                    />
                    <path d="M15 18H9" />
                    <path
                      d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.62l-3.48-4.35A1 1 0 0 0 17.52 8H14"
                    />
                    <circle cx="17" cy="18" r="2" />
                    <circle cx="7" cy="18" r="2" />
                  </svg>
                </span>
                <div class="trust-item-body">
                  <h2 class="heading_18 trust-item-title">
                    Livraison Express
                  </h2>
                  <p class="text_16 trust-item-text">
                    Gratuite dès 50.000F • Sous 48h partout
                  </p>
                </div>
              </div>
              <div class="trust-item">
                <span class="trust-item-icon" aria-hidden="true">
                  <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <rect x="2" y="5" width="20" height="14" rx="2" />
                    <path d="M2 10h20" />
                    <path d="M6 15h4" />
                  </svg>
                </span>
                <div class="trust-item-body">
                  <h2 class="heading_18 trust-item-title">
                    Paiement Flexible
                  </h2>
                  <p class="text_16 trust-item-text">
                    À la livraison ou en 3x sans frais
                  </p>
                </div>
              </div>
              <div class="trust-item">
                <span class="trust-item-icon" aria-hidden="true">
                  <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"
                    />
                    <path d="m9 12 2 2 4-4" />
                  </svg>
                </span>
                <div class="trust-item-body">
                  <h2 class="heading_18 trust-item-title">
                    Garantie 10 Ans
                  </h2>
                  <p class="text_16 trust-item-text">
                    Qualité certifiée et durable
                  </p>
                </div>
              </div>
              <div class="trust-item">
                <span class="trust-item-icon" aria-hidden="true">
                  <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M3 14v-3a9 9 0 0 1 18 0v3" />
                    <path
                      d="M3 14a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"
                    />
                    <path
                      d="M21 14a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2Z"
                    />
                    <path d="M21 16v2a4 4 0 0 1-4 4h-5" />
                  </svg>
                </span>
                <div class="trust-item-body">
                  <h2 class="heading_18 trust-item-title">
                    Support 24/7
                  </h2>
                  <p class="text_16 trust-item-text">
                    Experts disponibles à tout moment
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- trusted badge end -->

        <!-- banner start -->
        <div class="grid-banner mt-100 overflow-hidden">
          <div class="collection-tab-inner mt-0">
            <div class="container">
              <div class="grid-container-2">
                <a
                  class="grid-item grid-item-1 promo-card"
                  href="{{ route('category.show', 'matelas') }}"
                  data-aos="fade-right"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="promo-card-img"
                    src="{{ asset('assets/blo_01/matelas.png') }}"
                    alt="Nos matelas"
                  />
                  <span class="promo-card-badge">-20 %</span>
                  <div class="promo-card-overlay">
                    <p class="promo-card-kicker">Cashback immédiat</p>
                    <h2 class="heading_34 promo-card-title">Nos matelas</h2>
                    <span class="promo-card-cta">
                      Voir plus
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M5 12h14" />
                        <path d="m13 6 6 6-6 6" />
                      </svg>
                    </span>
                  </div>
                </a>
                <a
                  class="grid-item grid-item-2 promo-card"
                  href="{{ route('category.show', 'oreillers-et-taies') }}"
                  data-aos="fade-right"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="promo-card-img"
                    src="{{ asset('assets/blo_01/oreillers.png') }}"
                    alt="Nos oreillers"
                  />
                  <div class="promo-card-overlay">
                    <p class="promo-card-kicker">Cashback immédiat</p>
                    <h2 class="heading_34 promo-card-title">Nos oreillers</h2>
                    <span class="promo-card-cta">
                      Voir plus
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M5 12h14" />
                        <path d="m13 6 6 6-6 6" />
                      </svg>
                    </span>
                  </div>
                </a>
                <a
                  class="grid-item grid-item-3 promo-card promo-card--feature"
                  href="{{ route('category.show', 'drap-et-couettes') }}"
                  data-aos="fade-left"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="promo-card-img"
                    src="{{ asset('assets/blo_01/couettes.png') }}"
                    alt="Nos couettes"
                  />
                  <div class="promo-card-overlay">
                    <p class="promo-card-kicker">Cashback immédiat</p>
                    <h2 class="heading_34 promo-card-title">Nos couettes</h2>
                    <span class="promo-card-cta">
                      Voir plus
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M5 12h14" />
                        <path d="m13 6 6 6-6 6" />
                      </svg>
                    </span>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- banner end -->

        <!-- shop by category start -->
        <div class="shop-category cat-band mt-100 overflow-hidden">
          <div class="collection-tab-inner mt-0">
            <div class="container">
              <div
                class="featured-head"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <div class="featured-head-text">
                  <p class="featured-kicker">Explorez nos univers</p>
                  <h2 class="section-heading featured-title">
                    Acheter par catégorie
                  </h2>
                </div>
              </div>
              <div class="grid-container shop-category-inner">
                <a
                  class="grid-item grid-item-1 cat-card"
                  href="{{ route('category.show', 'matelas') }}"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="cat-card-img"
                    src="{{ asset('assets/bloc_02/matelas.png') }}"
                    alt="Matelas"
                  />
                  <div class="cat-card-label">
                    <span class="cat-card-info">
                      <span class="cat-card-kicker">Confort &amp; soutien</span>
                      <span class="cat-card-name">Matelas</span>
                    </span>
                    <span class="cat-card-arrow" aria-hidden="true">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /><path d="m13 6 6 6-6 6" /></svg>
                    </span>
                  </div>
                </a>
                <a
                  class="grid-item grid-item-2 cat-card"
                  href="{{ route('category.show', 'oreillers-et-taies') }}"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="cat-card-img"
                    src="{{ asset('assets/bloc_02/oreiller-taies.png') }}"
                    alt="Oreillers et taies"
                  />
                  <div class="cat-card-label">
                    <span class="cat-card-info">
                      <span class="cat-card-kicker">Douceur &amp; maintien</span>
                      <span class="cat-card-name">Oreillers et taies</span>
                    </span>
                    <span class="cat-card-arrow" aria-hidden="true">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /><path d="m13 6 6 6-6 6" /></svg>
                    </span>
                  </div>
                </a>
                <a
                  class="grid-item grid-item-3 cat-card"
                  href="{{ route('category.show', 'drap-et-couettes') }}"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="cat-card-img"
                    src="{{ asset('assets/bloc_02/drap-couettes.png') }}"
                    alt="Drap et Couettes"
                  />
                  <div class="cat-card-label">
                    <span class="cat-card-info">
                      <span class="cat-card-kicker">Linge de lit</span>
                      <span class="cat-card-name">Drap et Couettes</span>
                    </span>
                    <span class="cat-card-arrow" aria-hidden="true">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /><path d="m13 6 6 6-6 6" /></svg>
                    </span>
                  </div>
                </a>
                <a
                  class="grid-item grid-item-4 cat-card"
                  href="{{ route('category.show', 'mobilier-accessoire') }}"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="cat-card-img"
                    src="{{ asset('assets/bloc_02/mobilier-accessoires.png') }}"
                    alt="Mobiliers et Accessoires"
                  />
                  <div class="cat-card-label">
                    <span class="cat-card-info">
                      <span class="cat-card-kicker">Pour votre intérieur</span>
                      <span class="cat-card-name">Mobiliers &amp; Accessoires</span>
                    </span>
                    <span class="cat-card-arrow" aria-hidden="true">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /><path d="m13 6 6 6-6 6" /></svg>
                    </span>
                  </div>
                </a>
                <a
                  class="grid-item grid-item-5 cat-card"
                  href="{{ route('category.show', 'electromenager') }}"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <img loading="lazy" decoding="async"                     class="cat-card-img"
                    src="{{ asset('assets/bloc_02/electromenager.png') }}"
                    alt="Électroménager"
                  />
                  <div class="cat-card-label">
                    <span class="cat-card-info">
                      <span class="cat-card-kicker">Maison connectée</span>
                      <span class="cat-card-name">Électroménager</span>
                    </span>
                    <span class="cat-card-arrow" aria-hidden="true">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /><path d="m13 6 6 6-6 6" /></svg>
                    </span>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- shop by category end -->

        <!-- collection start -->
        <div class="featured-collection mt-100 overflow-hidden">
          <div class="collection-tab-inner">
            <div class="container">
              <div
                class="featured-head"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <div class="featured-head-text">
                  <p class="featured-kicker">Notre sélection</p>
                  <h2 class="section-heading featured-title">
                    Nos matelas <span class="featured-title-accent">en vedette</span>
                  </h2>
                </div>
                <a class="featured-link" href="{{ route('category.show', 'matelas') }}">
                  Voir tout
                  <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M5 12h14" />
                    <path d="m13 6 6 6-6 6" />
                  </svg>
                </a>
              </div>
              <div class="row featured-grid">
                @forelse($matelasProducts as $product)
                  <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-duration="700">
                    @include('maquette.includes.shop-card')
                  </div>
                @empty
                  <div class="col-12 text-center py-5">
                    <p class="text_16">Notre sélection de matelas arrive bientôt.</p>
                  </div>
                @endforelse
              </div>
            </div>
          </div>
        </div>
        <!-- collection end -->

        @if(($newProducts ?? collect())->isNotEmpty())
          @php
            $newDropLead = $newProducts->first();
            $newDropRest = $newProducts->skip(1)->take(4);
          @endphp
          <section class="new-drop" aria-labelledby="new-drop-title">
            <div class="container">
              <div class="new-drop-head" data-aos="fade-up" data-aos-duration="700">
                <div>
                  <div class="new-drop-kicker">Fraîchement arrivés</div>
                  <h2 class="new-drop-title" id="new-drop-title">Les nouveautés<br><span>qui changent tout.</span></h2>
                </div>
                <a href="{{ route('nouveautes.index') }}" class="new-drop-all">
                  Voir toutes les nouveautés
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                </a>
              </div>

              <div class="new-drop-layout">
                <a href="{{ route('product.show', $newDropLead->slug) }}" class="new-drop-main" data-aos="fade-right" data-aos-duration="750">
                  <img src="@image_url($newDropLead->image)" alt="{{ $newDropLead->name }}" loading="lazy" decoding="async">
                  <span class="new-drop-main-arrow" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                  <div class="new-drop-main-copy">
                    <span class="new-drop-label">Nouveau drop</span>
                    <h3>{{ $newDropLead->name }}</h3>
                    <div class="new-drop-main-price">
                      {{ number_format((float) $newDropLead->price, 0, ',', ' ') }} FCFA
                      @if($newDropLead->old_price && $newDropLead->old_price > $newDropLead->price)
                        <del>{{ number_format((float) $newDropLead->old_price, 0, ',', ' ') }} FCFA</del>
                      @endif
                    </div>
                  </div>
                </a>

                <div class="new-drop-grid">
                  @foreach($newDropRest as $product)
                    <a href="{{ route('product.show', $product->slug) }}" class="new-drop-card" data-aos="fade-up" data-aos-duration="700" data-aos-delay="{{ min($loop->index * 80, 240) }}">
                      <span class="new-drop-card-num">0{{ $loop->iteration + 1 }}</span>
                      <div class="new-drop-card-media">
                        <img src="@image_url($product->image)" alt="{{ $product->name }}" loading="lazy" decoding="async">
                      </div>
                      <div class="new-drop-card-body">
                        <h3>{{ $product->name }}</h3>
                        <div class="new-drop-card-price">
                          {{ number_format((float) $product->price, 0, ',', ' ') }} FCFA
                          @if($product->old_price && $product->old_price > $product->price)
                            <del>{{ number_format((float) $product->old_price, 0, ',', ' ') }} FCFA</del>
                          @endif
                        </div>
                      </div>
                    </a>
                  @endforeach
                </div>
              </div>
            </div>
          </section>
        @endif

        <!-- sur-mesure start -->
        <div class="sm-band mt-100 overflow-hidden">
          <div class="container">
            <div
              class="sm-head"
              data-aos="fade-up"
              data-aos-duration="700"
            >
              <span class="sm-badge">
                <svg
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path
                    d="M3 10.5 12 3l9 7.5"
                  />
                  <path
                    d="M5 9.5V21h14V9.5"
                  />
                  <path d="M9 21v-6h6v6" />
                </svg>
                Solutions adaptées
              </span>
              <h2 class="section-heading sm-title">Sur-<span class="sm-title-accent">mesure</span></h2>
              <p class="sm-sub">
                Que vous équipiez un hôtel, un appartement ou votre maison
                familiale, nous avons la solution parfaite.
              </p>
            </div>
            <div class="sm-grid">
              <a
                class="sm-card sm-card-1"
                href="{{ route('pages.hotellerie') }}"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <img loading="lazy" decoding="async"                   class="sm-card-img"
                  src="{{ asset('assets/sur-mesure/hotellerie.png') }}"
                  alt="Hôtellerie"
                />
                <div class="sm-card-text">
                  <span class="sm-card-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v6"/><path d="M3 18h18"/><path d="M6 10V7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v3"/></svg>
                  </span>
                  <h3 class="sm-card-title">Hôtellerie</h3>
                  <p class="sm-card-sub">
                    Solutions professionnelles pour hôtels, chambres d'hôtes
                    et résidences de tourisme.
                  </p>
                  <span class="sm-card-cta">
                    Découvrir
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
              <a
                class="sm-card sm-card-2"
                href="{{ route('pages.appartement-meuble') }}"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <img loading="lazy" decoding="async"                   class="sm-card-img"
                  src="{{ asset('assets/sur-mesure/appartement-meuble.png') }}"
                  alt="Appartement Meublé"
                />
                <div class="sm-card-text">
                  <span class="sm-card-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v3"/><path d="M2 16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1H6v-1a2 2 0 0 0-4 0Z"/><path d="M4 18v2"/><path d="M20 18v2"/></svg>
                  </span>
                  <h3 class="sm-card-title">Appartement Meublé</h3>
                  <p class="sm-card-sub">
                    Des essentiels pratiques et élégants pour vos espaces meublés.
                  </p>
                  <span class="sm-card-cta">
                    Découvrir
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
              <a
                class="sm-card sm-card-3"
                href="{{ route('pages.studio') }}"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <img loading="lazy" decoding="async"                   class="sm-card-img"
                  src="{{ asset('assets/sur-mesure/studio.png') }}"
                  alt="Studio"
                />
                <div class="sm-card-text">
                  <span class="sm-card-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M9 21v-6h6v6"/></svg>
                  </span>
                  <h3 class="sm-card-title">Studio</h3>
                  <p class="sm-card-sub">
                    Des solutions compactes pour un maximum de confort.
                  </p>
                  <span class="sm-card-cta">
                    Découvrir
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
              <a
                class="sm-card sm-card-4"
                href="{{ route('pages.famille') }}"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <img loading="lazy" decoding="async"                   class="sm-card-img"
                  src="{{ asset('assets/sur-mesure/famille.png') }}"
                  alt="Famille"
                />
                <div class="sm-card-text">
                  <span class="sm-card-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                  </span>
                  <h3 class="sm-card-title">Famille</h3>
                  <p class="sm-card-sub">
                    Matelas, couettes, oreillers et linge de lit pour toute la
                    famille, du bébé aux grands-parents.
                  </p>
                  <span class="sm-card-cta">
                    Découvrir
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
            </div>
          </div>
        </div>
        <!-- sur-mesure end -->

        <!-- all products start -->
        <div class="pc-band mt-100 overflow-hidden">
          <div class="container">
            <div class="pc-head" data-aos="fade-up" data-aos-duration="700">
              <span class="pc-kicker">Catalogue complet</span>
              <div class="pc-head-row">
                <h2 class="section-heading pc-title">Tous nos produits</h2>
                <p class="pc-sub">
                  De la literie à l'électroménager, tout l'équipement de
                  votre intérieur réuni au même endroit.
                </p>
              </div>
            </div>
            <div class="pc-grid">
              <a class="pc-card" href="{{ route('category.show', 'matelas') }}" data-aos="fade-up" data-aos-duration="700">
                <div class="pc-card-media">
                  <img class="pc-card-img" src="{{ asset('assets/maquette/') }}/img/products/real/1769999657_1CIVZl8UG6.jpg" alt="Matelas" loading="lazy" decoding="async">
                </div>
                <div class="pc-card-body">
                  <div>
                    <h3 class="pc-card-title">Matelas</h3>
                    <p class="pc-card-text">Ressorts, mousse et mémoire de forme, toutes tailles</p>
                  </div>
                  <span class="pc-card-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
              <a class="pc-card" href="{{ route('category.show', 'oreillers-et-taies') }}" data-aos="fade-up" data-aos-duration="700">
                <div class="pc-card-media">
                  <img class="pc-card-img" src="{{ asset('assets/maquette/') }}/img/products/real/1769999657_xCatLOv9hZ.jpg" alt="Oreillers et taies" loading="lazy" decoding="async">
                </div>
                <div class="pc-card-body">
                  <div>
                    <h3 class="pc-card-title">Oreillers &amp; taies</h3>
                    <p class="pc-card-text">Moelleux ou ferme, pour toutes les positions de sommeil</p>
                  </div>
                  <span class="pc-card-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
              <a class="pc-card" href="{{ route('category.show', 'drap-et-couettes') }}" data-aos="fade-up" data-aos-duration="700">
                <div class="pc-card-media">
                  <img class="pc-card-img" src="{{ asset('assets/maquette/') }}/img/products/real/1769993520_r5wT4mQ4N8.jpg" alt="Draps et couettes" loading="lazy" decoding="async">
                </div>
                <div class="pc-card-body">
                  <div>
                    <h3 class="pc-card-title">Draps &amp; couettes</h3>
                    <p class="pc-card-text">Linge de lit doux et respirant, adapté au climat</p>
                  </div>
                  <span class="pc-card-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
              <a class="pc-card" href="{{ route('category.show', 'mobilier-accessoire') }}" data-aos="fade-up" data-aos-duration="700">
                <div class="pc-card-media">
                  <img class="pc-card-img" src="{{ asset('assets/maquette/') }}/img/products/real/1770689632_0OTK5fkOpt.jpg" alt="Lits et mobilier de chambre" loading="lazy" decoding="async">
                </div>
                <div class="pc-card-body">
                  <div>
                    <h3 class="pc-card-title">Lits &amp; chambre</h3>
                    <p class="pc-card-text">Cadres de lit, commodes et rangements pour la chambre</p>
                  </div>
                  <span class="pc-card-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
              <a class="pc-card" href="{{ route('category.show', 'mobilier-accessoire') }}" data-aos="fade-up" data-aos-duration="700">
                <div class="pc-card-media">
                  <img class="pc-card-img" src="{{ asset('assets/maquette/') }}/img/products/real/1770738680_Z9FYQSbomB.jpg" alt="Mobilier et accessoires" loading="lazy" decoding="async">
                </div>
                <div class="pc-card-body">
                  <div>
                    <h3 class="pc-card-title">Mobilier &amp; accessoires</h3>
                    <p class="pc-card-text">Canapés, fauteuils, tables et meubles du quotidien</p>
                  </div>
                  <span class="pc-card-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
              <a class="pc-card" href="{{ route('category.show', 'electromenager') }}" data-aos="fade-up" data-aos-duration="700">
                <div class="pc-card-media">
                  <img class="pc-card-img" src="{{ asset('assets/maquette/') }}/img/products/real/1769999657_1CIVZl8UG6.jpg" alt="Électroménager" loading="lazy" decoding="async">
                </div>
                <div class="pc-card-body">
                  <div>
                    <h3 class="pc-card-title">Électroménager</h3>
                    <p class="pc-card-text">Les essentiels de la maison, de la cuisine à la buanderie</p>
                  </div>
                  <span class="pc-card-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </span>
                </div>
              </a>
            </div>
          </div>
        </div>
        <!-- all products end -->

        <!-- video start -->
        <div class="video-section mt-100 overflow-hidden">
          <style>
            .video-hero{position:relative;background:url('{{ asset('assets/maquette/img/video/video-furniture.jpg') }}') no-repeat center/cover;padding:90px 0 110px;}
            .video-hero::before{content:'';position:absolute;inset:0;background:linear-gradient(90deg,rgba(0,35,77,.82) 0%,rgba(0,35,77,.45) 45%,rgba(0,35,77,.15) 100%);}
            .video-hero .container{position:relative;z-index:1;}
            .video-hero-eyebrow{display:flex;align-items:center;gap:12px;color:#fff;font-size:13px;font-weight:600;letter-spacing:.14em;text-transform:uppercase;}
            .video-hero-eyebrow::before{content:'';width:38px;height:2px;background:#ec4899;}
            .video-hero-title{color:#fff;font-size:clamp(30px,4.5vw,54px);font-weight:800;line-height:1.15;margin:16px 0 14px;max-width:560px;}
            .video-hero-title .pink{color:#ec4899;}
            .video-hero-text{color:rgba(255,255,255,.82);font-size:15px;line-height:1.75;max-width:440px;margin-bottom:30px;}
            .video-hero-btn{display:inline-flex;align-items:center;gap:10px;padding:14px 28px;border-radius:999px;font-size:13px;font-weight:600;letter-spacing:.05em;text-transform:uppercase;text-decoration:none;transition:transform .15s ease,box-shadow .15s ease;}
            .video-hero-btn:hover{transform:translateY(-2px);}
            .video-hero-btn-pink{background:#ec4899;color:#fff;box-shadow:0 10px 26px rgba(236,72,153,.4);}
            .video-hero-btn-pink:hover{color:#fff;}
            .video-hero-btn-ghost{border:1px solid rgba(255,255,255,.5);color:#fff;}
            .video-hero-btn-ghost:hover{color:#ec4899;border-color:#ec4899;}
            .video-hero-play{position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);width:86px;height:86px;border-radius:50%;background:rgba(255,255,255,.28);backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;z-index:2;transition:background .2s ease,transform .2s ease;}
            .video-hero-play:hover{background:#ec4899;transform:translate(-50%,-50%) scale(1.06);}
            .video-hero-play svg{margin-left:5px;}
            .video-hero-features{position:absolute;left:0;right:0;bottom:0;z-index:1;background:rgba(0,35,77,.45);backdrop-filter:blur(10px);border-top:1px solid rgba(255,255,255,.14);}
            .video-hero-feature{display:flex;align-items:center;gap:14px;padding:20px 18px;color:#fff;}
            .video-hero-feature+.video-hero-feature{border-left:1px solid rgba(255,255,255,.14);}
            .video-hero-feature-icon{flex:0 0 52px;width:52px;height:52px;border-radius:50%;background:#ec4899;display:flex;align-items:center;justify-content:center;}
            .video-hero-feature-icon svg{width:24px;height:24px;stroke:#fff;fill:none;stroke-width:1.6;}
            .video-hero-feature b{display:block;font-size:14px;font-weight:600;}
            .video-hero-feature span{font-size:12px;color:rgba(255,255,255,.7);}
            @media (max-width:991.98px){
              .video-hero{padding:70px 0 160px;}
              .video-hero-play{position:static;transform:none;margin:26px 0 0;}
              .video-hero-play:hover{transform:scale(1.06);}
              .video-hero-features{position:static;margin-top:34px;}
              .video-hero-feature+.video-hero-feature{border-left:none;border-top:1px solid rgba(255,255,255,.14);}
            }
          </style>

          <div class="video-hero">
            <div class="container">
              <div class="video-hero-eyebrow">Le confort en images</div>
              <h2 class="video-hero-title">Découvrez l'univers Mobilier <span class="pink">Addict.</span></h2>
              <p class="video-hero-text">Du matelas au linge de lit, découvrez comment nous transformons chaque chambre en véritable espace de confort.</p>
              <div class="d-flex flex-wrap gap-3">
                <a href="#video-modal" class="video-hero-btn video-hero-btn-pink" data-bs-toggle="modal">
                  <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.5 6.134C12.1667 6.5189 12.1667 7.48113 11.5 7.86603L1.75 13.0622C1.08333 13.4471 0.25 12.9658 0.25 12.1962L0.25 1.80385C0.25 1.03425 1.08333 0.552998 1.75 0.937898L11.5 6.134Z" fill="currentColor"/></svg>
                  Voir notre univers
                </a>
                <a href="{{ url('/collection') }}" class="video-hero-btn video-hero-btn-ghost">
                  Découvrir nos produits
                  <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 6h12M8 1.5 13 6l-5 4.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
              </div>
            </div>

            <a href="#video-modal" class="video-hero-play" data-bs-toggle="modal" aria-label="Lire la vidéo">
              <svg width="22" height="26" viewBox="0 0 22 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.5 12.134C22.1667 12.5189 22.1667 13.4811 21.5 13.866L2 25.1244C1.33333 25.5093 0.499999 25.0281 0.499999 24.2583L0.5 1.74167C0.5 0.971867 1.33333 0.490743 2 0.875643L21.5 12.134Z" fill="#FEFEFE"/></svg>
            </a>
          </div>

          <div class="video-hero-features">
            <div class="container">
              <div class="row g-0">
                <div class="col-lg-3 col-sm-6">
                  <div class="video-hero-feature">
                    <span class="video-hero-feature-icon"><svg viewBox="0 0 24 24"><path d="M3 18v-6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v6M3 18h18M6 10V7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v3" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                    <div><b>Matelas confort</b><span>Des nuits de qualité</span></div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <div class="video-hero-feature">
                    <span class="video-hero-feature-icon"><svg viewBox="0 0 24 24"><rect x="4" y="7" width="16" height="10" rx="4" /><path d="M4 10c2 1 14 1 16 0M4 14c2-1 14-1 16 0" stroke-linecap="round"/></svg></span>
                    <div><b>Oreillers &amp; taies</b><span>Un confort au quotidien</span></div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <div class="video-hero-feature">
                    <span class="video-hero-feature-icon"><svg viewBox="0 0 24 24"><path d="M4 8h16v9a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8ZM4 8V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2M8 12h8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                    <div><b>Draps &amp; couettes</b><span>Douceur et élégance</span></div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <div class="video-hero-feature">
                    <span class="video-hero-feature-icon"><svg viewBox="0 0 24 24"><path d="M5 11V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v4M3 15a2 2 0 0 1 4 0v1h10v-1a2 2 0 0 1 4 0v3H3v-3ZM7 18v1m10-1v1" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                    <div><b>Solutions sur mesure</b><span>Pour tous vos espaces</span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" tabindex="-1" id="video-modal">
            <div class="modal-dialog modal-dialog-centered modal-xl">
              <div class="modal-content">
                <div class="modal-header border-0">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body p-0">
                  <div class="ratio ratio-16x9">
                    <iframe data-src="https://www.youtube.com/embed/tvPnrfQCiCo?autoplay=1" title="Lecteur vidéo YouTube" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <script>
            document.addEventListener('DOMContentLoaded', function () {
              const modal = document.getElementById('video-modal');
              if (!modal) return;
              const iframe = modal.querySelector('iframe');
              modal.addEventListener('shown.bs.modal', () => {
                if (iframe && !iframe.src) iframe.src = iframe.dataset.src;
              });
              modal.addEventListener('hidden.bs.modal', () => {
                if (iframe) iframe.src = '';
              });
            });
          </script>
        </div>
        <!-- video end -->



        <!-- testimonial start -->
        <div class="testimonial-section mt-100 overflow-hidden home-section">
          <div class="testimonial-inner">
            <div class="container">
              <div class="row">
                <div
                  class="col-lg-5 col-md-12 col-12"
                  data-aos="fade-right"
                  data-aos-duration="700"
                >
                  <div class="section-header">
                    <h2 class="section-heading primary-color">
                      Ce que disent nos clients
                    </h2>
                    <p class="section-subheading">
                      Les services fournis ont été fluides et satisfaisants. Les produits livrés étaient à la hauteur de nos attentes.
                    </p>
                  </div>
                </div>
                <div
                  class="col-lg-6 offset-lg-1 col-md-12 col-12"
                  data-aos="fade-left"
                  data-aos-duration="700"
                >
                  <div class="testimonial-container position-relative">
                    <div
                      class="testimonial-slideshow common-slider"
                      data-slick='{
                                            "slidesToShow": 1,
                                            "slidesToScroll": 1,
                                            "dots": false,
                                            "arrows": true
                                        }'
                    >
                      <div class="testimonial-item">
                        <div
                          class="testimonial-icon-wrap d-flex align-items-center"
                        >
                          <div class="testimonial-icon-quote">
                            <svg
                              width="40"
                              height="29"
                              viewBox="0 0 40 29"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M0 28.99L11.7 0H19.5L12.22 28.99H0ZM20.28 28.99L32.11 0H39.91L32.5 28.99H20.28Z"
                                fill="#00234D"
                              />
                            </svg>
                          </div>
                          <div
                            class="testimonial-icon-star d-flex align-items-center ms-3"
                          >
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                          </div>
                        </div>
                        <p class="testimonial-review my-4 text_16">
                          « J'achète mes matelas chez Mobilier Addict depuis 6 ans. J'adore leur service réactif et je n'ai jamais eu de problème avec leurs matelas. »
                        </p>
                        <div
                          class="testimonial-reviewer d-flex align-items-center"
                        >
                          <div class="reviewer-img">
                            <img loading="lazy" decoding="async"                               src="{{ asset('assets/maquette/') }}/img/testimonial/avatar.svg"
                              alt="Avatar client"
                            />
                          </div>
                          <div class="reviewer-info ms-4">
                            <h4
                              class="reviewer-name heading_18 mb-2 primary-color"
                            >
                              Floyd Miles
                            </h4>
                            <p class="reviewer-desig text_14 m-0">
                              Dirigeant, Hypebeast
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="testimonial-item">
                        <div
                          class="testimonial-icon-wrap d-flex align-items-center"
                        >
                          <div class="testimonial-icon-quote">
                            <svg
                              width="40"
                              height="29"
                              viewBox="0 0 40 29"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M0 28.99L11.7 0H19.5L12.22 28.99H0ZM20.28 28.99L32.11 0H39.91L32.5 28.99H20.28Z"
                                fill="#00234D"
                              />
                            </svg>
                          </div>
                          <div
                            class="testimonial-icon-star d-flex align-items-center ms-3"
                          >
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                          </div>
                        </div>
                        <p class="testimonial-review my-4 text_16">
                          « J'achète mes matelas chez Mobilier Addict depuis 6 ans. J'adore leur service réactif et je n'ai jamais eu de problème avec leurs matelas. »
                        </p>
                        <div
                          class="testimonial-reviewer d-flex align-items-center"
                        >
                          <div class="reviewer-img">
                            <img loading="lazy" decoding="async"                               src="{{ asset('assets/maquette/') }}/img/testimonial/avatar.svg"
                              alt="Avatar client"
                            />
                          </div>
                          <div class="reviewer-info ms-4">
                            <h4
                              class="reviewer-name heading_18 mb-2 primary-color"
                            >
                              Floyd Miles
                            </h4>
                            <p class="reviewer-desig text_14 m-0">
                              Dirigeant, Hypebeast
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="testimonial-item">
                        <div
                          class="testimonial-icon-wrap d-flex align-items-center"
                        >
                          <div class="testimonial-icon-quote">
                            <svg
                              width="40"
                              height="29"
                              viewBox="0 0 40 29"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M0 28.99L11.7 0H19.5L12.22 28.99H0ZM20.28 28.99L32.11 0H39.91L32.5 28.99H20.28Z"
                                fill="#00234D"
                              />
                            </svg>
                          </div>
                          <div
                            class="testimonial-icon-star d-flex align-items-center ms-3"
                          >
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                            <img loading="lazy" decoding="async" src="{{ asset('assets/maquette/') }}/img/icon/star.png" alt="" aria-hidden="true" />
                          </div>
                        </div>
                        <p class="testimonial-review my-4 text_16">
                          « J'achète mes matelas chez Mobilier Addict depuis 6 ans. J'adore leur service réactif et je n'ai jamais eu de problème avec leurs matelas. »
                        </p>
                        <div
                          class="testimonial-reviewer d-flex align-items-center"
                        >
                          <div class="reviewer-img">
                            <img loading="lazy" decoding="async"                               src="{{ asset('assets/maquette/') }}/img/testimonial/avatar.svg"
                              alt="Avatar client"
                            />
                          </div>
                          <div class="reviewer-info ms-4">
                            <h4
                              class="reviewer-name heading_18 mb-2 primary-color"
                            >
                              Floyd Miles
                            </h4>
                            <p class="reviewer-desig text_14 m-0">
                              Dirigeant, Hypebeast
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="activate-arrows show-arrows-always article-arrows arrows-white"
                    ></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- testimonial end -->

        <!-- single banner start -->
        <div class="single-banner-section mt-100 overflow-hidden">
          <div class="position-relative overlay">
            <img loading="lazy" decoding="async"               class="single-banner-img"
              src="{{ asset('assets/bandeau/bandeau.png') }}"
              alt="Matelas sur mesure Mobilier Addict"
            />

            <div class="content-absolute content-slide">
              <div
                class="container height-inherit d-flex align-items-center justify-content-start"
              >
                <div
                  class="content-box single-banner-content py-4"
                  data-aos="fade-up"
                  data-aos-duration="700"
                >
                  <h2
                    class="single-banner-heading heading_42 text-white animate__animated animate__fadeInUp"
                    data-animation="animate__animated animate__fadeInUp"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    Matelas sur <span class="single-banner-accent">mesure</span>
                  </h2>
                  <p
                    class="single-banner-text text_16 text-white animate__animated animate__fadeInUp"
                    data-animation="animate__animated animate__fadeInUp"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    Un matelas adapté à votre morphologie et à vos habitudes de sommeil.
                  </p>
                  <a
                    class="btn-primary single-banner-btn animate__animated animate__fadeInUp"
                    href="{{ route('category.show', 'matelas') }}"
                    data-animation="animate__animated animate__fadeInUp"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    DÉCOUVRIR
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                  </a>
                  <div class="single-banner-perks">
                    <span class="single-banner-perk">
                      <span class="single-banner-perk-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v6"/><path d="M3 18h18"/><path d="M6 10V7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v3"/></svg>
                      </span>
                      Confort optimal
                    </span>
                    <span class="single-banner-perk">
                      <span class="single-banner-perk-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                      </span>
                      Qualité durable
                    </span>
                    <span class="single-banner-perk">
                      <span class="single-banner-perk-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20h20"/><path d="M12 2 2 12h20L12 2z" transform="rotate(45 12 12)"/><path d="M12 4l6 8H6l6-8z"/></svg>
                      </span>
                      Choix de tailles
                    </span>
                    <span class="single-banner-perk">
                      <span class="single-banner-perk-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 2 9 5-9 5-9-5 9-5z"/><path d="m3 12 9 5 9-5"/><path d="m3 17 9 5 9-5"/></svg>
                      </span>
                      Différentes tailles
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- single banner end -->

        <!-- latest blog start -->
        <div class="latest-blog-section blog-v2 mt-100 overflow-hidden home-section">
          <div class="latest-blog-inner">
            <div class="container">
              <div
                class="featured-head"
                data-aos="fade-up"
                data-aos-duration="700"
              >
                <div class="featured-head-text">
                  <p class="featured-kicker">Le magazine</p>
                  <h2 class="section-heading featured-title">
                    Derniers articles
                  </h2>
                </div>
                <a class="featured-link" href="{{ route('blog.index') }}">
                  Tous les articles
                  <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <path d="M5 12h14" />
                    <path d="m13 6 6 6-6 6" />
                  </svg>
                </a>
              </div>
              <div class="article-card-container position-relative">
                <div
                  class="common-slider"
                  data-slick='{
                                "slidesToShow": 3,
                                "slidesToScroll": 1,
                                "dots": false,
                                "arrows": true,
                                "responsive": [
                                  {
                                    "breakpoint": 1281,
                                    "settings": {
                                      "slidesToShow": 2
                                    }
                                  },
                                  {
                                    "breakpoint": 602,
                                    "settings": {
                                      "slidesToShow": 1
                                    }
                                  }
                                ]
                            }'
                >
                  <div
                    class="article-slick-item"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    <div class="article-card blog-card">
                      <a class="article-card-img-wrapper" href="{{ route('blog.index') }}">
                        <img loading="lazy" decoding="async"                           src="{{ asset('assets/maquette/') }}/img/blog/furniture-1.jpg"
                          alt="img"
                          class="article-card-img rounded"
                        />

                        <span class="article-tag article-tag-absolute rounded"
                          >Décoration</span
                        >
                      </a>
                      <p
                        class="article-card-published text_12 d-flex align-items-center"
                      >
                        <span class="article-date d-flex align-items-center">
                          <span class="icon-publish">
                            <svg
                              width="17"
                              height="18"
                              viewBox="0 0 17 18"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M3.46875 0.875V1.59375H0.59375V17.4063H16.4063V1.59375H13.5313V0.875H12.0938V1.59375H4.90625V0.875H3.46875ZM2.03125 3.03125H3.46875V3.75H4.90625V3.03125H12.0938V3.75H13.5313V3.03125H14.9688V4.46875H2.03125V3.03125ZM2.03125 5.90625H14.9688V15.9688H2.03125V5.90625ZM6.34375 7.34375V8.78125H7.78125V7.34375H6.34375ZM9.21875 7.34375V8.78125H10.6563V7.34375H9.21875ZM12.0938 7.34375V8.78125H13.5313V7.34375H12.0938ZM3.46875 10.2188V11.6563H4.90625V10.2188H3.46875ZM6.34375 10.2188V11.6563H7.78125V10.2188H6.34375ZM9.21875 10.2188V11.6563H10.6563V10.2188H9.21875ZM12.0938 10.2188V11.6563H13.5313V10.2188H12.0938ZM3.46875 13.0938V14.5313H4.90625V13.0938H3.46875ZM6.34375 13.0938V14.5313H7.78125V13.0938H6.34375ZM9.21875 13.0938V14.5313H10.6563V13.0938H9.21875Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">30 décembre 2022</span>
                        </span>
                        <span
                          class="article-author d-flex align-items-center ms-4"
                        >
                          <span class="icon-author"
                            ><svg
                              width="15"
                              height="17"
                              viewBox="0 0 15 17"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M7.5 0.59375C4.72888 0.59375 2.46875 2.85388 2.46875 5.625C2.46875 7.3573 3.35315 8.89587 4.69238 9.80274C2.12903 10.9033 0.3125 13.447 0.3125 16.4063H1.75C1.75 13.2224 4.31616 10.6563 7.5 10.6563C10.6838 10.6563 13.25 13.2224 13.25 16.4063H14.6875C14.6875 13.447 12.871 10.9033 10.3076 9.80274C11.6469 8.89587 12.5313 7.3573 12.5313 5.625C12.5313 2.85388 10.2711 0.59375 7.5 0.59375ZM7.5 2.03125C9.49341 2.03125 11.0938 3.63159 11.0938 5.625C11.0938 7.61841 9.49341 9.21875 7.5 9.21875C5.50659 9.21875 3.90625 7.61841 3.90625 5.625C3.90625 3.63159 5.50659 2.03125 7.5 2.03125Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">Lara Joe</span>
                        </span>
                      </p>
                      <h2 class="article-card-heading heading_18">
                        <a class="heading_18" href="{{ route('blog.index') }}">
                          Bien choisir son matelas.
                        </a>
                      </h2>
                      <a class="blog-card-more" href="{{ route('blog.index') }}">
                        Lire l'article
                        <svg
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path d="M5 12h14" />
                          <path d="m13 6 6 6-6 6" />
                        </svg>
                      </a>
                    </div>
                  </div>
                  <div
                    class="article-slick-item"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    <div class="article-card blog-card">
                      <a class="article-card-img-wrapper" href="{{ route('blog.index') }}">
                        <img loading="lazy" decoding="async"                           src="{{ asset('assets/maquette/') }}/img/blog/furniture-2.jpg"
                          alt="img"
                          class="article-card-img rounded"
                        />
                        <span class="article-tag article-tag-absolute rounded"
                          >Mobilier</span
                        >
                      </a>
                      <p
                        class="article-card-published text_12 d-flex align-items-center"
                      >
                        <span class="article-date d-flex align-items-center">
                          <span class="icon-publish">
                            <svg
                              width="17"
                              height="18"
                              viewBox="0 0 17 18"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M3.46875 0.875V1.59375H0.59375V17.4063H16.4063V1.59375H13.5313V0.875H12.0938V1.59375H4.90625V0.875H3.46875ZM2.03125 3.03125H3.46875V3.75H4.90625V3.03125H12.0938V3.75H13.5313V3.03125H14.9688V4.46875H2.03125V3.03125ZM2.03125 5.90625H14.9688V15.9688H2.03125V5.90625ZM6.34375 7.34375V8.78125H7.78125V7.34375H6.34375ZM9.21875 7.34375V8.78125H10.6563V7.34375H9.21875ZM12.0938 7.34375V8.78125H13.5313V7.34375H12.0938ZM3.46875 10.2188V11.6563H4.90625V10.2188H3.46875ZM6.34375 10.2188V11.6563H7.78125V10.2188H6.34375ZM9.21875 10.2188V11.6563H10.6563V10.2188H9.21875ZM12.0938 10.2188V11.6563H13.5313V10.2188H12.0938ZM3.46875 13.0938V14.5313H4.90625V13.0938H3.46875ZM6.34375 13.0938V14.5313H7.78125V13.0938H6.34375ZM9.21875 13.0938V14.5313H10.6563V13.0938H9.21875Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">30 décembre 2022</span>
                        </span>
                        <span
                          class="article-author d-flex align-items-center ms-4"
                        >
                          <span class="icon-author"
                            ><svg
                              width="15"
                              height="17"
                              viewBox="0 0 15 17"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M7.5 0.59375C4.72888 0.59375 2.46875 2.85388 2.46875 5.625C2.46875 7.3573 3.35315 8.89587 4.69238 9.80274C2.12903 10.9033 0.3125 13.447 0.3125 16.4063H1.75C1.75 13.2224 4.31616 10.6563 7.5 10.6563C10.6838 10.6563 13.25 13.2224 13.25 16.4063H14.6875C14.6875 13.447 12.871 10.9033 10.3076 9.80274C11.6469 8.89587 12.5313 7.3573 12.5313 5.625C12.5313 2.85388 10.2711 0.59375 7.5 0.59375ZM7.5 2.03125C9.49341 2.03125 11.0938 3.63159 11.0938 5.625C11.0938 7.61841 9.49341 9.21875 7.5 9.21875C5.50659 9.21875 3.90625 7.61841 3.90625 5.625C3.90625 3.63159 5.50659 2.03125 7.5 2.03125Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">Lara Joe</span>
                        </span>
                      </p>
                      <h2 class="article-card-heading heading_18">
                        <a class="heading_18" href="{{ route('blog.index') }}">
                          Les secrets d'un sommeil réparateur.
                        </a>
                      </h2>
                      <a class="blog-card-more" href="{{ route('blog.index') }}">
                        Lire l'article
                        <svg
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path d="M5 12h14" />
                          <path d="m13 6 6 6-6 6" />
                        </svg>
                      </a>
                    </div>
                  </div>
                  <div
                    class="article-slick-item"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    <div class="article-card blog-card">
                      <a class="article-card-img-wrapper" href="{{ route('blog.index') }}">
                        <img loading="lazy" decoding="async"                           src="{{ asset('assets/maquette/') }}/img/blog/furniture-3.jpg"
                          alt="img"
                          class="article-card-img rounded"
                        />
                        <span class="article-tag article-tag-absolute rounded"
                          >Cuisine</span
                        >
                      </a>
                      <p
                        class="article-card-published text_12 d-flex align-items-center"
                      >
                        <span class="article-date d-flex align-items-center">
                          <span class="icon-publish">
                            <svg
                              width="17"
                              height="18"
                              viewBox="0 0 17 18"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M3.46875 0.875V1.59375H0.59375V17.4063H16.4063V1.59375H13.5313V0.875H12.0938V1.59375H4.90625V0.875H3.46875ZM2.03125 3.03125H3.46875V3.75H4.90625V3.03125H12.0938V3.75H13.5313V3.03125H14.9688V4.46875H2.03125V3.03125ZM2.03125 5.90625H14.9688V15.9688H2.03125V5.90625ZM6.34375 7.34375V8.78125H7.78125V7.34375H6.34375ZM9.21875 7.34375V8.78125H10.6563V7.34375H9.21875ZM12.0938 7.34375V8.78125H13.5313V7.34375H12.0938ZM3.46875 10.2188V11.6563H4.90625V10.2188H3.46875ZM6.34375 10.2188V11.6563H7.78125V10.2188H6.34375ZM9.21875 10.2188V11.6563H10.6563V10.2188H9.21875ZM12.0938 10.2188V11.6563H13.5313V10.2188H12.0938ZM3.46875 13.0938V14.5313H4.90625V13.0938H3.46875ZM6.34375 13.0938V14.5313H7.78125V13.0938H6.34375ZM9.21875 13.0938V14.5313H10.6563V13.0938H9.21875Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">30 décembre 2022</span>
                        </span>
                        <span
                          class="article-author d-flex align-items-center ms-4"
                        >
                          <span class="icon-author"
                            ><svg
                              width="15"
                              height="17"
                              viewBox="0 0 15 17"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M7.5 0.59375C4.72888 0.59375 2.46875 2.85388 2.46875 5.625C2.46875 7.3573 3.35315 8.89587 4.69238 9.80274C2.12903 10.9033 0.3125 13.447 0.3125 16.4063H1.75C1.75 13.2224 4.31616 10.6563 7.5 10.6563C10.6838 10.6563 13.25 13.2224 13.25 16.4063H14.6875C14.6875 13.447 12.871 10.9033 10.3076 9.80274C11.6469 8.89587 12.5313 7.3573 12.5313 5.625C12.5313 2.85388 10.2711 0.59375 7.5 0.59375ZM7.5 2.03125C9.49341 2.03125 11.0938 3.63159 11.0938 5.625C11.0938 7.61841 9.49341 9.21875 7.5 9.21875C5.50659 9.21875 3.90625 7.61841 3.90625 5.625C3.90625 3.63159 5.50659 2.03125 7.5 2.03125Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">Lara Joe</span>
                        </span>
                      </p>
                      <h2 class="article-card-heading heading_18">
                        <a class="heading_18" href="{{ route('blog.index') }}">
                          Oreiller ou traversin : que choisir ?
                        </a>
                      </h2>
                      <a class="blog-card-more" href="{{ route('blog.index') }}">
                        Lire l'article
                        <svg
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path d="M5 12h14" />
                          <path d="m13 6 6 6-6 6" />
                        </svg>
                      </a>
                    </div>
                  </div>
                  <div
                    class="article-slick-item"
                    data-aos="fade-up"
                    data-aos-duration="700"
                  >
                    <div class="article-card blog-card">
                      <a class="article-card-img-wrapper" href="{{ route('blog.index') }}">
                        <img loading="lazy" decoding="async"                           src="{{ asset('assets/maquette/') }}/img/blog/furniture-4.jpg"
                          alt="img"
                          class="article-card-img rounded"
                        />
                        <span class="article-tag article-tag-absolute rounded"
                          >Mobilier</span
                        >
                      </a>
                      <p
                        class="article-card-published text_12 d-flex align-items-center"
                      >
                        <span class="article-date d-flex align-items-center">
                          <span class="icon-publish">
                            <svg
                              width="17"
                              height="18"
                              viewBox="0 0 17 18"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M3.46875 0.875V1.59375H0.59375V17.4063H16.4063V1.59375H13.5313V0.875H12.0938V1.59375H4.90625V0.875H3.46875ZM2.03125 3.03125H3.46875V3.75H4.90625V3.03125H12.0938V3.75H13.5313V3.03125H14.9688V4.46875H2.03125V3.03125ZM2.03125 5.90625H14.9688V15.9688H2.03125V5.90625ZM6.34375 7.34375V8.78125H7.78125V7.34375H6.34375ZM9.21875 7.34375V8.78125H10.6563V7.34375H9.21875ZM12.0938 7.34375V8.78125H13.5313V7.34375H12.0938ZM3.46875 10.2188V11.6563H4.90625V10.2188H3.46875ZM6.34375 10.2188V11.6563H7.78125V10.2188H6.34375ZM9.21875 10.2188V11.6563H10.6563V10.2188H9.21875ZM12.0938 10.2188V11.6563H13.5313V10.2188H12.0938ZM3.46875 13.0938V14.5313H4.90625V13.0938H3.46875ZM6.34375 13.0938V14.5313H7.78125V13.0938H6.34375ZM9.21875 13.0938V14.5313H10.6563V13.0938H9.21875Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">30 décembre 2022</span>
                        </span>
                        <span
                          class="article-author d-flex align-items-center ms-4"
                        >
                          <span class="icon-author"
                            ><svg
                              width="15"
                              height="17"
                              viewBox="0 0 15 17"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M7.5 0.59375C4.72888 0.59375 2.46875 2.85388 2.46875 5.625C2.46875 7.3573 3.35315 8.89587 4.69238 9.80274C2.12903 10.9033 0.3125 13.447 0.3125 16.4063H1.75C1.75 13.2224 4.31616 10.6563 7.5 10.6563C10.6838 10.6563 13.25 13.2224 13.25 16.4063H14.6875C14.6875 13.447 12.871 10.9033 10.3076 9.80274C11.6469 8.89587 12.5313 7.3573 12.5313 5.625C12.5313 2.85388 10.2711 0.59375 7.5 0.59375ZM7.5 2.03125C9.49341 2.03125 11.0938 3.63159 11.0938 5.625C11.0938 7.61841 9.49341 9.21875 7.5 9.21875C5.50659 9.21875 3.90625 7.61841 3.90625 5.625C3.90625 3.63159 5.50659 2.03125 7.5 2.03125Z"
                                fill="#00234D"
                              />
                            </svg>
                          </span>
                          <span class="ms-2">Lara Joe</span>
                        </span>
                      </p>
                      <h2 class="article-card-heading heading_18">
                        <a class="heading_18" href="{{ route('blog.index') }}">
                          Les secrets d'un sommeil réparateur.
                        </a>
                      </h2>
                      <a class="blog-card-more" href="{{ route('blog.index') }}">
                        Lire l'article
                        <svg
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path d="M5 12h14" />
                          <path d="m13 6 6 6-6 6" />
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
                <div
                  class="activate-arrows show-arrows-always article-arrows arrows-white"
                ></div>
              </div>
            </div>
          </div>
        </div>
        <!-- latest blog end -->
@endsection
