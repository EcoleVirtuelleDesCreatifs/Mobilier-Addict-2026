@extends('layouts.front')

@section('title', $post->title)
@section('meta_description', $post->excerpt ?: $post->title)
@section('canonical', route('blog.show', $post->slug))

@section('content')
<section class="blog-post-modern" aria-label="Article">
    <style>
        .blog-post-modern {
            padding: 0;
            background: #fff
        }

        .blog-post-modern__hero {
            position: relative;
            min-height: 60vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden
        }

        .blog-post-modern__hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2250%22 cy=%2250%22 r=%221%22 fill=%22rgba(255,255,255,.03)%22/></svg>');
            background-size: 50px 50px
        }

        .blog-post-modern__hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url(@image_url($post->image));
            background-size: cover;
            background-position: center;
            opacity: .15
        }

        .blog-post-modern__hero-content {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
            padding: 80px 20px;
            text-align: center;
            z-index: 1
        }

        .blog-post-modern__back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: rgba(255,255,255,.1);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            color: #fff;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 32px;
            transition: all .3s ease;
            border: 1px solid rgba(255,255,255,.2)
        }

        .blog-post-modern__back:hover {
            background: rgba(255,255,255,.2);
            transform: translateX(-4px)
        }

        .blog-post-modern__meta {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-bottom: 32px;
            flex-wrap: wrap
        }

        .blog-post-modern__meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255,255,255,.8);
            font-size: 0.9375rem;
            font-weight: 500
        }

        .blog-post-modern__meta-item i {
            color: #ec4899
        }

        .blog-post-modern__title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            color: #fff;
            margin: 0 0 24px;
            letter-spacing: -0.03em;
            line-height: 1.1;
            text-shadow: 0 4px 30px rgba(0,0,0,.3)
        }

        .blog-post-modern__excerpt {
            font-size: 1.25rem;
            color: rgba(255,255,255,.85);
            margin: 0;
            line-height: 1.6;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto
        }

        .blog-post-modern__main {
            max-width: 800px;
            margin: 0 auto;
            padding: 80px 20px
        }

        .blog-post-modern__image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 20px;
            margin-bottom: 48px;
            box-shadow: 0 20px 60px rgba(0,0,0,.1)
        }

        .blog-post-modern__content {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #334155
            font-weight: 400
        }

        .blog-post-modern__content h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
            margin: 48px 0 24px;
            letter-spacing: -0.02em
        }

        .blog-post-modern__content h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin: 32px 0 16px;
            letter-spacing: -0.01em
        }

        .blog-post-modern__content p {
            margin: 0 0 24px
        }

        .blog-post-modern__content ul,
        .blog-post-modern__content ol {
            margin: 0 0 24px 24px;
            padding-left: 24px
        }

        .blog-post-modern__content li {
            margin-bottom: 12px
        }

        .blog-post-modern__content strong {
            color: #0f172a;
            font-weight: 700
        }

        .blog-post-modern__related {
            background: #f8fafc;
            padding: 100px 20px;
            margin-top: 80px
        }

        .blog-post-modern__related-container {
            max-width: 1400px;
            margin: 0 auto
        }

        .blog-post-modern__related-header {
            text-align: center;
            margin-bottom: 60px
        }

        .blog-post-modern__related-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 16px;
            letter-spacing: -0.02em
        }

        .blog-post-modern__related-subtitle {
            font-size: 1.125rem;
            color: #64748b;
            margin: 0
        }

        .blog-post-modern__related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 32px
        }

        .blog-post-modern__related-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,.06);
            transition: all .3s ease;
            text-decoration: none;
            color: inherit
        }

        .blog-post-modern__related-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0,0,0,.12)
        }

        .blog-post-modern__related-card-image {
            height: 220px;
            overflow: hidden
        }

        .blog-post-modern__related-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease
        }

        .blog-post-modern__related-card:hover .blog-post-modern__related-card-image img {
            transform: scale(1.08)
        }

        .blog-post-modern__related-card-body {
            padding: 24px
        }

        .blog-post-modern__related-card-meta {
            font-size: 0.8125rem;
            color: #94a3b8;
            margin-bottom: 12px;
            font-weight: 500
        }

        .blog-post-modern__related-card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 12px;
            line-height: 1.4;
            letter-spacing: -0.01em
        }

        .blog-post-modern__related-card-excerpt {
            font-size: 0.9375rem;
            color: #64748b;
            line-height: 1.6;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden
        }

        @media (max-width: 768px) {
            .blog-post-modern__hero {
                min-height: 50vh
            }

            .blog-post-modern__hero-content {
                padding: 60px 20px
            }

            .blog-post-modern__title {
                font-size: 2rem
            }

            .blog-post-modern__excerpt {
                font-size: 1rem
            }

            .blog-post-modern__main {
                padding: 60px 20px
            }

            .blog-post-modern__image {
                height: 300px;
                margin-bottom: 32px
            }

            .blog-post-modern__content {
                font-size: 1rem
            }

            .blog-post-modern__content h2 {
                font-size: 1.5rem;
                margin: 32px 0 16px
            }

            .blog-post-modern__content h3 {
                font-size: 1.25rem;
                margin: 24px 0 12px
            }

            .blog-post-modern__related {
                padding: 60px 20px
            }

            .blog-post-modern__related-grid {
                grid-template-columns: 1fr
            }
        }
    </style>

    <div class="blog-post-modern__hero">
        <div class="blog-post-modern__hero-bg"></div>
        <div class="blog-post-modern__hero-content">
            <a href="{{ route('blog.index') }}" class="blog-post-modern__back">
                <i class="fa-solid fa-arrow-left"></i> Retour aux articles
            </a>

            <div class="blog-post-modern__meta">
                <span class="blog-post-modern__meta-item">
                    <i class="fa-solid fa-tag"></i> {{ $post->category?->name ?: 'Article' }}
                </span>
                @if($post->published_at)
                    <span class="blog-post-modern__meta-item">
                        <i class="fa-regular fa-calendar"></i> {{ $post->published_at->format('d M Y') }}
                    </span>
                @endif
                @if($post->reading_time)
                    <span class="blog-post-modern__meta-item">
                        <i class="fa-regular fa-clock"></i> {{ (int) $post->reading_time }} min
                    </span>
                @endif
            </div>

            <h1 class="blog-post-modern__title">{{ $post->title }}</h1>
            <p class="blog-post-modern__excerpt">{{ $post->excerpt ?: ' ' }}</p>
        </div>
    </div>

    <div class="blog-post-modern__main">
        @if($post->image)
            <img src="@image_url($post->image)" alt="{{ $post->image_alt ?: $post->title }}" class="blog-post-modern__image" loading="lazy" />
        @endif

        <div class="blog-post-modern__content">
            {!! $post->content ?: '' !!}
        </div>
    </div>

    @if(($relatedPosts ?? collect())->isNotEmpty())
        <div class="blog-post-modern__related">
            <div class="blog-post-modern__related-container">
                <div class="blog-post-modern__related-header">
                    <h2 class="blog-post-modern__related-title">À lire aussi</h2>
                    <p class="blog-post-modern__related-subtitle">Découvrez d'autres articles qui pourraient vous intéresser</p>
                </div>
                <div class="blog-post-modern__related-grid">
                    @foreach($relatedPosts as $p)
                        <a href="{{ route('blog.show', $p->slug) }}" class="blog-post-modern__related-card">
                            <div class="blog-post-modern__related-card-image">
                                <img src="@image_url($p->image)" alt="{{ $p->image_alt ?: $p->title }}" loading="lazy" />
                            </div>
                            <div class="blog-post-modern__related-card-body">
                                <div class="blog-post-modern__related-card-meta">
                                    {{ $p->category?->name ?: 'Article' }} • {{ $p->published_at?->format('d M Y') }}
                                </div>
                                <h3 class="blog-post-modern__related-card-title">{{ $p->title }}</h3>
                                <p class="blog-post-modern__related-card-excerpt">{{ $p->excerpt ?: ' ' }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</section>
@endsection
