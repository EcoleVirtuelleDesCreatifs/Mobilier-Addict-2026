@extends('layouts.front')

@section('title', 'Blog')
@section('meta_description', "Découvrez nos articles, inspirations et conseils déco.")

@push('styles')
    <style>
        .blog-index-modern {
            position: relative;
            min-height: 100vh;
            background: linear-gradient(180deg, #0f0f23 0%, #1a1a3e 50%, #0f0f23 100%);
            overflow: hidden
        }

        .blog-index-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2250%22 cy=%2250%22 r=%221%22 fill=%22rgba(255,255,255,.03)%22/></svg>');
            background-size: 50px 50px
        }

        .blog-index-modern__bg-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            pointer-events: none
        }

        .blog-index-modern__bg-circle--1 {
            width: 800px;
            height: 800px;
            background: rgba(236,72,153,.25);
            top: -300px;
            right: -200px
        }

        .blog-index-modern__bg-circle--2 {
            width: 600px;
            height: 600px;
            background: rgba(59,130,246,.2);
            bottom: -200px;
            left: -200px
        }

        .blog-index-modern__bg-circle--3 {
            width: 400px;
            height: 400px;
            background: rgba(16,185,129,.15);
            top: 40%;
            left: 20%
        }

        .blog-index-modern__container {
            position: relative;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px
        }

        .blog-index-modern__hero {
            padding: 120px 0 80px;
            text-align: center
        }

        .blog-index-modern__badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 28px;
            background: rgba(236,72,153,.2);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            margin-bottom: 32px;
            border: 1px solid rgba(236,72,153,.4);
            color: #fff;
            font-size: 0.9375rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            box-shadow: 0 8px 32px rgba(236,72,153,.3)
        }

        .blog-index-modern__title {
            font-size: clamp(3rem, 6vw, 5rem);
            font-weight: 900;
            color: #fff;
            margin: 0 0 24px;
            letter-spacing: -0.03em;
            line-height: 1.05;
            text-shadow: 0 4px 30px rgba(0,0,0,.3)
        }

        .blog-index-modern__title span {
            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 50%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text
        }

        .blog-index-modern__subtitle {
            font-size: 1.25rem;
            color: rgba(255,255,255,.85);
            margin: 0 auto 48px;
            max-width: 700px;
            line-height: 1.7
        }

        .blog-index-modern__actions {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap
        }

        .blog-index-modern__btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 800;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all .3s ease
        }

        .blog-index-modern__btn--primary {
            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
            color: #fff;
            box-shadow: 0 10px 40px rgba(236,72,153,.4)
        }

        .blog-index-modern__btn--primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 50px rgba(236,72,153,.5)
        }

        .blog-index-modern__btn--secondary {
            background: rgba(255,255,255,.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,.2);
            color: #fff
        }

        .blog-index-modern__btn--secondary:hover {
            background: rgba(255,255,255,.15);
            transform: translateY(-2px)
        }

        .blog-index-modern__body {
            padding: 0 0 100px
        }

        .blog-index-modern__section {
            margin-bottom: 60px;
            padding: 40px;
            background: rgba(255,255,255,.05);
            backdrop-filter: blur(20px);
            border-radius: 32px;
            border: 1px solid rgba(255,255,255,.1);
            box-shadow: 0 25px 80px rgba(0,0,0,.3)
        }

        .blog-index-modern__section-header {
            margin-bottom: 32px
        }

        .blog-index-modern__section-title {
            font-size: 2rem;
            font-weight: 900;
            color: #fff;
            margin: 0 0 12px;
            letter-spacing: -0.02em
        }

        .blog-index-modern__section-subtitle {
            font-size: 1.0625rem;
            color: rgba(255,255,255,.7);
            margin: 0
        }

        .blog-index-modern__featured {
            display: grid;
            grid-template-columns: 1.3fr 1fr;
            gap: 0;
            border-radius: 24px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 25px 60px rgba(0,0,0,.3);
            transition: all .4s ease
        }

        .blog-index-modern__featured:hover {
            transform: translateY(-8px);
            box-shadow: 0 35px 80px rgba(0,0,0,.4)
        }

        .blog-index-modern__featured-image {
            position: relative;
            min-height: 400px;
            overflow: hidden
        }

        .blog-index-modern__featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease
        }

        .blog-index-modern__featured:hover .blog-index-modern__featured-image img {
            transform: scale(1.05)
        }

        .blog-index-modern__featured-badge {
            position: absolute;
            top: 24px;
            left: 24px;
            padding: 10px 24px;
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
            color: #fff;
            border-radius: 25px;
            font-size: 0.875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 24px rgba(236,72,153,.4)
        }

        .blog-index-modern__featured-content {
            padding: 40px;
            background: rgba(255,255,255,.08);
            display: flex;
            flex-direction: column;
            justify-content: center
        }

        .blog-index-modern__meta {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap
        }

        .blog-index-modern__meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9375rem;
            color: rgba(255,255,255,.8);
            font-weight: 600
        }

        .blog-index-modern__meta-item i {
            color: #ec4899
        }

        .blog-index-modern__featured-title {
            font-size: 1.875rem;
            font-weight: 900;
            color: #fff;
            margin: 0 0 16px;
            line-height: 1.2;
            letter-spacing: -0.02em
        }

        .blog-index-modern__featured-excerpt {
            font-size: 1.0625rem;
            color: rgba(255,255,255,.75);
            line-height: 1.7;
            margin: 0 0 24px
        }

        .blog-index-modern__featured-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #ec4899;
            font-weight: 800;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all .3s ease
        }

        .blog-index-modern__featured-link:hover {
            color: #be185d;
            gap: 14px
        }

        .blog-index-modern__grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px
        }

        .blog-index-modern__card {
            background: rgba(255,255,255,.08);
            border-radius: 24px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 20px 60px rgba(0,0,0,.2);
            transition: all .4s ease
        }

        .blog-index-modern__card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 80px rgba(0,0,0,.3)
        }

        .blog-index-modern__card-image {
            position: relative;
            aspect-ratio: 16/10;
            overflow: hidden
        }

        .blog-index-modern__card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease
        }

        .blog-index-modern__card:hover .blog-index-modern__card-image img {
            transform: scale(1.08)
        }

        .blog-index-modern__card-content {
            padding: 24px
        }

        .blog-index-modern__card-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #fff;
            margin: 0 0 12px;
            line-height: 1.3;
            letter-spacing: -0.01em
        }

        .blog-index-modern__card-excerpt {
            font-size: 0.9375rem;
            color: rgba(255,255,255,.7);
            line-height: 1.6;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden
        }

        .blog-index-modern__newsletter {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center
        }

        .blog-index-modern__newsletter-content h3 {
            font-size: 1.75rem;
            font-weight: 900;
            color: #fff;
            margin: 0 0 16px;
            letter-spacing: -0.02em
        }

        .blog-index-modern__newsletter-content p {
            font-size: 1.0625rem;
            color: rgba(255,255,255,.75);
            margin: 0;
            line-height: 1.6
        }

        .blog-index-modern__newsletter-form {
            display: flex;
            gap: 12px;
            flex-wrap: wrap
        }

        .blog-index-modern__input {
            flex: 1;
            min-width: 250px;
            padding: 16px 24px;
            border-radius: 50px;
            border: 1px solid rgba(255,255,255,.2);
            background: rgba(255,255,255,.1);
            color: #fff;
            font-size: 1rem;
            outline: none;
            transition: all .3s ease
        }

        .blog-index-modern__input::placeholder {
            color: rgba(255,255,255,.5)
        }

        .blog-index-modern__input:focus {
            border-color: #ec4899;
            box-shadow: 0 0 0 4px rgba(236,72,153,.2)
        }

        .blog-index-modern__pagination {
            margin-top: 48px;
            display: flex;
            justify-content: center;
            gap: 12px
        }

        .blog-index-modern__page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 50%;
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            transition: all .3s ease
        }

        .blog-index-modern__page-link:hover {
            background: rgba(255,255,255,.2);
            transform: translateY(-2px)
        }

        .blog-index-modern__page-link.active {
            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
            border-color: transparent
        }

        @media (max-width: 1024px) {
            .blog-index-modern__featured {
                grid-template-columns: 1fr
            }

            .blog-index-modern__featured-image {
                min-height: 300px
            }

            .blog-index-modern__grid {
                grid-template-columns: repeat(2, 1fr)
            }

            .blog-index-modern__newsletter {
                grid-template-columns: 1fr
            }
        }

        @media (max-width: 768px) {
            .blog-index-modern__hero {
                padding: 80px 0 60px
            }

            .blog-index-modern__section {
                padding: 24px
            }

            .blog-index-modern__grid {
                grid-template-columns: 1fr
            }

            .blog-index-modern__featured-content {
                padding: 28px
            }

            .blog-index-modern__featured-title {
                font-size: 1.5rem
            }

            .blog-index-modern__newsletter-form {
                flex-direction: column
            }

            .blog-index-modern__input {
                min-width: 100%
            }
        }
    </style>
