@extends('layouts.front')

@section('title', 'Blog')
@section('meta_description', "Découvrez nos articles, inspirations et conseils déco.")

@section('content')
<section class="blog-page" aria-label="Blog">
    <div class="container">
        <div class="blog-page__header">
            <h1 class="blog-page__title">Inspirations & Conseils Déco</h1>
            <p class="blog-page__subtitle">Découvrez nos articles pour sublimer votre intérieur</p>
        </div>

        @if($featured)
            <div class="blog-page__featured">
                <a href="{{ route('blog.show', $featured->slug) }}" style="text-decoration:none;color:inherit">
                    <div class="blog-page__featured-card">
                        <div class="blog-page__featured-media">
                            <img src="{{ $featured->image ? asset($featured->image) : 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=1200&h=600&fit=crop' }}" alt="{{ $featured->image_alt ?: $featured->title }}" loading="lazy" />
                            <div class="blog-page__featured-badge">À la une</div>
                        </div>
                        <div class="blog-page__featured-body">
                            <div class="blog-page__meta">
                                <span class="blog-page__cat">{{ $featured->category?->name ?: 'Article' }}</span>
                                @if($featured->published_at)
                                    <span class="blog-page__date">{{ $featured->published_at->format('d M Y') }}</span>
                                @endif
                                @if($featured->reading_time)
                                    <span class="blog-page__read">{{ (int) $featured->reading_time }} min</span>
                                @endif
                            </div>
                            <h2 class="blog-page__featured-title">{{ $featured->title }}</h2>
                            <p class="blog-page__featured-excerpt">{{ $featured->excerpt ?: ' ' }}</p>
                            <span class="blog-page__featured-link">Lire l'article →</span>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <div class="blog-page__grid">
            @foreach($posts as $post)
                <article class="blog-card">
                    <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration:none;color:inherit">
                        <div class="blog-card__media">
                            <img src="{{ $post->image ? asset($post->image) : 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&h=500&fit=crop' }}" alt="{{ $post->image_alt ?: $post->title }}" loading="lazy" />
                        </div>
                        <div class="blog-card__body">
                            <div class="blog-page__meta">
                                <span class="blog-page__cat">{{ $post->category?->name ?: 'Article' }}</span>
                                @if($post->published_at)
                                    <span class="blog-page__date">{{ $post->published_at->format('d M Y') }}</span>
                                @endif
                                @if($post->reading_time)
                                    <span class="blog-page__read">{{ (int) $post->reading_time }} min</span>
                                @endif
                            </div>
                            <h3 class="blog-card__title">{{ $post->title }}</h3>
                            <p class="blog-card__excerpt">{{ $post->excerpt ?: ' ' }}</p>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>

        <div class="blog-page__pagination">
            {{ $posts->links() }}
        </div>
    </div>
</section>
@endsection
