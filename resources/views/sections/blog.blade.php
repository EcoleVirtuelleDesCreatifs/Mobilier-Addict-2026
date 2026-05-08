        <section class="blog-minimal" aria-label="Magazine & Conseils">
    <div class="blog-minimal__container">

        <div class="blog-minimal__header">
            <h2>Blog</h2>
            <p>Conseils et inspirations pour votre intérieur</p>
        </div>

        <div class="blog-minimal__grid">

            @if($blogFeaturedPost)
                <a href="{{ route('blog.show', $blogFeaturedPost->slug) }}" class="blog-minimal__card blog-minimal__card--featured">
                    <div class="blog-minimal__image">
                        <img src="@image_url($blogFeaturedPost->image)" alt="{{ $blogFeaturedPost->image_alt ?: $blogFeaturedPost->title }}" loading="lazy">
                    </div>
                    <div class="blog-minimal__content">
                        <span class="blog-minimal__date">{{ $blogFeaturedPost->published_at ? $blogFeaturedPost->published_at->format('d M Y') : '' }}</span>
                        <h3>{{ $blogFeaturedPost->title }}</h3>
                        <p>{{ $blogFeaturedPost->excerpt ?: '' }}</p>
                    </div>
                </a>
            @endif

            @php
                $listPosts = ($blogPosts ?? collect())->take(2);
            @endphp

            @foreach($listPosts as $post)
                <a href="{{ route('blog.show', $post->slug) }}" class="blog-minimal__card">
                    <div class="blog-minimal__image">
                        <img src="@image_url($post->image)" alt="{{ $post->image_alt ?: $post->title }}" loading="lazy">
                    </div>
                    <div class="blog-minimal__content">
                        <span class="blog-minimal__date">{{ $post->published_at ? $post->published_at->format('d M Y') : '' }}</span>
                        <h3>{{ $post->title }}</h3>
                    </div>
                </a>
            @endforeach

        </div>

        <div class="blog-minimal__cta">
            <a href="{{ route('blog.index') }}" class="blog-minimal__btn">Voir tous les articles</a>
        </div>

    </div>
</section>
