        <section class="blog-modern" aria-label="Magazine & Conseils">
    <div class="blog-modern__container">

        <div class="blog-modern__header">
            <span class="blog-modern__label">Blog</span>
            <h2>Conseils & Inspirations</h2>
            <p>Découvrez nos articles pour améliorer votre quotidien</p>
        </div>

        <div class="blog-modern__grid">

            @if($blogFeaturedPost)
                <a href="{{ route('blog.show', $blogFeaturedPost->slug) }}" class="blog-modern__card blog-modern__card--featured">
                    <div class="blog-modern__image">
                        <img src="@image_url($blogFeaturedPost->image)" alt="{{ $blogFeaturedPost->image_alt ?: $blogFeaturedPost->title }}" loading="lazy">
                        <div class="blog-modern__overlay"></div>
                    </div>
                    <div class="blog-modern__content">
                        <span class="blog-modern__tag">À la une</span>
                        <span class="blog-modern__date">{{ $blogFeaturedPost->published_at ? $blogFeaturedPost->published_at->format('d M Y') : '' }}</span>
                        <h3>{{ $blogFeaturedPost->title }}</h3>
                        <p>{{ $blogFeaturedPost->excerpt ?: '' }}</p>
                        <span class="blog-modern__read">Lire l'article →</span>
                    </div>
                </a>
            @endif

            @php
                $listPosts = ($blogPosts ?? collect())->take(2);
            @endphp

            @foreach($listPosts as $post)
                <a href="{{ route('blog.show', $post->slug) }}" class="blog-modern__card">
                    <div class="blog-modern__image">
                        <img src="@image_url($post->image)" alt="{{ $post->image_alt ?: $post->title }}" loading="lazy">
                    </div>
                    <div class="blog-modern__content">
                        <span class="blog-modern__date">{{ $post->published_at ? $post->published_at->format('d M Y') : '' }}</span>
                        <h3>{{ $post->title }}</h3>
                        <span class="blog-modern__read">Lire →</span>
                    </div>
                </a>
            @endforeach

        </div>

        <div class="blog-modern__cta">
            <a href="{{ route('blog.index') }}" class="blog-modern__btn">Voir tous les articles</a>
        </div>

    </div>
</section>
