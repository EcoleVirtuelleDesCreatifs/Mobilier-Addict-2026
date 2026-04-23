        <section class="blog-modern" aria-label="Magazine & Conseils">
    <style>
        .blog-modern {
            position: relative;
            padding: 120px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow: hidden
        }

        .blog-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2250%22 cy=%2250%22 r=%221.5%22 fill=%22rgba(255,255,255,.05)%22/></svg>');
            background-size: 40px 40px;
            opacity: .5
        }

        .blog-modern__bg-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px)
        }

        .blog-modern__bg-circle--1 {
            width: 600px;
            height: 600px;
            background: rgba(236,72,153,.3);
            top: -200px;
            right: -200px
        }

        .blog-modern__bg-circle--2 {
            width: 400px;
            height: 400px;
            background: rgba(59,130,246,.3);
            bottom: -100px;
            left: -100px
        }

        .blog-modern__container {
            position: relative;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px
        }

        .blog-modern__header {
            text-align: center;
            margin-bottom: 60px
        }

        .blog-modern__badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            background: rgba(255,255,255,.2);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            margin-bottom: 24px;
            border: 1px solid rgba(255,255,255,.3);
            color: #fff;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase
        }

        .blog-modern__title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            color: #fff;
            margin: 0 0 20px;
            letter-spacing: -0.03em;
            line-height: 1.1;
            text-shadow: 0 4px 20px rgba(0,0,0,.1)
        }

        .blog-modern__title span {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text
        }

        .blog-modern__subtitle {
            font-size: 1.25rem;
            color: rgba(255,255,255,.9);
            margin: 0;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6
        }

        .blog-modern__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 32px;
            margin-bottom: 48px
        }

        .blog-modern__card {
            background: rgba(255,255,255,.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,.2);
            transition: all .4s cubic-bezier(.4,0,.2,1);
            text-decoration: none;
            color: inherit
        }

        .blog-modern__card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 80px rgba(0,0,0,.3)
        }

        .blog-modern__card--featured {
            grid-column: 1 / -1;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 0
        }

        .blog-modern__card--featured .blog-modern__card-image {
            min-height: 400px
        }

        .blog-modern__card-image {
            position: relative;
            width: 100%;
            height: 240px;
            overflow: hidden
        }

        .blog-modern__card--featured .blog-modern__card-image {
            height: 100%;
            min-height: 400px
        }

        .blog-modern__card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease
        }

        .blog-modern__card:hover .blog-modern__card-image img {
            transform: scale(1.1)
        }

        .blog-modern__card-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 8px 20px;
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
            color: #fff;
            border-radius: 20px;
            font-size: 0.8125rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(236,72,153,.4)
        }

        .blog-modern__card-content {
            padding: 28px
        }

        .blog-modern__card--featured .blog-modern__card-content {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center
        }

        .blog-modern__card-meta {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
            flex-wrap: wrap
        }

        .blog-modern__meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500
        }

        .blog-modern__meta-item i {
            color: #ec4899
        }

        .blog-modern__card-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 12px;
            line-height: 1.3;
            letter-spacing: -0.01em
        }

        .blog-modern__card--featured .blog-modern__card-title {
            font-size: 2rem;
            margin-bottom: 20px
        }

        .blog-modern__card-excerpt {
            font-size: 1rem;
            color: #64748b;
            line-height: 1.6;
            margin: 0 0 20px
        }

        .blog-modern__card--featured .blog-modern__card-excerpt {
            font-size: 1.125rem;
            margin-bottom: 28px
        }

        .blog-modern__card-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ec4899;
            font-weight: 700;
            font-size: 0.9375rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all .3s ease
        }

        .blog-modern__card-link:hover {
            color: #be185d;
            gap: 12px
        }

        .blog-modern__cta {
            text-align: center
        }

        .blog-modern__cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 20px 48px;
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            color: #0f172a;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.0625rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 10px 40px rgba(255,215,0,.4);
            transition: all .3s ease
        }

        .blog-modern__cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 50px rgba(255,215,0,.5)
        }

        @media (max-width: 1024px) {
            .blog-modern__card--featured {
                grid-template-columns: 1fr
            }

            .blog-modern__card--featured .blog-modern__card-image {
                min-height: 300px
            }
        }

        @media (max-width: 768px) {
            .blog-modern {
                padding: 80px 0
            }

            .blog-modern__grid {
                grid-template-columns: 1fr;
                gap: 24px
            }

            .blog-modern__card--featured .blog-modern__card-content {
                padding: 28px
            }

            .blog-modern__card--featured .blog-modern__card-title {
                font-size: 1.5rem
            }
        }
    </style>

    <div class="blog-modern__bg-circle blog-modern__bg-circle--1"></div>
    <div class="blog-modern__bg-circle blog-modern__bg-circle--2"></div>

    <div class="blog-modern__container">
        <div class="blog-modern__header">
            <span class="blog-modern__badge">
                <i class="fa-solid fa-sparkles"></i> Notre Magazine
            </span>
            <h2 class="blog-modern__title">Inspirations &<br><span>Conseils Déco</span></h2>
            <p class="blog-modern__subtitle">Découvrez nos articles pour sublimer votre intérieur et créer un espace qui vous ressemble</p>
        </div>

        <div class="blog-modern__grid">
            @if($blogFeaturedPost)
                <a href="{{ route('blog.show', $blogFeaturedPost->slug) }}" class="blog-modern__card blog-modern__card--featured">
                    <div class="blog-modern__card-image">
                        <img src="{{ $blogFeaturedPost->image ? asset($blogFeaturedPost->image) : 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=800&h=500&fit=crop' }}" alt="{{ $blogFeaturedPost->image_alt ?: $blogFeaturedPost->title }}" loading="lazy" />
                        <span class="blog-modern__card-badge">À la une</span>
                    </div>
                    <div class="blog-modern__card-content">
                        <div class="blog-modern__card-meta">
                            <span class="blog-modern__meta-item"><i class="fa-solid fa-tag"></i> {{ $blogFeaturedPost->category?->name ?: 'Article' }}</span>
                            @if($blogFeaturedPost->published_at)
                                <span class="blog-modern__meta-item"><i class="fa-regular fa-calendar"></i> {{ $blogFeaturedPost->published_at->format('d M Y') }}</span>
                            @endif
                            @if($blogFeaturedPost->reading_time)
                                <span class="blog-modern__meta-item"><i class="fa-regular fa-clock"></i> {{ (int) $blogFeaturedPost->reading_time }} min</span>
                            @endif
                        </div>
                        <h3 class="blog-modern__card-title">{{ $blogFeaturedPost->title }}</h3>
                        <p class="blog-modern__card-excerpt">{{ $blogFeaturedPost->excerpt ?: ' ' }}</p>
                        <span class="blog-modern__card-link">Lire l'article <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </a>
            @endif

            @foreach(($blogPosts ?? collect()) as $post)
                <a href="{{ route('blog.show', $post->slug) }}" class="blog-modern__card">
                    <div class="blog-modern__card-image">
                        <img src="{{ $post->image ? asset($post->image) : 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400&h=300&fit=crop' }}" alt="{{ $post->image_alt ?: $post->title }}" loading="lazy" />
                    </div>
                    <div class="blog-modern__card-content">
                        <div class="blog-modern__card-meta">
                            <span class="blog-modern__meta-item"><i class="fa-solid fa-tag"></i> {{ $post->category?->name ?: 'Article' }}</span>
                            @if($post->published_at)
                                <span class="blog-modern__meta-item"><i class="fa-regular fa-calendar"></i> {{ $post->published_at->format('d M Y') }}</span>
                            @endif
                        </div>
                        <h3 class="blog-modern__card-title">{{ $post->title }}</h3>
                        <span class="blog-modern__card-link">Lire <i class="fa-solid fa-chevron-right"></i></span>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="blog-modern__cta">
            <a class="blog-modern__cta-btn" href="{{ route('blog.index') }}">
                <i class="fa-solid fa-newspaper"></i> Voir tous les articles
            </a>
        </div>
    </div>
</section>
