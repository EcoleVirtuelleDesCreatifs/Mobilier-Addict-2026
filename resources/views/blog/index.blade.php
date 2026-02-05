@extends('layouts.front')

@section('title', 'Blog')
@section('meta_description', "Découvrez nos articles, inspirations et conseils déco.")

@push('styles')
    <style>
        .blogx-page { background: #0b0b12; }
        .blogx-hero { position: relative; padding: 62px 0 18px; overflow: hidden; }
        .blogx-hero__bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(900px 600px at 10% 10%, rgba(255, 76, 154, .22), transparent 65%),
                radial-gradient(900px 600px at 95% 20%, rgba(122, 92, 255, .22), transparent 60%),
                radial-gradient(900px 600px at 45% 90%, rgba(18, 184, 134, .16), transparent 60%),
                linear-gradient(180deg, #070710 0%, #111128 55%, #070710 100%);
        }
        .blogx-hero__grid { position: relative; display: grid; grid-template-columns: 1.15fr .85fr; gap: 18px; align-items: stretch; }
        .blogx-kicker { display: inline-flex; align-items: center; gap: 10px; padding: 8px 12px; border-radius: 999px; background: rgba(255,255,255,.10); border: 1px solid rgba(255,255,255,.14); color: rgba(255,255,255,.88); font-weight: 800; font-size: 13px; letter-spacing: .2px; }
        .blogx-title { margin: 14px 0 10px; color: #fff; font-weight: 900; letter-spacing: -0.8px; line-height: 1.06; font-size: clamp(30px, 4.6vw, 52px); }
        .blogx-subtitle { color: rgba(255,255,255,.72); max-width: 68ch; font-size: 15px; line-height: 1.7; margin: 0; }
        .blogx-actions { margin-top: 18px; display: flex; flex-wrap: wrap; gap: 12px; }
        .blogx-btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 12px 14px; border-radius: 14px; border: 1px solid rgba(255,255,255,.16); color: #fff; text-decoration: none; font-weight: 800; background: rgba(255,255,255,.10); backdrop-filter: blur(12px); transition: transform .15s ease, background .15s ease; }
        .blogx-btn:hover { transform: translateY(-1px); background: rgba(255,255,255,.14); }
        .blogx-btn--primary { background: linear-gradient(135deg, rgba(255, 76, 154, .94), rgba(122, 92, 255, .94)); border-color: rgba(255,255,255,.18); }
        .blogx-btn--primary:hover { background: linear-gradient(135deg, rgba(255, 76, 154, .99), rgba(122, 92, 255, .99)); }

        .blogx-panel { border-radius: 22px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.14); box-shadow: 0 18px 48px rgba(0,0,0,.35); backdrop-filter: blur(14px); }
        .blogx-panel__inner { padding: 18px; display: grid; gap: 10px; }
        .blogx-chip { display: inline-flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 14px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.10); color: rgba(255,255,255,.86); font-weight: 900; text-decoration: none; font-size: 13px; }
        .blogx-chip:hover { background: rgba(255,255,255,.12); }

        .blogx-body { padding: 18px 0 70px; }
        .blogx-section { margin-top: 18px; border-radius: 22px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); box-shadow: 0 18px 48px rgba(0,0,0,.28); overflow: hidden; }
        .blogx-section__head { padding: 20px 20px 0; }
        .blogx-section__title { margin: 0; color: #fff; font-weight: 900; letter-spacing: -.4px; font-size: 20px; }
        .blogx-section__subtitle { margin: 8px 0 0; color: rgba(255,255,255,.70); font-size: 14px; line-height: 1.7; }
        .blogx-section__body { padding: 20px; }

        .blogx-featured { display: grid; grid-template-columns: 1.1fr .9fr; gap: 16px; align-items: stretch; }
        .blogx-featured__media { position: relative; border-radius: 18px; overflow: hidden; min-height: 240px; border: 1px solid rgba(255,255,255,.10); }
        .blogx-featured__media img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .blogx-featured__badge { position: absolute; top: 14px; left: 14px; padding: 8px 10px; border-radius: 999px; background: rgba(0,0,0,.55); border: 1px solid rgba(255,255,255,.18); color: #fff; font-weight: 900; font-size: 12px; }
        .blogx-featured__body { border-radius: 18px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); padding: 16px; }
        .blogx-meta { display: flex; flex-wrap: wrap; gap: 10px; color: rgba(255,255,255,.70); font-size: 13px; font-weight: 800; }
        .blogx-meta span { display: inline-flex; align-items: center; gap: 8px; }
        .blogx-featured__title { margin: 10px 0 8px; color: #fff; font-weight: 950; letter-spacing: -.3px; font-size: 22px; line-height: 1.18; }
        .blogx-featured__excerpt { margin: 0; color: rgba(255,255,255,.72); font-size: 14px; line-height: 1.7; }
        .blogx-featured__link { margin-top: 12px; display: inline-flex; align-items: center; gap: 10px; color: #fff; font-weight: 900; text-decoration: none; }

        .blogx-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
        .blogx-card { border-radius: 22px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); overflow: hidden; box-shadow: 0 18px 48px rgba(0,0,0,.18); }
        .blogx-card__media { aspect-ratio: 16/10; overflow: hidden; }
        .blogx-card__media img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .25s ease; }
        .blogx-card:hover .blogx-card__media img { transform: scale(1.03); }
        .blogx-card__body { padding: 14px; }
        .blogx-card__title { margin: 10px 0 8px; color: #fff; font-weight: 950; letter-spacing: -.2px; font-size: 16px; line-height: 1.25; }
        .blogx-card__excerpt { margin: 0; color: rgba(255,255,255,.72); font-size: 13.5px; line-height: 1.65; }

        .blogx-news { display: grid; grid-template-columns: 1.1fr .9fr; gap: 16px; align-items: center; }
        .blogx-news__title { margin: 0; color: #fff; font-weight: 950; letter-spacing: -.2px; font-size: 18px; }
        .blogx-news__text { margin: 8px 0 0; color: rgba(255,255,255,.72); font-size: 14px; line-height: 1.7; }
        .blogx-news__form { display: flex; gap: 10px; flex-wrap: wrap; justify-content: flex-end; }
        .blogx-input { flex: 1 1 240px; min-width: 200px; padding: 12px 12px; border-radius: 14px; border: 1px solid rgba(255,255,255,.14); background: rgba(255,255,255,.06); color: #fff; outline: none; }
        .blogx-input::placeholder { color: rgba(255,255,255,.52); }
        .blogx-input:focus { border-color: rgba(255, 76, 154, .65); box-shadow: 0 0 0 4px rgba(255, 76, 154, .14); }

        .blogx-pagination { margin-top: 18px; }
        .blogx-pagination .pagination { gap: 8px; }
        .blogx-pagination .page-link { background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); color: #fff; border-radius: 12px; }
        .blogx-pagination .page-item.active .page-link { background: rgba(255,255,255,.14); border-color: rgba(255,255,255,.18); }
        .blogx-pagination .page-item.disabled .page-link { color: rgba(255,255,255,.45); }

        @media (max-width: 991.98px) {
            .blogx-hero__grid { grid-template-columns: 1fr; }
            .blogx-featured { grid-template-columns: 1fr; }
            .blogx-grid { grid-template-columns: 1fr; }
            .blogx-news { grid-template-columns: 1fr; }
            .blogx-news__form { justify-content: flex-start; }
        }
    </style>
@endpush

@section('content')
<div class="blogx-page">
    <section class="blogx-hero" aria-label="Blog">
        <div class="blogx-hero__bg"></div>
        <div class="container">
            <div class="blogx-hero__grid">
                <div>
                    <div class="blogx-kicker">
                        <i class="fa-solid fa-sparkles"></i>
                        Inspirations • Conseils • Tendances
                    </div>
                    <h1 class="blogx-title">Le Blog Mobilier Addict</h1>
                    <p class="blogx-subtitle">Des idées concrètes pour sublimer votre intérieur, mieux dormir et choisir les bons produits — avec des articles clairs, utiles et modernes.</p>

                    <div class="blogx-actions">
                        <a class="blogx-btn blogx-btn--primary" href="#articles"><i class="fa-solid fa-newspaper"></i> Parcourir les articles <i class="fa-solid fa-arrow-right"></i></a>
                        <a class="blogx-btn" href="{{ route('pages.guides.mattress') }}"><i class="fa-solid fa-bed"></i> Guide matelas</a>
                        <a class="blogx-btn" href="{{ route('pages.contact') }}"><i class="fa-solid fa-headset"></i> Support</a>
                    </div>
                </div>

                <aside class="blogx-panel" aria-label="Liens rapides">
                    <div class="blogx-panel__inner">
                        <a class="blogx-chip" href="{{ route('pages.guides.mattress') }}"><i class="fa-solid fa-moon"></i> Guides sommeil</a>
                        <a class="blogx-chip" href="{{ route('univers.show', ['slug' => 'matelas']) }}"><i class="fa-solid fa-bed"></i> Matelas</a>
                        <a class="blogx-chip" href="{{ route('univers.show', ['slug' => 'oreillers']) }}"><i class="fa-solid fa-couch"></i> Oreillers</a>
                        <a class="blogx-chip" href="{{ route('pages.shipping-returns') }}"><i class="fa-solid fa-truck-fast"></i> Livraison &amp; Retours</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="blogx-body" id="articles" aria-label="Articles">
        <div class="container">
            @if($featured)
                <div class="blogx-section" aria-label="Article à la une">
                    <div class="blogx-section__head">
                        <h2 class="blogx-section__title">À la une</h2>
                        <p class="blogx-section__subtitle">Un article sélectionné pour commencer fort.</p>
                    </div>
                    <div class="blogx-section__body">
                        <a href="{{ route('blog.show', $featured->slug) }}" style="text-decoration:none;color:inherit">
                            <div class="blogx-featured">
                                <div class="blogx-featured__media">
                                    @if($featured->image)
                                        <img src="@image_url($featured->image)" alt="{{ $featured->image_alt ?: $featured->title }}" loading="lazy" />
                                    @else
                                        <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=1200&h=600&fit=crop" alt="{{ $featured->image_alt ?: $featured->title }}" loading="lazy" />
                                    @endif
                                    <div class="blogx-featured__badge">À la une</div>
                                </div>
                                <div class="blogx-featured__body">
                                    <div class="blogx-meta">
                                        <span><i class="fa-solid fa-tag"></i> {{ $featured->category?->name ?: 'Article' }}</span>
                                        @if($featured->published_at)
                                            <span><i class="fa-regular fa-calendar"></i> {{ $featured->published_at->format('d M Y') }}</span>
                                        @endif
                                        @if($featured->reading_time)
                                            <span><i class="fa-regular fa-clock"></i> {{ (int) $featured->reading_time }} min</span>
                                        @endif
                                    </div>
                                    <h3 class="blogx-featured__title">{{ $featured->title }}</h3>
                                    <p class="blogx-featured__excerpt">{{ $featured->excerpt ?: ' ' }}</p>
                                    <span class="blogx-featured__link">Lire l'article <i class="fa-solid fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

            <div class="blogx-section" aria-label="Tous les articles">
                <div class="blogx-section__head">
                    <h2 class="blogx-section__title">Tous les articles</h2>
                    <p class="blogx-section__subtitle">Idées déco, conseils literie, inspirations et guides pratiques.</p>
                </div>
                <div class="blogx-section__body">
                    <div class="blogx-grid">
                        @foreach($posts as $post)
                            <article class="blogx-card">
                                <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration:none;color:inherit">
                                    <div class="blogx-card__media">
                                        @if($post->image)
                                            <img src="@image_url($post->image)" alt="{{ $post->image_alt ?: $post->title }}" loading="lazy" />
                                        @else
                                            <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&h=500&fit=crop" alt="{{ $post->image_alt ?: $post->title }}" loading="lazy" />
                                        @endif
                                    </div>
                                    <div class="blogx-card__body">
                                        <div class="blogx-meta">
                                            <span><i class="fa-solid fa-tag"></i> {{ $post->category?->name ?: 'Article' }}</span>
                                            @if($post->published_at)
                                                <span><i class="fa-regular fa-calendar"></i> {{ $post->published_at->format('d M Y') }}</span>
                                            @endif
                                            @if($post->reading_time)
                                                <span><i class="fa-regular fa-clock"></i> {{ (int) $post->reading_time }} min</span>
                                            @endif
                                        </div>
                                        <h3 class="blogx-card__title">{{ $post->title }}</h3>
                                        <p class="blogx-card__excerpt">{{ $post->excerpt ?: ' ' }}</p>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>

                    <div class="blogx-pagination">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>

            <div class="blogx-section" aria-label="Newsletter">
                <div class="blogx-section__head">
                    <h2 class="blogx-section__title">Recevoir les prochains articles</h2>
                    <p class="blogx-section__subtitle">Inscris-toi et reçois nos inspirations et conseils directement par email.</p>
                </div>
                <div class="blogx-section__body">
                    <div class="blogx-news">
                        <div>
                            <h3 class="blogx-news__title">Newsletter Mobilier Addict</h3>
                            <p class="blogx-news__text">Promos, conseils literie, inspirations déco et nouveautés — sans spam.</p>
                        </div>
                        <form class="blogx-news__form" action="{{ route('newsletter.subscribe') }}" method="POST">
                            @csrf
                            <input class="blogx-input" type="email" name="email" placeholder="Votre email" required>
                            <button class="blogx-btn blogx-btn--primary" type="submit">
                                S'inscrire
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
