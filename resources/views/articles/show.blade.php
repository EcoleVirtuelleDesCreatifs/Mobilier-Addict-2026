@extends('layouts.front')

@section('content')
    <section class="bg-accent add-top-margin section-space-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="bg-body item-shadow-gray p-4 mb-4">
                        <div class="mb-3">
                            <div class="topic-box-sm color-cinnabar mb-10">{{ $article->category?->title ?? 'Actualités' }}</div>
                            <h1 class="title-medium-dark mb-10">{{ $article->title }}</h1>
                            <div class="post-date-dark">
                                <ul>
                                    <li>
                                        <span>by</span>
                                        <a href="#">{{ $article->author?->name ?? 'Rédaction' }}</a>
                                    </li>
                                    <li>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>{{ optional($article->published_at ?? $article->created_at)->format('d M Y') }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        @if(!empty($article->featured_image))
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="img-fluid width-100">
                            </div>
                        @endif

                        <div class="post-body">
                            {!! $article->content !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="sidebar-box">
                        <div class="topic-border color-cinnabar mb-30">
                            <div class="topic-box-lg color-cinnabar">À la une</div>
                        </div>
                        <p class="mb-0">Retour à la <a href="{{ url('/') }}">page d’accueil</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
