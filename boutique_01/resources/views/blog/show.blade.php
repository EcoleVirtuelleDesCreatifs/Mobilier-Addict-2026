@extends('maquette.layout')

@section('title', $post->title . ' | Magazine Mobilier Addict')
@section('meta_description', $post->excerpt ?? Str::limit(strip_tags($post->content), 155))
@section('meta_image', $post->image_url ?? asset('assets/maquette/img/blog/furniture-9.jpg'))
@section('og_type', 'article')

@push('meta')
    <script type="application/ld+json">
    {!! json_encode([
        '@@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => route('blog.show', $post->slug),
        ],
        'headline' => $post->title,
        'description' => $post->excerpt ?? Str::limit(strip_tags($post->content), 160),
        'image' => $post->image_url ?? asset('assets/maquette/img/blog/furniture-9.jpg'),
        'datePublished' => optional($post->published_at ?? $post->created_at)->toISOString(),
        'dateModified' => optional($post->updated_at)->toISOString(),
        'author' => [
            '@type' => 'Organization',
            'name' => 'Mobilier Addict',
            'url' => route('home'),
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Mobilier Addict',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('assets/logo/desktop/logo.png'),
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')
    <div class="article-page art-v2 mt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="article-rte">
                        <div class="article-img">
                            <img loading="lazy" decoding="async" src="{{ $post->image_url ?? asset('assets/maquette/img/blog/furniture-9.jpg') }}" alt="{{ $post->title }}">
                        </div>
                        <div class="article-meta">
                            <p class="article-ma-kicker">{{ $post->category?->name ?? 'Blog' }} · Le magazine Mobilier Addict</p>
                            <h1 class="article-title">{{ $post->title }}</h1>
                            <div class="article-card-published text_14 d-flex align-items-center flex-wrap">
                                <a href="{{ route('blog.index') }}" class="article-date d-flex align-items-center">
                                    <span>Notre magazine</span>
                                </a>
                                <span class="article-separator mx-3">
                                    <svg width="2" height="12" viewBox="0 0 2 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M1.09761 0.5H0V11.5H1.09761V0.5Z" fill="black"/>
                                    </svg>
                                </span>
                                <span class="article-date d-flex align-items-center">
                                    <span>{{ $post->published_at?->format('d/m/Y') ?? $post->created_at?->format('d/m/Y') }}</span>
                                </span>
                            </div>
                        </div>

                        <div class="article-content">
                            {!! $post->content !!}
                        </div>

                        @if($relatedPosts->count())
                            <div class="related-articles mt-5">
                                <h3 class="mb-4">Articles similaires</h3>
                                <div class="row">
                                    @foreach($relatedPosts as $related)
                                        <div class="col-md-4 mb-4">
                                            <div class="magazine-card">
                                                <img loading="lazy" decoding="async" src="{{ $related->image_url ?? asset('assets/maquette/img/blog/furniture-1.jpg') }}" alt="{{ $related->title }}" width="400" height="300">
                                                <div class="magazine-card-content">
                                                    <p class="magazine-category">{{ $related->category?->name ?? 'Blog' }}</p>
                                                    <h4>{{ $related->title }}</h4>
                                                    <a class="magazine-read" href="{{ route('blog.show', $related->slug) }}">Lire la suite <span aria-hidden="true">→</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="next-prev-article mt-5 d-flex align-items-center justify-content-between flex-wrap">
                            <a href="{{ route('blog.index') }}" class="article-btn prev-article-btn mt-2">← RETOUR AU MAGAZINE</a>
                            <a href="{{ route('collection.index') }}" class="article-btn next-article-btn active mt-2">DÉCOUVRIR NOS PRODUITS →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
