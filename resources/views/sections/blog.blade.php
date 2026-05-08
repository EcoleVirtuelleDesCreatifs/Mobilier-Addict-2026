        <section class="blog-premium" aria-label="Magazine & Conseils">
    <div class="blog-premium__container">

        <div class="blog-premium__header">
            <span class="blog-premium__label">Notre Magazine</span>
            <h2 class="blog-premium__title">
                Inspirations & <span>Conseils Déco</span>
            </h2>
            <p class="blog-premium__subtitle">
                Des conseils simples et utiles pour mieux choisir vos matelas, oreillers et accessoires de literie.
            </p>
        </div>

        <div class="blog-premium__grid">

            @if($blogFeaturedPost)
                <a href="{{ route('blog.show', $blogFeaturedPost->slug) }}" class="blog-premium__card blog-premium__card--featured">
                    <div class="blog-premium__image">
                        <img src="@image_url($blogFeaturedPost->image)" alt="{{ $blogFeaturedPost->image_alt ?: $blogFeaturedPost->title }}" loading="lazy">
                        <span class="blog-premium__badge">À la une</span>
                    </div>
                    <div class="blog-premium__content">
                        <span class="blog-premium__date">{{ $blogFeaturedPost->published_at ? $blogFeaturedPost->published_at->format('d M Y') : '' }}</span>
                        <h3>{{ $blogFeaturedPost->title }}</h3>
                        <p>{{ $blogFeaturedPost->excerpt ?: '' }}</p>
                        <span class="blog-premium__link">Lire l'article →</span>
                    </div>
                </a>
            @endif

            @php
                $listPosts = ($blogPosts ?? collect())->take(2);
            @endphp

            @foreach($listPosts as $post)
                <a href="{{ route('blog.show', $post->slug) }}" class="blog-premium__card">
                    <div class="blog-premium__image">
                        <img src="@image_url($post->image)" alt="{{ $post->image_alt ?: $post->title }}" loading="lazy">
                    </div>
                    <div class="blog-premium__content">
                        <span class="blog-premium__date">{{ $post->published_at ? $post->published_at->format('d M Y') : '' }}</span>
                        <h3>{{ $post->title }}</h3>
                        <span class="blog-premium__link">Lire →</span>
                    </div>
                </a>
            @endforeach

        </div>

        <div class="blog-premium__cta">
            <a href="{{ route('blog.index') }}" class="blog-premium__btn">Voir tous les articles →</a>
        </div>

    </div>
</section>