@endpush

@section('content')
<div class="blog-index-modern">
    <div class="blog-index-modern__bg-circle blog-index-modern__bg-circle--1"></div>
    <div class="blog-index-modern__bg-circle blog-index-modern__bg-circle--2"></div>
    <div class="blog-index-modern__bg-circle blog-index-modern__bg-circle--3"></div>

    <div class="blog-index-modern__container">
        <div class="blog-index-modern__hero">
            <div class="blog-index-modern__badge">
                <i class="fa-solid fa-sparkles"></i> Inspirations • Conseils • Tendances
            </div>
            <h1 class="blog-index-modern__title">Le Blog <span>Mobilier Addict</span></h1>
            <p class="blog-index-modern__subtitle">Des idées concrètes pour sublimer votre intérieur, mieux dormir et choisir les bons produits — avec des articles clairs, utiles et modernes.</p>
            <div class="blog-index-modern__actions">
                <a class="blog-index-modern__btn blog-index-modern__btn--primary" href="#articles">
                    <i class="fa-solid fa-newspaper"></i> Parcourir les articles
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a class="blog-index-modern__btn blog-index-modern__btn--secondary" href="http://127.0.0.1:8000/a-propos">
                    <i class="fa-solid fa-info-circle"></i> En savoir plus
                </a>
            </div>
        </div>

        <div class="blog-index-modern__body" id="articles">
            @if($featured)
                <div class="blog-index-modern__section">
                    <div class="blog-index-modern__section-header">
                        <h2 class="blog-index-modern__section-title">À la une</h2>
                        <p class="blog-index-modern__section-subtitle">Un article sélectionné pour commencer fort.</p>
                    </div>
                    <a href="{{ route('blog.show', $featured->slug) }}" class="blog-index-modern__featured">
                        <div class="blog-index-modern__featured-image">
                            @if($featured->image)
                                <img src="@image_url($featured->image)" alt="{{ $featured->image_alt ?: $featured->title }}" loading="lazy" />
                            @else
                                <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=1200&h=600&fit=crop" alt="{{ $featured->image_alt ?: $featured->title }}" loading="lazy" />
                            @endif
                            <span class="blog-index-modern__featured-badge">À la une</span>
                        </div>
                        <div class="blog-index-modern__featured-content">
                            <div class="blog-index-modern__meta">
                                <span class="blog-index-modern__meta-item"><i class="fa-solid fa-tag"></i> {{ $featured->category?->name ?: 'Article' }}</span>
                                @if($featured->published_at)
                                    <span class="blog-index-modern__meta-item"><i class="fa-regular fa-calendar"></i> {{ $featured->published_at->format('d M Y') }}</span>
                                @endif
                                @if($featured->reading_time)
                                    <span class="blog-index-modern__meta-item"><i class="fa-regular fa-clock"></i> {{ (int) $featured->reading_time }} min</span>
                                @endif
                            </div>
                            <h3 class="blog-index-modern__featured-title">{{ $featured->title }}</h3>
                            <p class="blog-index-modern__featured-excerpt">{{ $featured->excerpt ?: ' ' }}</p>
                            <span class="blog-index-modern__featured-link">Lire l'article <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
            @endif

            <div class="blog-index-modern__section">
                <div class="blog-index-modern__section-header">
                    <h2 class="blog-index-modern__section-title">Tous les articles</h2>
                    <p class="blog-index-modern__section-subtitle">Idées déco, conseils literie, inspirations et guides pratiques.</p>
                </div>
                <div class="blog-index-modern__grid">
                    @foreach($posts as $post)
                        <a href="{{ route('blog.show', $post->slug) }}" class="blog-index-modern__card">
                            <div class="blog-index-modern__card-image">
                                @if($post->image)
                                    <img src="@image_url($post->image)" alt="{{ $post->image_alt ?: $post->title }}" loading="lazy" />
                                @else
                                    <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&h=500&fit=crop" alt="{{ $post->image_alt ?: $post->title }}" loading="lazy" />
                                @endif
                            </div>
                            <div class="blog-index-modern__card-content">
                                <div class="blog-index-modern__meta">
                                    <span class="blog-index-modern__meta-item"><i class="fa-solid fa-tag"></i> {{ $post->category?->name ?: 'Article' }}</span>
                                    @if($post->published_at)
                                        <span class="blog-index-modern__meta-item"><i class="fa-regular fa-calendar"></i> {{ $post->published_at->format('d M Y') }}</span>
                                    @endif
                                </div>
                                <h3 class="blog-index-modern__card-title">{{ $post->title }}</h3>
                                <p class="blog-index-modern__card-excerpt">{{ $post->excerpt ?: ' ' }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="blog-index-modern__pagination">
                    {{ $posts->links() }}
                </div>
            </div>

            <div class="blog-index-modern__section">
                <div class="blog-index-modern__section-header">
                    <h2 class="blog-index-modern__section-title">Recevoir les prochains articles</h2>
                    <p class="blog-index-modern__section-subtitle">Inscris-toi et reçois nos inspirations et conseils directement par email.</p>
                </div>
                <div class="blog-index-modern__newsletter">
                    <div class="blog-index-modern__newsletter-content">
                        <h3>Newsletter Mobilier Addict</h3>
                        <p>Promos, conseils literie, inspirations déco et nouveautés — sans spam.</p>
                    </div>
                    <form class="blog-index-modern__newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                        @csrf
                        <input class="blog-index-modern__input" type="email" name="email" placeholder="Votre email" required>
                        <button class="blog-index-modern__btn blog-index-modern__btn--primary" type="submit">
                            S'inscrire
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
