        <section class="blog-section" aria-label="Magazine & Conseils">
            <div class="blog-section__bg"></div>
            <div class="container">
                <div class="blog-section__panel">
                    <div class="blog-section__header">
                        <span class="blog-section__badge"><i class="fa-solid fa-sparkles"></i> Notre Magazine</span>
                        <h2 class="blog-section__title">Inspirations &<br><span>Conseils Déco</span></h2>
                        <p class="blog-section__subtitle">Découvrez nos articles pour sublimer votre intérieur</p>
                    </div>

                    <div class="blog-section__wrapper">
                        @if($blogFeaturedPost)
                            <article class="blog-article blog-article--featured">
                                <a href="{{ route('blog.show', $blogFeaturedPost->slug) }}" style="text-decoration:none;color:inherit">
                                    <div class="blog-article__image">
                                        <img src="{{ $blogFeaturedPost->image ? asset($blogFeaturedPost->image) : 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=800&h=500&fit=crop' }}" alt="{{ $blogFeaturedPost->image_alt ?: $blogFeaturedPost->title }}" loading="lazy" />
                                        <div class="blog-article__badge">À la une</div>
                                    </div>
                                </a>
                                <div class="blog-article__body">
                                    <div class="blog-article__meta">
                                        <span class="blog-article__category"><i class="fa-solid fa-tag"></i> {{ $blogFeaturedPost->category?->name ?: 'Article' }}</span>
                                        @if($blogFeaturedPost->published_at)
                                            <span class="blog-article__date"><i class="fa-regular fa-calendar"></i> {{ $blogFeaturedPost->published_at->format('d M Y') }}</span>
                                        @endif
                                        @if($blogFeaturedPost->reading_time)
                                            <span class="blog-article__read"><i class="fa-regular fa-clock"></i> {{ (int) $blogFeaturedPost->reading_time }} min</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('blog.show', $blogFeaturedPost->slug) }}" style="text-decoration:none;color:inherit">
                                        <h3 class="blog-article__title">{{ $blogFeaturedPost->title }}</h3>
                                    </a>
                                    <p class="blog-article__excerpt">{{ $blogFeaturedPost->excerpt ?: ' ' }}</p>
                                    <a class="blog-article__btn" href="{{ route('blog.show', $blogFeaturedPost->slug) }}">
                                        Lire l'article <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        @endif

                        <div class="blog-section__list">
                            @foreach(($blogPosts ?? collect()) as $post)
                                <article class="blog-article blog-article--mini">
                                    <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration:none;color:inherit">
                                        <div class="blog-article__image">
                                            <img src="{{ $post->image ? asset($post->image) : 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400&h=300&fit=crop' }}" alt="{{ $post->image_alt ?: $post->title }}" loading="lazy" />
                                        </div>
                                    </a>
                                    <div class="blog-article__body">
                                        <span class="blog-article__category"><i class="fa-solid fa-tag"></i> {{ $post->category?->name ?: 'Article' }}</span>
                                        <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration:none;color:inherit">
                                            <h3 class="blog-article__title">{{ $post->title }}</h3>
                                        </a>
                                        <a class="blog-article__link" href="{{ route('blog.show', $post->slug) }}">Lire <i class="fa-solid fa-chevron-right"></i></a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>

                    <div class="blog-section__cta">
                        <a class="blog-section__btn" href="{{ route('blog.index') }}">
                            <i class="fa-solid fa-newspaper"></i> Voir tous les articles
                        </a>
                    </div>
                </div>
            </div>
        </section>
