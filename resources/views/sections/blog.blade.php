        <section class="blog-classic" aria-label="Magazine & Conseils">
    <style>
        .blog-classic {
            padding: 100px 0;
            background: #f8fafc
        }

        .blog-classic__container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px
        }

        .blog-classic__header {
            text-align: center;
            margin-bottom: 60px
        }

        .blog-classic__label {
            display: inline-block;
            padding: 8px 20px;
            background: #0f172a;
            color: #fff;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px
        }

        .blog-classic__title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 16px;
            letter-spacing: -0.02em;
            line-height: 1.2
        }

        .blog-classic__title span {
            color: #ec4899
        }

        .blog-classic__subtitle {
            font-size: 1.125rem;
            color: #64748b;
            margin: 0;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6
        }

        .blog-classic__grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            margin-bottom: 48px
        }

        .blog-classic__card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,.06);
            transition: all .3s ease;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column
        }

        .blog-classic__card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(0,0,0,.12)
        }

        .blog-classic__card--featured {
            grid-column: 1 / 2
        }

        .blog-classic__card-image {
            position: relative;
            height: 240px;
            overflow: hidden
        }

        .blog-classic__card--featured .blog-classic__card-image {
            height: 300px
        }

        .blog-classic__card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease
        }

        .blog-classic__card:hover .blog-classic__card-image img {
            transform: scale(1.08)
        }

        .blog-classic__card-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            padding: 6px 16px;
            background: #0f172a;
            color: #fff;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px
        }

        .blog-classic__card-content {
            padding: 24px;
            flex: 1;
            display: flex;
            flex-direction: column
        }

        .blog-classic__card--featured .blog-classic__card-content {
            padding: 32px
        }

        .blog-classic__card-meta {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
            font-size: 0.8125rem;
            color: #94a3b8;
            font-weight: 500
        }

        .blog-classic__card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 12px;
            line-height: 1.4;
            letter-spacing: -0.01em;
            flex: 1
        }

        .blog-classic__card--featured .blog-classic__card-title {
            font-size: 1.5rem;
            margin-bottom: 16px
        }

        .blog-classic__card-excerpt {
            font-size: 0.9375rem;
            color: #64748b;
            line-height: 1.6;
            margin: 0 0 20px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden
        }

        .blog-classic__card-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ec4899;
            font-weight: 700;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: auto
        }

        .blog-classic__cta {
            text-align: center
        }

        .blog-classic__cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 40px;
            background: #0f172a;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9375rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all .3s ease
        }

        .blog-classic__cta-btn:hover {
            background: #ec4899;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(236,72,153,.3)
        }

        @media (max-width: 1024px) {
            .blog-classic__grid {
                grid-template-columns: repeat(2, 1fr)
            }

            .blog-classic__card--featured {
                grid-column: 1 / -1
            }
        }

        @media (max-width: 768px) {
            .blog-classic {
                padding: 80px 0
            }

            .blog-classic__grid {
                grid-template-columns: 1fr;
                gap: 24px
            }

            .blog-classic__card--featured {
                grid-column: 1
            }

            .blog-classic__card-image {
                height: 200px
            }

            .blog-classic__card--featured .blog-classic__card-image {
                height: 260px
            }
        }
    </style>

    <div class="blog-classic__container">
        <div class="blog-classic__header">
            <span class="blog-classic__label">Notre Magazine</span>
            <h2 class="blog-classic__title">Inspirations & <span>Conseils Déco</span></h2>
            <p class="blog-classic__subtitle">Découvrez nos articles pour sublimer votre intérieur et créer un espace qui vous ressemble</p>
        </div>

        <div class="blog-classic__grid">
            @if($blogFeaturedPost)
                <a href="{{ route('blog.show', $blogFeaturedPost->slug) }}" class="blog-classic__card blog-classic__card--featured">
                    <div class="blog-classic__card-image">
                        <img src="@image_url($blogFeaturedPost->image)" alt="{{ $blogFeaturedPost->image_alt ?: $blogFeaturedPost->title }}" loading="lazy" />
                        <span class="blog-classic__card-badge">À la une</span>
                    </div>
                    <div class="blog-classic__card-content">
                        <div class="blog-classic__card-meta">
                            @if($blogFeaturedPost->category)
                                <span>{{ $blogFeaturedPost->category->name }}</span>
                            @endif
                            @if($blogFeaturedPost->published_at)
                                <span>{{ $blogFeaturedPost->published_at->format('d M Y') }}</span>
                            @endif
                        </div>
                        <h3 class="blog-classic__card-title">{{ $blogFeaturedPost->title }}</h3>
                        <p class="blog-classic__card-excerpt">{{ $blogFeaturedPost->excerpt ?: ' ' }}</p>
                        <span class="blog-classic__card-link">Lire l'article <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </a>
            @endif

            @php
                $listPosts = ($blogPosts ?? collect())->take(2);
            @endphp

            @foreach($listPosts as $post)
                <a href="{{ route('blog.show', $post->slug) }}" class="blog-classic__card">
                    <div class="blog-classic__card-image">
                        <img src="@image_url($post->image)" alt="{{ $post->image_alt ?: $post->title }}" loading="lazy" />
                    </div>
                    <div class="blog-classic__card-content">
                        <div class="blog-classic__card-meta">
                            @if($post->category)
                                <span>{{ $post->category->name }}</span>
                            @endif
                            @if($post->published_at)
                                <span>{{ $post->published_at->format('d M Y') }}</span>
                            @endif
                        </div>
                        <h3 class="blog-classic__card-title">{{ $post->title }}</h3>
                        <span class="blog-classic__card-link">Lire <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="blog-classic__cta">
            <a class="blog-classic__cta-btn" href="{{ route('blog.index') }}">
                <i class="fa-solid fa-newspaper"></i> Voir tous les articles
            </a>
        </div>
    </div>
</section>
