@extends('maquette.layout')

@section('title', 'Magazine Mobilier Addict — Conseils déco & maison à Abidjan')
@section('meta_description', 'Conseils pratiques pour aménager et équiper votre maison à Abidjan et en Côte d\'Ivoire : salon, literie, mobilier, livraison et entretien.')

@push('meta')
    <meta property="og:image" content="{{ $blogFeaturedPost?->image_url ?? asset('assets/maquette/img/blog/furniture-2.jpg') }}" />
    <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@type' => 'Blog',
            'name' => 'Le magazine Mobilier Addict',
            'url' => route('blog.index'),
            'inLanguage' => 'fr-CI',
            'blogPost' => $blogPosts->map(fn ($p) => [
                '@type' => 'BlogPosting',
                'headline' => $p->title,
                'url' => route('blog.show', $p->slug),
                'image' => $p->image_url ?? null,
                'datePublished' => optional($p->published_at)->toISOString(),
            ])->filter()->values()->all(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@push('styles')
    <style>
        .blog-meta { display: flex; align-items: center; gap: 12px; font-size: 12px; color: #7a8794; margin-bottom: 8px; }
        .blog-meta .sep { width: 3px; height: 3px; border-radius: 50%; background: currentColor; }
        .magazine-card-img-link { display: block; overflow: hidden; }
        .magazine-card-img-link img { transition: transform .5s ease; display: block; width: 100%; }
        .magazine-card:hover .magazine-card-img-link img { transform: scale(1.05); }
        .magazine-topics a { transition: background .2s, color .2s; }
        .magazine-topics a.is-active { background: #00234d; color: #fff; }
        .magazine-topics a .topic-count { opacity: .65; font-size: 11px; margin-left: 4px; }
        .blog-cta-band {
            margin-top: 64px; border-radius: 18px; padding: 36px;
            background: linear-gradient(135deg, #00234d 0%, #0b3059 100%);
            color: #fff; display: flex; flex-wrap: wrap; gap: 20px;
            align-items: center; justify-content: space-between;
        }
        .blog-cta-band h2 { color: #fff; font-size: 24px; margin: 0 0 6px; }
        .blog-cta-band p { margin: 0; color: rgba(255,255,255,.75); font-size: 14px; }
        .blog-cta-band a {
            display: inline-flex; align-items: center; gap: 8px; padding: 13px 26px;
            border-radius: 999px; background: linear-gradient(120deg, #b92467, #d8327f);
            color: #fff; font-weight: 700; font-size: 14px; white-space: nowrap;
            transition: transform .2s, box-shadow .2s;
        }
        .blog-cta-band a:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(216,50,127,.4); color: #fff; }
    </style>
@endpush

@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb">
        <div class="container">
            <ul class="list-unstyled d-flex align-items-center m-0">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li>
                    <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.4"><path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000"/></g></svg>
                </li>
                <li>Magazine</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <div class="container">
        <header class="magazine-intro">
            <div>
                <p class="magazine-kicker">Le journal de la maison · Mobilier Addict</p>
                <h1>Des idées pour<br><span>mieux vivre chez vous.</span></h1>
            </div>
            <p>Un salon où l'on aime recevoir, une chambre propice au repos, des meubles dont on prend soin : retrouvez nos conseils pour un intérieur agréable à vivre, à Abidjan comme ailleurs en Côte d'Ivoire.</p>
        </header>

        <nav class="magazine-topics" aria-label="Filtrer les articles par thème">
            <span>Thèmes</span>
            <a href="{{ route('blog.index') }}" class="{{ !$activeCategory ? 'is-active' : '' }}">Tous</a>
            @foreach($blogCategories as $cat)
                <a href="{{ route('blog.index', ['category' => $cat->slug]) }}" class="{{ $activeCategory?->id === $cat->id ? 'is-active' : '' }}">
                    {{ $cat->name }}<span class="topic-count">({{ $cat->posts_count }})</span>
                </a>
            @endforeach
            <a href="{{ route('pages.conseils') }}">Guides maison</a>
            <a href="{{ route('menu.show', 'matelas') }}">Literie</a>
        </nav>

        @if($activeCategory)
            <p class="text_14 mt-3">
                Thème : <strong>{{ $activeCategory->name }}</strong>
                — <a href="{{ route('blog.index') }}">Tout afficher</a>
            </p>
        @endif

        @if($blogFeaturedPost)
            <section aria-label="Article à la une">
            <article class="magazine-feature" aria-labelledby="featured-title">
                <a class="magazine-feature-image magazine-card-img-link" href="{{ route('blog.show', $blogFeaturedPost->slug) }}">
                    <img loading="eager" fetchpriority="high" decoding="async" src="{{ $blogFeaturedPost->image_url ?? asset('assets/maquette/img/blog/furniture-2.jpg') }}" alt="{{ $blogFeaturedPost->title }}" width="1400" height="1169">
                    <span>À la une · {{ $blogFeaturedPost->category?->name ?? 'Blog' }}</span>
                </a>
                <div class="magazine-feature-content">
                    <div class="blog-meta">
                        <span>{{ $blogFeaturedPost->category?->name ?? 'Conseils' }}</span>
                        <span class="sep"></span>
                        <time datetime="{{ optional($blogFeaturedPost->published_at)->toDateString() }}">{{ optional($blogFeaturedPost->published_at)->format('d/m/Y') }}</time>
                        <span class="sep"></span>
                        <span>{{ $blogFeaturedPost->reading_time }} min de lecture</span>
                    </div>
                    <h2 id="featured-title">{{ $blogFeaturedPost->title }}</h2>
                    <p>{{ Str::limit($blogFeaturedPost->excerpt ?? $blogFeaturedPost->content, 180) }}</p>
                    <a class="magazine-button" href="{{ route('blog.show', $blogFeaturedPost->slug) }}">Lire l'article <span aria-hidden="true">↗</span></a>
                </div>
            </article>
            </section>
        @endif

        <section class="magazine-guides" aria-labelledby="magazine-guides-title">
            <div class="magazine-section-heading">
                <div>
                    <p class="magazine-kicker">{{ $activeCategory ? $activeCategory->name : 'Tous nos articles' }}</p>
                    <h2 id="magazine-guides-title">La maison, au quotidien</h2>
                </div>
                <p>Choisir avec soin, préparer son installation et faire durer ce que l'on aime.</p>
            </div>
            <div class="magazine-grid">
                @forelse($blogPosts as $post)
                    <article class="magazine-card" aria-labelledby="post-{{ $post->id }}-title">
                        <a class="magazine-card-img-link" href="{{ route('blog.show', $post->slug) }}" tabindex="-1" aria-hidden="true">
                            <img loading="lazy" decoding="async" src="{{ $post->image_url ?? asset('assets/maquette/img/blog/furniture-1.jpg') }}" alt="{{ $post->title }}" width="1400" height="1169">
                        </a>
                        <div class="magazine-card-content">
                            <div class="blog-meta">
                                <span class="magazine-category">{{ $post->category?->name ?? 'Conseils' }}</span>
                                <span class="sep"></span>
                                <time datetime="{{ optional($post->published_at)->toDateString() }}">{{ optional($post->published_at)->format('d/m/Y') }}</time>
                                <span class="sep"></span>
                                <span>{{ $post->reading_time }} min</span>
                            </div>
                            <h3 id="post-{{ $post->id }}-title">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="magazine-excerpt">{{ Str::limit($post->excerpt ?? $post->content, 120) }}</p>
                            <a class="magazine-read" href="{{ route('blog.show', $post->slug) }}">Lire la suite <span aria-hidden="true">→</span></a>
                        </div>
                    </article>
                @empty
                    <p>Aucun article dans ce thème pour le moment. <a href="{{ route('blog.index') }}">Voir tous les articles</a></p>
                @endforelse
            </div>
            @if($blogPosts->hasPages())
                <div class="pagination-wrapper mt-4">
                    {{ $blogPosts->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </section>

        <div class="blog-cta-band" data-aos="fade-up" data-aos-duration="700">
            <div>
                <h2>Un projet d'aménagement en tête&nbsp;?</h2>
                <p>Entreprise, hôtel, institution ou particulier : obtenez une proposition chiffrée adaptée à votre besoin.</p>
            </div>
            <a href="{{ route('devis.create') }}">Demander un devis sur-mesure →</a>
        </div>
    </div>
@endsection
