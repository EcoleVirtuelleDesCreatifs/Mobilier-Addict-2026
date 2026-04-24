@extends('layouts.front')

@section('title', $post->title)
@section('meta_description', $post->excerpt ?: $post->title)
@section('canonical', route('blog.show', $post->slug))

@section('content')
<section class="blog-post" aria-label="Article">
    <div class="container">
        <div class="blog-post__header">
            <a href="{{ route('blog.index') }}" class="blog-post__back">← Retour aux articles</a>

            <div class="blog-post__meta">
                <span class="blog-post__cat">{{ $post->category?->name ?: 'Article' }}</span>
                @if($post->published_at)
                    <span class="blog-post__date">{{ $post->published_at->format('d M Y') }}</span>
                @endif
                @if($post->reading_time)
                    <span class="blog-post__read">{{ (int) $post->reading_time }} min</span>
                @endif
            </div>

            <h1 class="blog-post__title">{{ $post->title }}</h1>
            <p class="blog-post__excerpt">{{ $post->excerpt ?: ' ' }}</p>
        </div>

        <div class="blog-post__hero">
            <img src="@image_url($post->image)" alt="{{ $post->image_alt ?: $post->title }}" loading="lazy" />
        </div>

        <div class="blog-post__content">
            {!! nl2br(e($post->content ?: '')) !!}
        </div>

        @if(($relatedPosts ?? collect())->isNotEmpty())
            <div class="blog-post__related">
                <h2 class="blog-post__related-title">À lire aussi</h2>
                <div class="blog-post__related-grid">
                    @foreach($relatedPosts as $p)
                        <article class="blog-card">
                            <a href="{{ route('blog.show', $p->slug) }}" style="text-decoration:none;color:inherit">
                                <div class="blog-card__media">
                                    <img src="@image_url($p->image)" alt="{{ $p->image_alt ?: $p->title }}" loading="lazy" />
                                </div>
                                <div class="blog-card__body">
                                    <div class="blog-page__meta">
                                        <span class="blog-page__cat">{{ $p->category?->name ?: 'Article' }}</span>
                                    </div>
                                    <h3 class="blog-card__title">{{ $p->title }}</h3>
                                    <p class="blog-card__excerpt">{{ $p->excerpt ?: ' ' }}</p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
